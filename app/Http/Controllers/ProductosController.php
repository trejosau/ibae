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
    
        if ($request->has('id_categoria') && $request->id_categoria !== '') {
            $query->where('id_categoria', $request->id_categoria);
        }
    
        if ($request->has('precio_min') && $request->precio_min !== '') {
            $query->where('precio_venta', '>=', $request->precio_min);
        }
    
        if ($request->has('precio_max') && $request->precio_max !== '') {
            $query->where('precio_venta', '<=', $request->precio_max);
        }
    
        $productos = $query->get(); // Obtener productos filtrados
    
        return view('tienda', compact('productos')); // Retornar a la vista de tienda
        
    }
    


    
}
