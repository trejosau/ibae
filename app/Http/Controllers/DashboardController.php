<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
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
        ];

        // Devuelve la vista del dashboard
        return view('dashboard.index', $data);
    }
}
