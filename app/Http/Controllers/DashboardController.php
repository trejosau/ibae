<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Categorias;
use App\Models\Subcategoria;
use App\Models\Categorias_de_Servicios;
use App\Models\Citas;
use App\Models\Colegiaturas;
use App\Models\Comprador;
use App\Models\Compras;
use App\Models\DetalleVenta;
use App\Models\Estilista;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Notificaciones;
use App\Models\Pedidos;
use App\Models\Productos;
use App\Models\Profesor;
use App\Models\Proveedores;
use App\Models\Servicios;
use App\Models\User;
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

        // Filtrar si es estudiante
        if ($request->filled('es_estudiante')) {
            $ventasQuery->where('es_estudiante', $request->es_estudiante);
        }

        // Filtrar por Vendedor (nombre del administrador)
        if ($request->filled('vendedor')) {
            $ventasQuery->whereHas('administrador.persona', function ($query) use ($request) {
                $query->where('nombre', 'like', '%' . $request->vendedor . '%');
            });
        }

        // Ordenar y paginar los resultados
        $ventas = $ventasQuery->orderBy('fecha_compra', 'desc')->paginate(10);

        // Devolver la vista con los datos
        return view('dashboard.index', compact('productos', 'ventas', 'administradores'));
    }

    public function pedidos(Request $request)
    {


        $query = Pedidos::with(['comprador.persona', 'detalles.producto', 'entrega', 'estudiante']);

        if ($request->has('search') && $request->search) {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        if ($request->has('estado') && $request->estado) {
            $query->where('estado', $request->estado);
        }

        $pedidos = $query->paginate(8); // Adjust the number for pagination

        return view('dashboard.index', compact('pedidos'));
    }

    public function compraRecibida($id)
    {

        $compra = Compras::find($id);
        $compra->estado = 'entregado';
        $compra->save();
        return redirect()->route('dashboard.compras');
    }

    public function compraCancelar(Request $request, $id)
    {
        $request->validate([
            'motivo' => 'required|string|max:255',
        ]);

        $compra = Compras::find($id);
        $compra->estado = 'cancelado';
        $compra->motivo = $request->motivo;
        $compra->save();
        return redirect()->back()->with('success', 'Compra actualizada correctamente.');
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
        $proveedores = Proveedores::paginate(4, ['*'], 'proveedores_page');
        $proveedores->load(['productos' => function($query) {
            $query->whereIn('estado', ['activo', 'agotado']);
        }]);

        $compras = Compras::with('proveedor')
            ->orderBy('fecha_compra', 'desc')
            ->paginate(6, ['*'], 'compras_page');

        $productos = Productos::where('estado', '!=', 'inactivo')
            ->with('proveedor')
            ->paginate(10, ['*'], 'productos_page');

        $catalogoProductos = Productos::where('estado', '!=', 'inactivo')->get();

        // Obtener el filtro de la URL, por defecto 'todos'
        $filtro = $request->get('filtro' );
        $notificaciones = Notificaciones::where('user_id', auth()->id());

        if ($filtro === 'leidas') {
            $notificaciones = $notificaciones->whereNotNull('leida_at');
        } elseif ($filtro === 'no-leidas') {
            $notificaciones = $notificaciones->whereNull('leida_at');
        }
        $notificaciones = $notificaciones->get();


        return view('dashboard.index', compact('proveedores', 'compras', 'productos', 'catalogoProductos', 'notificaciones'));
    }



    public function proveedoresCreate(Request $request)
    {
        $request->validate([
            'nombre_persona' => 'required|string|max:255',
            'nombre_empresa' => 'required|string|max:255',
            'contacto_telefono' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/',
            'contacto_correo' => 'required|email|max:255',
        ]);

        // Crear el nuevo proveedor
        $proveedor = Proveedores::create([
            'nombre_persona' => $request->nombre_persona,
            'nombre_empresa' => $request->nombre_empresa,
            'contacto_telefono' => $request->contacto_telefono,
            'contacto_correo' => $request->contacto_correo,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Proveedor agregado correctamente.');
    }

    public function proveedoresUpdate(Request $request, $id)
    {
        // Validar los datos de la solicitud
        $validated = $request->validate([
            'nombre_persona' => 'required|string|max:255',
            'nombre_empresa' => 'required|string|max:255',
            'contacto_telefono' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/',
            'contacto_correo' => 'required|email|max:255',
        ]);

        // Buscar al proveedor por ID
        $proveedor = Proveedores::find($id);

        if (!$proveedor) {
            // Si no se encuentra el proveedor, redirigir con mensaje de error
            return redirect()->route('dashboard.compras')->with('error', 'Proveedor no encontrado.');
        }

        // Actualizar los datos del proveedor con la información validada
        $proveedor->update($validated);

        // Redirigir con mensaje de éxito
        return redirect()->route('dashboard.compras')->with('success', 'Datos del proveedor actualizados correctamente.');
    }


    public function proveedoresDestroy(Request $request, $id)
    {
        $proveedor = Proveedores::find($id);
        $proveedor->delete();
        return redirect()->route('dashboard.compras')->with('success', 'Proveedor eliminado correctamente.');
    }




    public function citas(Request $request)
    {
        return view('dashboard.index');
    }

    public function servicios(Request $request)
    {
        $servicios = Servicios::with('categoria')->get();


        $categorias = Categorias_de_Servicios::all();


        return view('dashboard.index', compact('servicios', 'categorias'));
    }

    public function obtenerSubcategorias(Request $request)
    {
        $subcategorias = Subcategoria::where('categoria_id', $request->id_categoria)->get();
        return response()->json($subcategorias);
    }

    public function productos(Request $request)
    {

        $categorias = Categorias::with('subcategorias')->get();
        $subcategorias = Subcategoria::all();
        $marcas = Proveedores::all();
        $productos = Productos::with('proveedor','subcategoria')->orderBy('fecha_agregado', 'desc')->paginate(6);
        $medidas = [
            'pzas' => 'Piezas',
            'ml' => 'Mililitros',
            'lt' => 'Litros',
            'gr' => 'Gramos',
            'cm' => 'Centímetros',
        ];

        return view('dashboard.index', compact('productos', 'marcas', 'medidas', 'categorias', 'subcategorias'));
    }

    public function usuarios(Request $request)
    {
        // Obtener todos los usuarios con las relaciones de las demás tablas
        $usuarios = User::with([
            'persona',
            'persona.administrador',
            'persona.estilista',
            'persona.profesor',
            'persona.estudiante',
            'persona.comprador',
             'roles'
        ])->paginate(16);



        // Pasar los usuarios a la vista
        return view('dashboard.index', compact('usuarios'));
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
