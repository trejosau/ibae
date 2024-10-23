<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Productos::all();
        return view('tienda', compact('productos'));
    }

    public function filtrar(Request $request)
    {
        $query = Productos::query(); // Asegúrate de que el modelo sea el correcto
    
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }
    
        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }
    
        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }
    
        $productos = $query->get();
    
        return view('tienda', compact('productos')); // Cambiado a 'tienda'
    }
    
}
