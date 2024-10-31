<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\DetalleVenta;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\Productos;
use App\Models\Ventas;
use Illuminate\Http\Request;

class VentaController extends Controller
{

    public function buscarMatriculas(Request $request)
    {
        $query = $request->input('query');

        // Asegúrate de que el query tenga al menos 1 carácter
        if (strlen($query) > 0) {
            // Busca las matrículas y carga la relación con persona
            $resultados = Estudiante::with('persona') // Cargar la relación persona
            ->where('matricula', 'LIKE', "{$query}%")
                ->limit(10)
                ->get(['matricula', 'id_persona']); // Asegúrate de incluir 'id_persona' para obtener la relación

            // Mapea los resultados para incluir el nombre de persona
            $resultadosConNombre = $resultados->map(function($estudiante) {
                return [
                    'matricula' => $estudiante->matricula,
                    'nombre' => $estudiante->persona->nombre ?? 'Nombre no disponible',
                    'ap_paterno' => $estudiante->persona->ap_paterno ?? 'No disponible',
                ];
            });

            return response()->json($resultadosConNombre);
        }

        return response()->json([]);
    }




    public function limpiarCarrito()
    {
        session()->forget('carrito'); // Limpia el carrito de la sesión

        return response()->json(['success' => true, 'carritoHtml' => '<li class="list-group-item text-center">No hay productos en el carrito</li>']);
    }



    public function store(Request $request)
    {
        // Obtener el ID del usuario autenticado
        $id_usuario = auth()->id();

        // Obtener la información de la persona correspondiente al usuario
        $persona = Persona::where('usuario', $id_usuario)->first();

        if ($persona) {
            $id_admin = Administrador::where('id_persona', $persona->id)->value('id');
            if (!$id_admin) {
                return redirect()->back()->with('error', 'Administrador no encontrado');
            }
        } else {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        // Verificar si el usuario es estudiante y validar la existencia de la matrícula
        $es_estudiante = $request->es_estudiante ? 'si' : 'no';
        $matricula = $request->matricula;

        if ($es_estudiante === 'si') {
            // Verificar que la matrícula existe en la tabla de estudiantes
            $estudianteValido = Estudiante::where('matricula', $matricula)->exists();
            if (!$estudianteValido) {
                return redirect()->back()->with('error', 'El usuario con matricula ' . $matricula . ' no existe');
            }
        } else {
            // Si no es estudiante, se asigna null a la matrícula
            $matricula = null;
        }

        // Crear un array con los datos del request
        $data = [
            'nombre_comprador' => $request->nombre_comprador,
            'fecha_compra' => now(),
            'total' => 0, // Total inicial
            'id_admin' => $id_admin,
            'es_estudiante' => $es_estudiante,
            'matricula' => $matricula,
        ];

        // Intentar crear la venta
        $venta = Ventas::create($data);

        // Verificar si se creó correctamente
        if ($venta) {
            // Recuperar el carrito
            $carrito = session()->get('carrito', []);
            $total = 0;

            foreach ($carrito as $productoId => $detalle) {
                $producto = Productos::find($productoId); // Obtener el producto para acceder a los precios
                if ($producto) {
                    // Determinar el precio aplicado
                    if ($request->es_estudiante) {
                        $precio_aplicado = $producto->precio_venta; // Precio para no estudiantes
                        $descuento = 0; // Sin descuento para no estudiantes
                    } else {
                        $precio_aplicado = $producto->precio_lista; // Precio para estudiantes
                        $descuento = $producto->precio_venta - $precio_aplicado; // Descuento para estudiantes
                    }

                    // Crear el detalle de venta
                    DetalleVenta::create([
                        'id_venta' => $venta->id, // ID de la venta recién creada
                        'id_producto' => $productoId,
                        'cantidad' => $detalle['cantidad'], // Guardar cantidad
                        'precio_aplicado' => $precio_aplicado,
                        'descuento' => $descuento,
                    ]);

                    // Calcular el total acumulado (precio_aplicado * cantidad)
                    $total += $precio_aplicado * $detalle['cantidad'];
                }
            }

            // Actualizar el total en la venta
            $venta->update(['total' => $total]);

            // Borrar el carrito de la sesión
            session()->forget('carrito');

            return redirect()->back()->with('success', 'Venta registrada con éxito');
        } else {
            return redirect()->back()->with('error', 'Error al registrar la venta');
        }
    }






    public function agregarProducto(Request $request)
    {
        $productoId = $request->input('producto_id');
        $cantidad = $request->input('cantidad', 1);

        // Lógica para agregar el producto a la venta en la sesión
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad'] += $cantidad;
        } else {
            $producto = Productos::findOrFail($productoId);
            $carrito[$productoId] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio_venta,
                'cantidad' => $cantidad
            ];
        }

        session()->put('carrito', $carrito);

        return response()->json([
            'success' => true,
            'carritoHtml' => view('partials.carrito', compact('carrito'))->render()
        ]);
    }

    public function quitarProducto(Request $request)
    {
        $productoId = $request->input('producto_id');

        // Lógica para quitar el producto de la venta en la sesión
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$productoId])) {
            unset($carrito[$productoId]);
            session()->put('carrito', $carrito);
        }

        return response()->json([
            'success' => true,
            'carritoHtml' => view('partials.carrito', compact('carrito'))->render()
        ]);
    }
}
