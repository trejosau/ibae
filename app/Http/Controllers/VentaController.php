<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class VentaController extends Controller
{
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
