<?php

namespace App\Http\Controllers;

use App\Models\Administrador;

use App\Models\Auditoria;
use App\Models\Categorias;
use App\Models\DetalleCompra;
use App\Models\DetalleCita;
use App\Models\Subcategoria;
use App\Models\Categorias_de_Servicios;
use App\Models\Citas;
use App\Models\Colegiaturas;
use App\Models\Comprador;
use App\Models\Compras;
use Carbon\Carbon;
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

    public function ventaDestroy($id)
    {
        $venta = Ventas::find($id);
        $venta->delete();
        return redirect()->route('dashboard.ventas')->with('success', 'Venta eliminada exitosamente.');
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

    public function compraDetallada($id)
    {
        // Inicializamos la variable para el total
        $total = 0;

        // Obtener la compra junto con los detalles de los productos
        $compra = Compras::find($id);

        // Verificar si la compra existe
        if ($compra) {
            // Obtener los detalles de la compra
            $detalleCompras = DetalleCompra::where('id_compra', $id)->get();

            // Calcular el total sumando el precio * cantidad de cada producto en la compra
            foreach ($detalleCompras as $detalle) {
                $producto = Productos::find($detalle->id_producto);
                if ($producto) {
                    $total += $producto->precio_proveedor * $detalle->cantidad;
                }
            }

            // Actualizar el estado y el total de la compra
            $compra->estado = 'pendiente de entrega';
            $compra->total = $total;
            $compra->save();
        }

        // Redirigir al dashboard de compras
        return redirect()->route('dashboard.compras');
    }


    public function compraEntregada($id)
    {
        // Buscar la compra
        $compra = Compras::find($id);

        // Cambiar el estado de la compra a 'entregado'
        $compra->estado = 'entregado';
        $compra->fecha_entrega = now();
        $compra->save();

        // Obtener los detalles de la compra (productos y cantidades)
        $detalleCompra = DB::table('detalle_compra')
            ->where('id_compra', $id)
            ->get(['id_producto', 'cantidad']); // Obtener producto y cantidad de la compra

        foreach ($detalleCompra as $detalle) {
            // Obtener el producto
            $producto = Productos::find($detalle->id_producto);  // Busca el producto por su ID

            // Si el producto no existe, saltamos al siguiente
            if (!$producto) {
                continue;
            }

            // Actualizar el stock del producto
            $producto->stock += $detalle->cantidad;
            $producto->save();

            // Si el stock es mayor que 0, cambiar el estado del producto a 'activo'
            if ($producto->stock > 0) {
                $producto->estado = 'activo';
                $producto->save();
            }
        }

        // Redirigir con mensaje de éxito
        return redirect()->route('dashboard.compras')->with('success', 'Compra actualizada y stock de productos actualizado automáticamente.');
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
        // Cargar todos los proveedores y paginación específica
        $todosLosProveedores = Proveedores::all();
        $proveedores = Proveedores::paginate(4, ['*'], 'proveedores_page');
        $proveedores->load(['productos' => function ($query) {
            $query->whereIn('estado', ['activo', 'agotado']);
        }]);

        // Cargar compras ordenadas por fecha
        $compras = Compras::with('proveedor')
            ->orderBy('fecha_compra', 'desc')
            ->paginate(6, ['*'], 'compras_page');

        $stockMin = $request->input('stock_min', 0);
        $stockMax = $request->input('stock_max', PHP_INT_MAX);
        $proveedorId = $request->input('proveedor', null);

        $productosQuery = Productos::where('estado', '!=', 'inactivo');

        // Aplicar filtro dinámico según valores ingresados
        if ($stockMin !== null) {
            $productosQuery->where('stock', '>=', $stockMin);
        }

        if ($stockMax !== null) {
            $productosQuery->where('stock', '<=', $stockMax);
        }

        if ($proveedorId !== null) {
            $productosQuery->where('id_proveedor', $proveedorId);
        }

        $productos = $productosQuery
            ->with('proveedor')
            ->paginate(10, ['*'], 'productos_page')->onEachSide(2);

        $catalogoProductos = Productos::where('estado', '!=', 'inactivo')->get();

        // Gestión de notificaciones
        $filtro = $request->get('filtro'); // Obtener filtro de URL
        $notificacionesQuery = Notificaciones::where('user_id', auth()->id());

        if ($filtro === 'leidas') {
            $notificacionesQuery->whereNotNull('leida_at');
        } elseif ($filtro === 'no-leidas') {
            $notificacionesQuery->whereNull('leida_at');
        }

        $notificaciones = $notificacionesQuery->get();

        // Retornar la vista con las variables necesarias
        return view('dashboard.index', compact(
            'proveedores',
            'compras',
            'productos',
            'catalogoProductos',
            'notificaciones',
            'todosLosProveedores'
        ));
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
        $estilistas = Estilista::all();
        $servicios = Servicios::all();
        $detalleCitas = DetalleCita::all();

        // Aplicar filtros
        $query = Citas::query()->with(['comprador', 'detalleCita.servicio']);

        if ($request->filled('nombre')) {
            $query->whereHas('comprador.persona', function ($query) use ($request) {
                $query->where('nombre', 'like', '%' . $request->nombre . '%');
            });
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fecha_hora_creacion', $request->fecha);
        }

        if ($request->filled('estado')) {
            $query->where('estado_cita', $request->estado);
        }

        $citas = $query->paginate(10)->through(function ($cita) {
            $cita->fecha_inicio = $cita->fecha_hora_inicio_cita->format('Y-m-d');
            $cita->hora_inicio = $cita->fecha_hora_inicio_cita->format('H:i:s');
            $cita->total_servicios = $cita->detalleCita->sum(function ($detalle) {
                return $detalle->servicio->precio;
            });
            return $cita;
        });

        return view('dashboard.index', compact('estilistas', 'citas', 'servicios', 'detalleCitas'));
    }



    public function registrarCita(Request $request)
    {
        // Validación de datos
        $validatedData = $request->validate([
            'cliente' => 'required|string|max:255',
            'estilista_id' => 'required|exists:estilistas,id',
            'fecha_hora_inicio_cita' => 'required|date',
            'estado_cita' => 'required|in:programada,cancelada,completada',
            'servicios' => 'required|array|min:1',
            'servicios.*' => 'exists:servicios,id',
        ]);

        // Calcular el total sumando los precios de los servicios
        $total = 0;
        foreach ($validatedData['servicios'] as $servicioId) {
            $servicio = Servicios::findOrFail($servicioId); // Asume que tienes un modelo Servicio
            $total += $servicio->precio;
        }

        // Crear la cita
        $cita = Citas::create([
            'id_estilista' => $validatedData['estilista_id'],
            'cliente' => $validatedData['cliente'],
            'fecha_hora_creacion' => now(),
            'fecha_hora_inicio_cita' => $validatedData['fecha_hora_inicio_cita'],
            'total' => $total,
            'estado_cita' => $validatedData['estado_cita'],
            'id_comprador' => null,
            'fecha_hora_fin_cita' => null,
            'anticipo' => 0,
            'pago_restante' => 0,
            'estado_pago' => 'concluido',
            'nueva_fecha_hora_inicio_cita' => null,
            'motivo_reprogramacion' => null,
        ]);

        // Registrar servicios en detalle_cita
        foreach ($validatedData['servicios'] as $servicioId) {
            DetalleCita::create([
                'id_cita' => $cita->id,
                'id_servicio' => $servicioId,
            ]);
        }

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Cita registrada exitosamente.');
    }

    public function reprogramar(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
        ]);

        // Buscar la cita por ID
        $cita = Citas::findOrFail($id);

        // Actualizar la fecha y hora
        $cita->update([
            'fecha_hora_creacion' => $request->input('fecha') . ' ' . $request->input('hora'),
            'estado_cita' => 'reprogramada', // Actualizamos el estado a 'reprogramada'
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'La cita se ha reprogramado con éxito.');
    }

    public function concluirPago($id)
{
    // Buscar la cita por ID
    $cita = Citas::findOrFail($id);

    // Actualizar los campos de pago
    $cita->update([
        'estado_pago' => 'Concluido',
        'anticipo' => 0,
        'pago_restante' => 0,
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->back()->with('success', 'El pago se ha concluido correctamente.');




}


public function completarCita($id)
{
    // Encuentra la cita
    $cita = Citas::findOrFail($id);

    // Verifica que la cita no esté ya completada
    if ($cita->estado_cita == 'completada') {
        return redirect()->back()->with('error', 'La cita ya está completada.');
    }

    // Actualiza los valores
    $cita->estado_cita = 'completada';

    // Guarda los cambios
    $cita->save();

    return redirect()->back()->with('success', 'Cita completada y pago actualizado.');
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
        // Obtener el término de búsqueda desde el request
        $buscar = $request->get('buscar');

        // Obtener las categorías, subcategorías y marcas
        $categorias = Categorias::with('subcategorias')->get();
        $subcategorias = Subcategoria::all();
        $marcas = Proveedores::all();

        // Filtrar productos si se proporciona el término de búsqueda
        $productos = Productos::with('proveedor', 'subcategoria')
            ->when($buscar, function($query, $buscar) {
                return $query->where('nombre', 'like', "%{$buscar}%");
            })
            ->orderBy('fecha_agregado', 'desc')
            ->paginate(6);

        // Definir las medidas
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
        // Obtener los parámetros del filtro
        $nombre = $request->input('nombre');
        $ap_paterno = $request->input('ap_paterno');
        $ap_materno = $request->input('ap_materno');
        $username = $request->input('username');
        $rol = $request->input('rol');

        // Construir la consulta
        $usuarios = User::with([
            'persona',
            'persona.administrador',
            'persona.estilista',
            'persona.profesor',
            'persona.estudiante',
            'persona.comprador',
            'roles'
        ]);

        if ($username) {
            $usuarios = $usuarios->where('username', 'like', '%'.$username.'%');
        }

        // Filtro por Nombre
        if ($nombre) {
            $usuarios = $usuarios->whereHas('persona', function($query) use ($nombre) {
                $query->where('nombre', 'like', '%'.$nombre.'%');
            });
        }

        if ($ap_paterno) {
            $usuarios = $usuarios->whereHas('persona', function($query) use ($ap_paterno) {
                $query->where('ap_paterno', 'like', '%'.$ap_paterno.'%');
            });
        }

        if ($ap_materno) {
            $usuarios = $usuarios->whereHas('persona', function($query) use ($ap_materno) {
                $query->where('ap_materno', 'like', '%'.$ap_materno.'%');
            });
        }


        // Filtro por Rol
        if ($rol) {
            $usuarios = $usuarios->whereHas('persona', function($query) use ($rol) {
                $query->whereHas($rol);
            });
        }

        // Obtener los usuarios con paginación
        $usuarios = $usuarios->paginate(12);

        // Pasar los usuarios a la vista
        return view('dashboard.index', compact('usuarios'));
    }

    public function auditoria(Request $request)
    {
        $auditorias = Auditoria::where('operacion', '!=', 'INSERT')->orderBy('fecha', 'desc')->paginate(10);
        return view('dashboard.index' , compact('auditorias'));
    }

    public function profile(Request $request)
    {
        return view('dashboard.index');
    }

}
