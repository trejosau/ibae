<?php

namespace App\Http\Controllers;

use App\Models\Compras;
use App\Models\DetalleCompra;
use App\Models\Productos;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function detallarProducto($id)
    {
        $compra = Compras::find($id);
        $productos = Productos::where('id_proveedor', $compra->id_proveedor)->get();

        $resumen = DetalleCompra::where('id_compra', $compra->id)->with('producto')->get();



        return view('dashboard.detallar-producto', compact('compra', 'productos', 'resumen'));
    }

    public function agregarProducto(Request $request)
    {
        $compraId = $request->input('compra_id');
        $productoId = $request->input('producto_id');
        $cantidad = $request->input('cantidad', 1);

        // Check if the product already exists in the current purchase
        $detalleCompra = DetalleCompra::where('id_compra', $compraId)
            ->where('id_producto', $productoId)
            ->first();

        if ($detalleCompra) {
            // If the product exists, update the quantity
            $detalleCompra->cantidad += $cantidad;
            $detalleCompra->save();
            return redirect()->back()->with('success', 'Cantidad actualizada en el carrito.');
        } else {
            // If the product does not exist, create a new record
            DetalleCompra::create([
                'id_compra' => $compraId,
                'id_producto' => $productoId,
                'cantidad' => $cantidad
            ]);
            return redirect()->back()->with('success', 'Producto agregado al carrito.');
        }
    }


    public function quitarProducto(Request $request)
    {
        $productoId = $request->input('producto_id');
        $compraId = $request->input('compra_id');

        DetalleCompra::where('id_producto', $productoId)->where('id_compra', $compraId)->delete();

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    public function limpiarCarrito($id)
    {
        DetalleCompra::where('id_compra', $id)->delete();
        return redirect()->back()->with('success', 'Carrito limpiado.');
    }

    public function obtenerTotal()
    {

    }
}
