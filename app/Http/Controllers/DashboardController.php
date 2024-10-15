<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->renderDashboardView('Inicio');
    }

    public function opcion1()
    {
        return $this->renderDashboardView('Opción 1');
    }

    public function opcion2()
    {
        return $this->renderDashboardView('Opción 2');
    }

    public function opcion3()
    {
        return $this->renderDashboardView('Opción 3');
    }

    public function opcion4()
    {
        return $this->renderDashboardView('Opción 4');
    }

    public function opcion5()
    {
        return $this->renderDashboardView('Opción 5');
    }

    private function renderDashboardView($lugar)
    {
        // Obtén el usuario autenticado
        $user = Auth::user();

        // Obtén roles y permisos del usuario
        $roles = $user->getRoleNames(); // Retorna una colección de roles
        $permissions = $user->getAllPermissions(); // Retorna una colección de permisos

        // Datos a pasar a la vista
        $data = [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'lugar' => $lugar,
        ];

        // Devuelve la vista del dashboard
        return view('dashboard.index', $data);
    }
}
