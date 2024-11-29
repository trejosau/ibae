<?php

namespace App\Http\Controllers;

use App\Models\Entregas;
use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function marcarListo($id)
    {
        $user = auth()->user();

        $pedido = Pedidos::find($id);
        $pedido->estado = 'listo para entrega';
        $pedido->save();

        $entrega = Entregas::create([
            'id_pedido' => $pedido->id,
            'id_admin' => $user->Persona->Administrador->id,
            'fecha_hora_entregado' => null,
            'fecha_hora_listo_entregar' => now(),
            'estado' => 'listo entregar',
            'nombre_recolector' => null,
        ]);



        return redirect()->back()->with('success', 'Pedido actualizado con éxito.');
    }

    public function marcarEntregado(Request $request, $id)
    {

        // Validar el campo 'nombreRecogido' como obligatorio
        $validatedData = $request->validate([
            'nombreRecogido' => 'required|string|max:99',
        ], [
            'nombreRecogido.required' => 'El campo de entrega es obligatorio.',
            'nombreRecogido.max' => 'El nombre de quien recoge no debe exceder los 99caracteres.',
        ]);



        // Encontrar el pedido
        $pedido = Pedidos::find($id);

        $user = auth()->user();

        $entrega = Entregas::where('id_pedido', $pedido->id)->first();

        if ($pedido && $entrega) {
            $pedido->estado = 'entregado';
            $pedido->entrega->nombre_recolector = $request->input('nombreRecogido');
            $pedido->entrega->save();
            $pedido->save();

            $entrega->fecha_hora_entregado = now();
            $entrega->nombre_recolector = $request->input('nombreRecogido');
            $entrega->save();

            return redirect()->back()->with('success', 'Pedido actualizado con éxito.');
        } else {
            // Manejo de error en caso de que el pedido o la entrega no existan
            return redirect()->back()->with('error', 'Pedido o entrega no encontrado.');
        }
    }


}
