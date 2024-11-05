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

        $totalColegiaturas = Colegiaturas::where('colegiatura', 1)->sum('Monto');

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
        $administradores = Administrador::with('persona')->get();

        // Construcción de la consulta base
        $ventasQuery = Ventas::with(['administrador.persona', 'detalles.producto'])
            ->select('id', 'nombre_comprador', 'fecha_compra', 'total', 'id_admin', 'es_estudiante', 'matricula');

        // Aplicar filtros según estén presentes en la solicitud
        if ($request->filled('comprador')) {
            $ventasQuery->where('nombre_comprador', 'like', '%' . $request->comprador . '%');
        }

        // Filtrado por Rango de Fechas
        if ($request->filled('fecha_inicio') || $request->filled('fecha_fin')) {
            if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
                if ($request->fecha_inicio === $request->fecha_fin) {
                    // Ambas fechas son iguales, filtrar por esa fecha específica
                    $ventasQuery->whereDate('fecha_compra', $request->fecha_inicio);
                } else {
                    // Ambas fechas están presentes y son diferentes
                    $ventasQuery->whereBetween('fecha_compra', [$request->fecha_inicio, $request->fecha_fin]);
                }
            } elseif ($request->filled('fecha_inicio')) {
                // Solo se proporciona la fecha de inicio
                $ventasQuery->whereDate('fecha_compra', $request->fecha_inicio);
            } elseif ($request->filled('fecha_fin')) {
                // Solo se proporciona la fecha de fin
                $ventasQuery->whereDate('fecha_compra', $request->fecha_fin);
            }
        }

        if ($request->filled('estado')) {
            $ventasQuery->where('estado', $request->estado);
        }
        if ($request->filled('tipo')) {
            $ventasQuery->where('tipo', $request->tipo);
        }
        if ($request->filled('es_estudiante')) {
            $ventasQuery->where('es_estudiante', $request->es_estudiante);
        }
        if ($request->filled('vendedor')) {
            $ventasQuery->whereHas('administrador.persona', function($query) use ($request) {
                $query->where('nombre', 'like', '%' . $request->vendedor . '%');
            });
        }

        // Ordenar y paginar los resultados
        $ventas = $ventasQuery->orderBy('fecha_compra', 'desc')->paginate(10);

        // Transformar los resultados para establecer valores predeterminados
        $ventas->getCollection()->transform(function ($venta) {
            $venta->tipo = $venta->tipo ?? 'Física'; // Tipo predeterminado
            $venta->estado = $venta->estado ?? 'Completada'; // Estado predeterminado
            return $venta;
        });

        // Devolver la vista con los datos
        return view('dashboard.index', compact('productos', 'ventas', 'administradores'));
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
