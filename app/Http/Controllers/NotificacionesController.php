<?php

namespace App\Http\Controllers;

use App\Models\Notificaciones;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    public function marcarLeida($id)
    {
        $notificacion = Notificaciones::find($id);
        $notificacion->leida_at = now();
        $notificacion->save();

        return redirect()->back()->with('success', 'Notificación marcada como leída.');
    }
}
