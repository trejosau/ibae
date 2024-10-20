<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $followersCount = null;

        // Verifica si la ruta actual es 'dashboard.inicio'
        if ($request->route()->named('dashboard.inicio')) {
            $followersCount = $this->fetchFollowers();
        }


        return view('dashboard.index', compact('followersCount'));
    }

    private function fetchFollowers()
    {
        // Construir la ruta al script de Node.js
        $scriptPath = resource_path('js/fetchFollowers.js');

        // Ejecutar el script de Node.js
        $output = shell_exec("node $scriptPath");
        return trim($output); // Devuelve el resultado del script
    }
}
