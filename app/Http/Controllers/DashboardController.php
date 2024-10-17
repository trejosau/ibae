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

    public function compras() {
        return view('dashboard.index');
    }

    public function citas() {
        return view('dashboard.index');
    }

    public function servicios() {
        return view('dashboard.index');
    }

}
