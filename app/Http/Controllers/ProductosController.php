<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Productos::all();
        return view('tienda', compact('productos'));
    }

    public function agregar(Request $request)
    {
        $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'marca' => 'nullable|string|max:255',
                'precio_proveedor' => 'required|numeric|min:0',
                'precio_lista' => 'required|numeric|min:0',
                'precio_venta' => 'required|numeric|min:0',
                'cantidad' => 'required|integer|min:0',
                'medida' => 'nullable|string|max:50',
                'id_proveedor' => 'required|exists:proveedores,id',
                'id_categoria' => 'required|exists:categorias,id',
                'main_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'stock' => 'required|integer|min:0',
                'estado' => 'required|in:activo,inactivo',
        ]);

        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $marca = $request->input('marca');
        $precio_proveedor = $request->input('precio_proveedor');
        $precio_lista = $request->input('precio_lista');
        $precio_venta = $request->input('precio_venta');
        $cantidad = $request->input('cantidad');
        $medida = $request->input('medida');

        if ($request->hasFile('main_photo')) {
            $image = $request->file('main_photo');
            // implementar todas imagenes mismo formato y tamano cuadrado






            $extension = $image->getClientOriginalExtension();

            $FileName = $nombre . '_' . $cantidad . '_' . $medida . '.' . $extension;

            // Subir la imagen a S3 dentro de la carpeta 'productos/'
            $path = Storage::disk('s3')->put('images/productos/' . $FileName, file_get_contents($image));

            // Obtener la URL de la imagen cargada
            $url = Storage::disk('s3')->url('images/productos/' . $FileName);
        }

        Productos::create([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'marca' => $marca,
            'precio_proveedor' => $precio_proveedor,
            'precio_lista' => $precio_lista,
            'precio_venta' => $precio_venta,
            'cantidad' => $cantidad,
            'medida' => $medida,
            'id_proveedor' => $request->input('id_proveedor'),
            'id_categoria' => $request->input('id_categoria'),
            'main_photo' => $url,
            'stock' => $request->input('stock'),
            'estado' => $request->input('estado'),
            'fecha_agregado' => now(),
        ]);

        return redirect()->back()->with('success', 'Producto agregado correctamente.');
    }


    public function catalogo()
    {
        $productos = Productos::all(); // Obtiene todos los productos
        return view('catalogo', compact('productos')); // Devuelve la vista con todos los productos
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




    public function agregarAlCarrito(Request $request, $id)
    {
        $producto = Productos::find($id);
        $cantidad = $request->cantidad;

        if ($producto) {
            $carrito = session()->get('carrito', []);
            if (isset($carrito[$id])) {
                $carrito[$id]['cantidad'] += $cantidad;
            } else {
                $carrito[$id] = [
                    "nombre" => $producto->nombre,
                    "precio" => $producto->precio_venta,
                    "cantidad" => $cantidad,
                    "main_photo" => $producto->main_photo  // Agregar la imagen aquí
                ];
            }
            session()->put('carrito', $carrito);
            return response()->json(['success' => true, 'carrito' => $carrito]);
        }

        return response()->json(['success' => false]);
    }



public function verCarrito(Request $request)
{
    $carrito = session()->get('carrito', []);
    $subtotal = array_reduce($carrito, function ($total, $item) {
        return $total + $item['precio_venta'] * $item['cantidad'];
    }, 0);

    if ($request->wantsJson()) {
        return response()->json([
            'carrito' => $carrito,
            'subtotal' => $subtotal
        ]);
    }

    return view('carrito', compact('carrito'));
}


public function eliminarDelCarrito($id)
{
    $carrito = session()->get('carrito', []);

    if (isset($carrito[$id])) {
        unset($carrito[$id]);
        session()->put('carrito', $carrito);
        return response()->json(['success' => true, 'message' => 'Producto eliminado del carrito.']);
    }

    return response()->json(['success' => false, 'message' => 'Producto no encontrado en el carrito.'], 404);
}


    public function cargarContenidoCarrito()
{
    $carrito = session()->get('carrito', []);
    $subtotal = array_reduce($carrito, function ($total, $item) {
        return $total + $item['precio'] * $item['cantidad'];
    }, 0);

    return response()->json([
        'carrito' => $carrito,
        'subtotal' => $subtotal
    ]);
}



public function buscar(Request $request)
{
    $query = $request->input('query');

    // Busca en la base de datos productos que coincidan con el nombre exacto
    $producto = Productos::where('nombre', $query)->first();

    if ($producto) {
        // Redirige a la vista de detalles del producto si se encuentra
        return redirect()->route('producto.detalle', ['id' => $producto->id]);
    } else {
        // Si no encuentra ningún producto, redirige a la tienda con un mensaje de error
        return redirect()->route('tienda')->with('error', 'Producto no encontrado');
    }
}



}
