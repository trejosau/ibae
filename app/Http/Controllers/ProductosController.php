<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
    
        // Filtrar por categoría
        if ($request->filled('id_categoria')) {
            $query->where('id_categoria', $request->id_categoria);
        }
    
        // Filtrar por rango de precios
        if ($request->filled('precio_min')) {
            $query->where('precio_venta', '>=', $request->precio_min);
        }
    
        if ($request->filled('precio_max')) {
            $query->where('precio_venta', '<=', $request->precio_max);
        }
    
        $productos = $query->get();
    
        // Asegúrate de redirigir a la vista correcta
        return view('catalogo', compact('productos'));
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
    

    public function productosMasVendidos()
{
    $productosMasVendidos = DB::table('detalle_pedido')
        ->select('id_producto', DB::raw('SUM(cantidad) as total_vendido'))
        ->groupBy('id_producto')
        ->orderBy('total_vendido', 'desc')
        ->take(6) // Limitar a los 6 productos más vendidos
        ->pluck('id_producto');

    // Obtener los detalles de los productos más vendidos
    $productos = Productos::whereIn('id', $productosMasVendidos)->get();

    return view('tienda', compact('productos'));
}




    
}

