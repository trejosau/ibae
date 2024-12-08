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
    
        if (!$comprador) {
            return redirect()->back()->with('error', 'No tienes citas registradas.');
        }
    
        // Obtenemos las citas del comprador, incluyendo estilista, detalleCita y servicio
        $citas = Citas::where('id_comprador', $comprador->id)
        ->with(['estilista.persona', 'detalleCita.servicio'])
        ->orderBy('fecha_hora_inicio_cita', 'asc')
        ->get();
    
    
    
        // Depuración opcional para verificar los datos
        // dd($citas);
    
        return view('salon.miscitas', compact('citas'));
    }

    

}
