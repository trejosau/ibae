<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;

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
}
