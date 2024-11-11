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
        // Validación de los campos
        $request->validate([
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
        ]);

        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $marca = $request->input('marca');
        $precio_proveedor = $request->input('precio_proveedor');
        $precio_lista = $request->input('precio_lista');
        $precio_venta = $request->input('precio_venta');
        $cantidad = $request->input('cantidad');
        $medida = $request->input('medida');
        $id_categoria = $request->input('id_categoria');
        $stock = $request->input('stock');
        $estado = $request->input('estado');

        $url = null;

        // Subir imagen si está presente
        if ($request->hasFile('main_photo')) {

                // Obtener la imagen cargada
                $image = $request->file('main_photo');

                $manager = new ImageManager(new Driver());

                $image = $manager->read($image->getContent());

            if ($request->has('crop_x') && $request->has('crop_y') && $request->has('crop_width') && $request->has('crop_height')) {

                $cropX = $request->input('crop_x');
                $cropY = $request->input('crop_y');
                $cropWidth = $request->input('crop_width');
                $cropHeight = $request->input('crop_height');


                $image = $image->crop($cropWidth, $cropHeight, $cropX, $cropY);
            }

                $image = $image->toWebp(90);


                // Normalizar el nombre del archivo
                $FileName = $nombre . '_' . $cantidad . '_' . $medida . '.' . 'webp';

                // Subir la imagen a S3 dentro de la carpeta 'productos/'
                $path = Storage::disk('s3')->put('images/productos/' . $FileName, $image);


                // Obtener la URL de la imagen cargada en S3
                $url = Storage::disk('s3')->url('images/productos/' . $FileName);
            }

            // Crear el producto
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




            // Redirigir con mensaje de éxito
            return redirect()->back()->with('success', 'Producto agregado correctamente.');
        }



    public function actualizar(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'precio_venta' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|in:activo,inactivo',
            'main_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
        ]);

        // Buscar el producto en la base de datos
        $producto = Productos::findOrFail($id);

        // Actualizar los campos
        $producto->nombre = $request->nombre;
        $producto->id_categoria = $request->categoria_id;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock = $request->stock;
        $producto->estado = $request->estado;

        // Manejo de la imagen (si se sube una nueva)
        if ($request->hasFile('main_photo')) {
            // Eliminar la imagen anterior si existe en S3
            if ($producto->main_photo) {
                $filePath = parse_url($producto->main_photo, PHP_URL_PATH);
                Storage::disk('s3')->delete(ltrim($filePath, '/'));
            }

            // Subir la nueva imagen
            $nombre = $producto->nombre;
            $cantidad = $producto->cantidad;
            $medida = $producto->medida;
            $image = $request->file('main_photo');
            $extension = $image->getClientOriginalExtension();

            // Generar un nuevo nombre de archivo
            $FileName = $nombre . '_' . $cantidad . '_' . $medida . '.' . $extension;

            $path = Storage::disk('s3')->put('images/productos/' . $FileName, file_get_contents($image));

            $producto->main_photo = Storage::disk('s3')->url('images/productos/' . $FileName);
        }

        // Guardar los cambios en la base de datos
        $producto->save();

        // Redireccionar con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto actualizado correctamente.');
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
