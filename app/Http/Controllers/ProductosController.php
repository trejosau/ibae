<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Productos::all();
        return view('tienda', compact('productos'));
    }

    public function agregar(Request $request)
    {
        $data = $request->validate($this->validationRules());

        $url = $this->processImage($request, $data['nombre'], $data['cantidad'], $data['medida']);

        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $marca = $data['marca'];
        $precio_proveedor = $data['precio_proveedor'];
        $precio_lista = $data['precio_lista'];
        $precio_venta = $data['precio_venta'];
        $cantidad = $data['cantidad'];
        $medida = $data['medida'];
        $id_categoria = $data['id_categoria'];
        $stock = $data['stock'];
        $estado = $data['estado'];

        Productos::create([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio_proveedor' => $precio_proveedor,
            'precio_lista' => $precio_lista,
            'precio_venta' => $precio_venta,
            'cantidad' => $cantidad,
            'medida' => $medida,
            'id_proveedor' => $marca,
            'id_categoria' => $id_categoria,
            'main_photo' => $url,
            'stock' => $stock,
            'estado' => $estado,
            'fecha_agregado' => now(),
        ]);


        return redirect()->back()->with('success', 'Producto agregado correctamente.');
    }

    public function actualizar(Request $request, $id)
    {


        // Validate the incoming request
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'precio_proveedor' => 'required|numeric|min:0',
            'precio_lista' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'medida' => 'required|string',
            'id_categoria' => 'required|exists:categorias,id',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|in:activo,inactivo',
            'crop_x' => 'nullable|numeric',
            'crop_y' => 'nullable|numeric',
            'crop_width' => 'nullable|numeric',
            'crop_height' => 'nullable|numeric',
            'main_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        // Find the product to update
        $producto = Productos::findOrFail($id);

        // Handle image processing if a new image is uploaded
        $url = $this->processImage($request, $data['nombre'], $data['cantidad'], $data['medida']);

        if ($url === null) {
            $url = $producto->main_photo;
        }
        $producto->update([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'precio_proveedor' => $data['precio_proveedor'],
            'precio_lista' => $data['precio_lista'],
            'precio_venta' => $data['precio_venta'],
            'cantidad' => $data['cantidad'],
            'medida' => $data['medida'],
            'id_categoria' => $data['id_categoria'],
            'stock' => $data['stock'],
            'estado' => $data['estado'],
            'main_photo' => $url,
            ]);



        // Redirect back with a success message
        return redirect()->back()->with('success', 'Producto actualizado correctamente.');
    }

    private function validationRules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'marca' => 'nullable|string|max:255',
            'precio_proveedor' => 'required|numeric|min:0',
            'precio_lista' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'medida' => 'nullable|string|max:50',
            'id_categoria' => 'required|exists:categorias,id',
            'main_photo' => 'nullable|image|mimes:jpeg,png,jpg',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|in:activo,inactivo',
        ];
    }

    private function processImage($request, $nombre, $cantidad, $medida)
    {
        if (!$request->hasFile('main_photo')) {
            return null;
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('main_photo')->getContent());


        if ($request->has('crop_x') && $request->has('crop_y') && $request->has('crop_width') && $request->has('crop_height')) {
            $image->crop(
                $request->input('crop_width'),
                $request->input('crop_height'),
                $request->input('crop_x'),
                $request->input('crop_y')
            );
        }

        $image = $image->toWebp(90);
        $fileName = "{$nombre}_{$cantidad}_{$medida}.webp";
        Storage::disk('s3')->put("images/productos/{$fileName}", $image);
        return Storage::disk('s3')->url("images/productos/{$fileName}");
    }


    public function retirar(Request $request, $id)
    {
        // Buscar el producto en la base de datos
        $producto = Productos::findOrFail($id);

        $producto->estado = 'inactivo';
        $producto->save();

        return redirect()->back()->with('success', 'Producto retirado correctamente.');
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

public function checkout()
{
    $carrito = session()->get('carrito', []);
    $subtotal = array_reduce($carrito, function ($total, $item) {
        return $total + $item['precio'] * $item['cantidad'];
    }, 0);

    return view('checkout', compact('carrito', 'subtotal'));
}


public function updateQuantityInCheckout(Request $request, $id)
{
    
    $carrito = session()->get('carrito', []);

    if (isset($carrito[$id])) {
        $cantidadActual = $carrito[$id]['cantidad'];
        $nuevaCantidad = $cantidadActual + $request->input('amount');

        // Verificación para evitar cantidades menores a 1
        if ($nuevaCantidad < 1) {
            return response()->json(['success' => false, 'message' => 'La cantidad mínima es 1']);
        }

        // Actualizar cantidad y total del producto
        $carrito[$id]['cantidad'] = $nuevaCantidad;
        $carrito[$id]['total'] = $carrito[$id]['precio'] * $nuevaCantidad;

        // Actualizar la sesión
        session()->put('carrito', $carrito);
        session()->save(); // <-- Esta línea asegura que los cambios se guarden

        // Calcular subtotal
        $subtotal = array_reduce($carrito, function ($total, $item) {
            return $total + $item['precio'] * $item['cantidad'];
        }, 0);

        return response()->json([
            'success' => true,
            'newQuantity' => $nuevaCantidad,
            'newTotal' => $carrito[$id]['total'],
            'subtotal' => $subtotal
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Producto no encontrado en el carrito']);
}



}
