<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Citas;
use App\Models\Colegiaturas;
use App\Models\Comprador;
use App\Models\DetalleVenta;
use App\Models\Estilista;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Pedidos;
use App\Models\Persona;
use App\Models\Productos;
use App\Models\Profesor;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('dashboard.inicio');
    }
    public function inicio(Request $request)
    {

        $totalVentasPedidos = Ventas::sum('total') + Pedidos::sum('total');

        $totalCitasConcluido = Citas::where('estado_pago', 'concluido')->sum('total');
        $totalCitasAnticipo = Citas::where('estado_pago', 'anticipo')->sum('anticipo');
        $totalCitas = $totalCitasConcluido + $totalCitasAnticipo;

        $totalInscripciones = Inscripcion::join('estudiantes', 'inscripciones.id', '=', 'estudiantes.id_inscripcion')
            ->sum('inscripciones.precio');

        $totalColegiaturas = Colegiaturas::where('estado', 'pagado')->sum('Monto');

        $totalAcademia = $totalInscripciones + $totalColegiaturas;

        $totalGeneral = $totalVentasPedidos + $totalCitas + $totalAcademia;


        $compradoresCount = Comprador::count();
        $estilistasCount = Estilista::count();
        $administradoresCount = Administrador::count();
        $profesoresCount = Profesor::count();
        $estudiantesCount = Estudiante::count();


        $totalUsuarios = $compradoresCount + $estilistasCount + $administradoresCount + $profesoresCount + $estudiantesCount;

        $productos = Productos::all();

        $valorStock = $productos->sum(function ($producto) {
            return $producto->precio_proveedor * $producto->stock;
        });

        // Calcular el valor de stock venta
        $valorStockVenta = $productos->sum(function ($producto) {
            return $producto->precio_venta * $producto->stock;
        });


        // Retornar vista con los datos necesarios
        return view('dashboard.index', compact(
            'totalVentasPedidos',
            'totalCitas',
            'totalAcademia',
            'totalGeneral',
            'compradoresCount',
            'estilistasCount',
            'administradoresCount',
            'profesoresCount',
            'estudiantesCount',
            'totalUsuarios',
            'valorStock',
            'valorStockVenta',
        ));
    }


    public function ventas(Request $request)
    {
        $productos = Productos::all();
        return view('dashboard.index', compact('productos'));
    }

    public function ventasStore(Request $request)
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Obtener el id_persona del usuario autenticado
        $persona = Persona::where('usuario', $userId)->first();

        if (!$persona) {
            return response()->json(['error' => 'Persona no encontrada.'], 404);
        }

        $idPersona = $persona->id;

        // Obtener el administrador que corresponde a este id_persona
        $admin = Administrador::where('id_persona', $idPersona)->first();

        if (!$admin) {
            return response()->json(['error' => 'Administrador no encontrado.'], 404);
        }

        $adminId = $admin->id; // Obtén el ID del administrador

        // Obtener datos del comprador
        $nombreComprador = $request->input('nombreComprador');
        $fechaCompra = now()->toDateString(); // Fecha actual
        $esEstudiante = $request->input('esEstudiante') ? 'si' : 'no'; // Si está marcado el checkbox
        $matricula = $esEstudiante === 'si' ? $request->input('matricula') : null; // Obtener matrícula si es estudiante

        // Crear la venta
        $venta = Venta::create([
            'id_comprador' => $request->input('id_comprador'), // Asegúrate de enviar este dato en la petición
            'fecha_compra' => $fechaCompra,
            'total' => 0, // Inicialmente puedes dejarlo en 0 o calcularlo más adelante
            'id_admin' => $adminId,
            'es_estudiante' => $esEstudiante,
            'matricula' => $matricula,
        ]);

        // Procesar los detalles de la venta
        $detalles = $this->procesarDetallesVenta($request->input('carrito'), $venta->id, $esEstudiante);

        // Retornar la respuesta
        return response()->json([
            'mensaje' => 'Venta registrada correctamente.',
            'venta' => [
                'nombre_comprador' => $nombreComprador,
                'fecha_compra' => $fechaCompra,
                'id_admin' => $adminId,
                'es_estudiante' => $esEstudiante,
                'matricula' => $matricula,
                'detalles' => $detalles,
            ],
        ]);
    }

    private function procesarDetallesVenta($carrito, $idVenta, $esEstudiante)
    {
        $detalles = [];
        foreach ($carrito as $idProducto => $producto) {
            $cantidad = $producto['cantidad'];
            $precioAplicado = $this->calcularPrecioAplicado($producto, $esEstudiante);
            $descuento = $esEstudiante === 'si' ? $producto['precio'] - $producto['precio_lista'] : 0;

            // Guardar el detalle en la base de datos
            DetalleVenta::create([
                'id_venta' => $idVenta,
                'id_producto' => $idProducto,
                'cantidad' => $cantidad,
                'precio_aplicado' => $precioAplicado,
                'descuento' => $descuento,
            ]);

            $detalles[] = [
                'id_producto' => $idProducto,
                'cantidad' => $cantidad,
                'precio_aplicado' => $precioAplicado,
                'descuento' => $descuento,
            ];
        }

        return $detalles;
    }

    private function calcularPrecioAplicado($producto, $esEstudiante)
    {
        // Calcula el precio aplicado según si es estudiante o no
        return $esEstudiante === 'si' ? $producto['precio_lista'] : $producto['precio'];
    }
    public function compras(Request $request)
    {
        return view('dashboard.index');
    }

    public function citas(Request $request)
    {
        return view('dashboard.index');
    }

    public function servicios(Request $request)
    {
        return view('dashboard.index');
    }

    public function productos(Request $request)
    {
        return view('dashboard.index');
    }

    public function usuarios(Request $request)
    {
        return view('dashboard.index');
    }

    public function auditoria(Request $request)
    {
        return view('dashboard.index');
    }

    public function profile(Request $request)
    {
        return view('dashboard.index');
    }

}
