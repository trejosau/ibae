<?php

// DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.index'); // Muestra la vista principal
    }

    public function inicio() {
        return view('dashboard.index'); // Muestra el contenido de inicio
    }

    public function ventas() {
        return view('dashboard.index'); // Muestra el contenido de ventas
    }

    public function academia() {
        return view('dashboard.index'); // Muestra el contenido de academia
    }

    public function salon() {
        return view('dashboard.index'); // Muestra el contenido de salón
    }

    public function tienda() {
        return view('dashboard.index'); // Muestra el contenido de tienda
    }

    public function productos() {
        return view('dashboard.index'); // Muestra el contenido de productos
    }

    public function reportes() {
        return view('dashboard.index'); // Muestra el contenido de reportes
    }
}
