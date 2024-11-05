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
            ->take(4) // Limitar a 3 productos relacionados
            ->get();
    
        return view('detalle', compact('producto', 'productosRelacionados'));
    }
    

    public function mostrar()
    {
        // Consulta para los productos más vendidos
        $productosMasVendidos = Productos::withSum('detallePedidos as cantidad_total_vendida', 'cantidad')
            ->where('estado', 'activo')
            ->orderBy('cantidad_total_vendida', 'desc')
            ->take(10)
            ->get();

        // Consulta para los productos más recientes
        $productosMasRecientes = Productos::where('estado', 'activo')
            ->orderBy('fecha_agregado', 'desc')
            ->take(10)
            ->get();

        // Retornar la vista con ambos conjuntos de datos
        return view('tienda', [
            'productosMasVendidos' => $productosMasVendidos,
            'productosMasRecientes' => $productosMasRecientes,
        ]);
    }
    
    

    
}

