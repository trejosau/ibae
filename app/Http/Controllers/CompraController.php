<?php

namespace App\Http\Controllers;

use App\Models\Compras;
use App\Models\DetalleCompra;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    public function agregar(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha' => 'required|date',
        ]);



        // Ejecutar el procedimiento almacenado
        try {
            DB::statement('CALL agregar_compra(?, ?)', [
                $request->proveedor_id,
                $request->fecha,
            ]);


            return redirect()->route('dashboard.compras')->with('success', 'Compra agregada exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores del procedimiento
            return redirect()->back()->with('error', 'Sucedio un error al agregar la compra: ' . $e->getMessage());
        }
    }


    public function detallarProducto($id)
    {
        $compra = Compras::find($id);
        $productos = Productos::where('id_proveedor', $compra->id_proveedor)->get();

        $resumen = DetalleCompra::where('id_compra', $compra->id)->with('producto')->get();



        return view('dashboard.detallar-producto', compact('compra', 'productos', 'resumen'));
    }

    public function agregarProducto(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'compra_id' => 'required|exists:compras,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        try {
            // Llamar al procedimiento almacenado
            DB::statement('CALL agregar_producto(?, ?, ?)', [
                $request->compra_id,
                $request->producto_id,
                $request->cantidad,
            ]);

            return redirect()->back()->with('success', 'Producto agregado o actualizado exitosamente.');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function quitarProducto(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'producto_id' => 'required|exists:detalle_compra,id_producto',
            'compra_id' => 'required|exists:detalle_compra,id_compra',
        ]);

        try {
            // Llamar al procedimiento almacenado
            DB::statement('CALL quitar_producto(?, ?)', [
                $request->producto_id,
                $request->compra_id,
            ]);

            return redirect()->back()->with('success', 'Producto eliminado del carrito.');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->back()->with('error', 'Error al eliminar el producto del carrito');
        }
    }

    public function limpiarCarrito($id)
    {
        try {
            DB::statement('CALL limpiar_carrito(?)', [$id]);

            return redirect()->back()->with('success', 'Carrito limpiado.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al limpiar el carrito');
        }
    }



}
