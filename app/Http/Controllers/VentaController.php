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

    public function obtenerTotal() {
        $carrito = session()->get('carrito', []);
        $total = array_sum(array_map(function($p) {
            return (float)$p['precio'] * (int)$p['cantidad'];
        }, $carrito));

        return response()->json(['total' => number_format($total, 2)]);
    }



    public function buscarMatriculas(Request $request)
    {
        $query = $request->input('query');

        if (strlen($query) > 0) {
            $resultados = Estudiante::with('persona')
            ->where('matricula', 'LIKE', "{$query}%")
                ->limit(10)
                ->get(['matricula', 'id_persona']);

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
        session()->forget('carrito');

        return response()->json(['success' => true, 'carritoHtml' => '<li class="list-group-item text-center">No hay productos en el carrito</li>']);
    }



    public function store(Request $request)
    {
        $request->merge([
            'es_estudiante' => filter_var($request->input('es_estudiante'), FILTER_VALIDATE_BOOLEAN),
        ]);
        $request->validate([
            'es_estudiante' => 'required|boolean',
            'nombre_comprador' => 'required|string|max:255',
            'matricula' => 'nullable|string|max:20',
        ]);


        $id_usuario = auth()->id();

        $persona = Persona::where('usuario', $id_usuario)->first();

        if ($persona) {
            $id_admin = Administrador::where('id_persona', $persona->id)->value('id');
            if (!$id_admin) {
                return redirect()->back()->with('error', 'Administrador no encontrado');
            }
        } else {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        $es_estudiante = $request->es_estudiante ? 'si' : 'no';


        if ($es_estudiante === 'si') {
            $matricula = $request->matricula;
            $estudianteValido = Estudiante::where('matricula', $matricula)->exists();
            if (!$estudianteValido) {
                return redirect()->back()->with('error', 'El usuario con matricula ' . $matricula . ' no existe');
            }
        } else {
            $matricula = null;
        }

        $data = [
            'nombre_comprador' => $request->nombre_comprador,
            'fecha_compra' => now(),
            'total' => 0,
            'id_admin' => $id_admin,
            'es_estudiante' => $es_estudiante,
            'matricula' => $matricula,
        ];

        $venta = Ventas::create($data);

        if ($venta) {
            $carrito = session()->get('carrito', []);
            $total = 0;

            foreach ($carrito as $productoId => $detalle) {
                $producto = Productos::find($productoId);

                if ($producto) {
                    $precio_aplicado = $request->es_estudiante ? $producto->precio_lista : $producto->precio_venta;

                    $descuento = $producto->precio_venta - $precio_aplicado;

                    DetalleVenta::create([
                        'id_venta' => $venta->id,
                        'id_producto' => $productoId,
                        'cantidad' => $detalle['cantidad'],
                        'precio_aplicado' => $precio_aplicado,
                        'descuento' => $descuento,
                    ]);

                    $total += $precio_aplicado * $detalle['cantidad'];
                }
            }


            $venta->update(['total' => $total]);

            session()->forget('carrito');

            return redirect()->back()->with('success', 'Venta registrada con éxito');
        } else {
            return redirect()->back()->with('error', 'Error al registrar la venta');
        }
    }
    public function eliminar(Request $request, $id)
    {
        $venta = Ventas::find($id);
        $venta->delete();
        return redirect()->back()->with('success', 'Venta eliminada con éxito');
    }






    public function agregarProducto(Request $request)
    {
        $productoId = $request->input('producto_id');
        $cantidad = $request->input('cantidad', 1);

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
