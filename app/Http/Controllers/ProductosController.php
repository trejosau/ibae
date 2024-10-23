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
    $query = Productos::query();

    // Filtrar por id_categoria si se selecciona una categoría
    if ($request->filled('id_categoria')) {
        $query->where('id_categoria', $request->id_categoria);
    }

    // Filtrar por precio mínimo si está establecido
    if ($request->filled('precio_min')) {
        $query->where('precio_venta', '>=', $request->precio_min);
    }

    // Filtrar por precio máximo si está establecido
    if ($request->filled('precio_max')) {
        $query->where('precio_venta', '<=', $request->precio_max);
    }

    // Obtener los productos filtrados
    $productos = $query->get();

    return view('tienda', compact('productos'));
}

    
}
