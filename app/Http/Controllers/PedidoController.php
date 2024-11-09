<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function marcarListo($id)
    {
        $pedido = Pedidos::find($id);
        $pedido->estado = 'listo para entrega';
        $pedido->save();

        return redirect()->back()->with('success', 'Pedido actualizado con éxito.');
    }

    public function marcarEntregado(Request $request, $id)
    {

        // Validar el campo 'nombreRecogido' como obligatorio
        $request->validate([
            'nombreRecogido' => 'required|string|max:99',
        ], [
            'nombreRecogido.required' => 'El campo de entrega es obligatorio.',
            'nombreRecogido.max' => 'El nombre de quien recoge no debe exceder los 99caracteres.',
        ]);

        // Encontrar el pedido
        $pedido = Pedidos::find($id);

        if ($pedido && $pedido->entrega) {
            // Actualizar el estado del pedido y el nombre del recolector
            $pedido->estado = 'entregado';
            $pedido->entrega->nombre_recolector = $request->input('nombreRecogido');
            $pedido->entrega->save();
            $pedido->save();

            return redirect()->back()->with('success', 'Pedido actualizado con éxito.');
        } else {
            // Manejo de error en caso de que el pedido o la entrega no existan
            return redirect()->back()->with('error', 'Pedido o entrega no encontrado.');
        }
    }


}
