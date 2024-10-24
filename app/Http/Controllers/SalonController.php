<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalonController extends Controller
{
    public function index()
    {
        return view('salon.index');
    }
    public function agendar(){
        return view('salon.agendar');
    }
    public function confirmar(){
        return view('salon.confirmarCita');
    }
}
