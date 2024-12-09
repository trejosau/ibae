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
        // Obtenemos al estilista autenticado
        $estilista = Auth::user()->persona?->estilista;
    
        if (!$estilista) {
            return redirect()->back()->with('error', 'No tienes citas asignadas.');
        }
    
        // Obtenemos las citas del estilista, incluyendo comprador, detalleCita y servicio
        $citas = Citas::where('id_estilista', $estilista->id)
            ->with(['comprador.persona', 'detalleCita.servicio'])
            ->orderBy('fecha_hora_inicio_cita', 'asc')
            ->get();
    
        // Retornamos la vista con las citas del estilista
        return view('salon.miagenda', compact('citas'));
    }
    

    public function miscitas()
    {
        // Obtenemos al comprador autenticado
        $comprador = Auth::user()->persona?->comprador;
    
        if (!$comprador) {
            return redirect()->back()->with('error', 'No tienes citas registradas.');
        }
    
        // Obtenemos las citas del comprador, incluyendo estilista, detalleCita y servicio
        $citas = Citas::where('id_comprador', $comprador->id)
        ->with(['estilista.persona', 'detalleCita.servicio'])
        ->orderBy('fecha_hora_inicio_cita', 'asc')
        ->get();
    
    
    
        // Depuración opcional para verificar los datos
     
    
        return view('salon.miscitas', compact('citas'));
    }

    

}
