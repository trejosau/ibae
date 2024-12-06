<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Citas;


class SalonController extends Controller
{
    public function index()
    {
        return view('salon.index');
    }
    public function agendar(){
        $servicios = Servicios::all();
        return view('salon.agendar' , compact('servicios'));
    }
    public function confirmar(){
        return view('salon.confirmarCita');
    }

    public function miagenda()
    {
        return view('salon.miagenda');
    }

    public function miscitas()
    {
        // Obtenemos al comprador autenticado
        $comprador = Auth::user()->persona?->comprador;
    
        // Verificamos si no es un comprador válido
        if (!$comprador) {
            return redirect()->back()->with('error', 'No tienes citas registradas.');
        }
    
        // Obtenemos las citas del comprador, incluyendo estilista y detalle_cita con servicios
        $citas = Citas::where('id_comprador', $comprador->id)
            ->with(['estilista', 'detallecita.servicio'])
            ->orderBy('fecha_hora_inicio_cita', 'asc')
            ->get();
    
        return view('salon.miscitas', compact('citas'));
    }
    

    public function cancelarCita($id)
    {
        $cita = Citas::findOrFail($id);

        if ($cita->id_comprador !== Auth::user()->persona?->comprador?->id) {
            return redirect()->route('miscitas')->with('error', 'No puedes cancelar esta cita.');
        }

        if (in_array($cita->estado_cita, ['completada', 'cancelada'])) {
            return redirect()->route('miscitas')->with('error', 'No puedes cancelar una cita completada o ya cancelada.');
        }

        $cita->update(['estado_cita' => 'cancelada']);
        return redirect()->route('miscitas')->with('success', 'Cita cancelada exitosamente.');
    }
}
