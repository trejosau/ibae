<?php

// DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.index');
    }

    public function inicio() {
        return view('dashboard.index');
    }

    public function ventas() {
        return view('dashboard.index');
    }

    public function academia() {
        return view('dashboard.index');
    }

    public function salon() {
        return view('dashboard.index');
    }

    public function tienda() {
        return view('dashboard.index');
    }

    public function productos() {
        return view('dashboard.index');
    }

    public function reportes() {
        return view('dashboard.index');
    }
}
