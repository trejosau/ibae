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
    
        $productos = $query->get(); 
    
        return view('tienda', compact('productos'));
        
    }
    
    public function mostrarDetalle($id)
    {
        $producto = Productos::findOrFail($id);
        
        // Suponiendo que tienes una lógica para obtener productos relacionados
        $productosRelacionados = Productos::where('id_categoria', $producto->id_categoria)
            ->where('id', '!=', $id) // Excluir el producto actual
            ->take(3) // Limitar a 3 productos relacionados
            ->get();
    
        return view('detalle', compact('producto', 'productosRelacionados'));
    }
    



    
}

