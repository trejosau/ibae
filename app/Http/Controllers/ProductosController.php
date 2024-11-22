<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\ProductoSubcategoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Productos;
use App\Models\Subcategoria;
use App\Models\Categorias;
use Illuminate\Http\Request;
use App\Models\Pedidos;
use Illuminate\Support\Facades\Storage;
use Intervention\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class ProductosController extends Controller
{

    public function mostrarPedidos()
    {
        $comprador = Auth::user()->persona->comprador;

       $pedidos = Pedidos::where('id_comprador', $comprador->id)
           ->with('detalles.producto')
           ->get();


        return view('mis-pedidos', compact('pedidos'));
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
        $id_subcategoria_1 = $data['id_subcategoria_1'];
        $id_subcategoria_2 = $data['id_subcategoria_2'];
        $id_subcategoria_3 = $data['id_subcategoria_3'];
        $stock = $data['stock'];
        $estado = $data['estado'];

        $producto = Productos::create([
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

        // Asignar subcategorías al producto
        if ($id_subcategoria_1) {
            ProductoSubcategoria::create([
                'id_producto' => $producto->id,
                'id_subcategoria' => $id_subcategoria_1,
            ]);
        }
        if ($id_subcategoria_2) {
            ProductoSubcategoria::create([
                'id_producto' => $producto->id,
                'id_subcategoria' => $id_subcategoria_2,
            ]);
        }
        if ($id_subcategoria_3) {
            ProductoSubcategoria::create([
                'id_producto' => $producto->id,
                'id_subcategoria' => $id_subcategoria_3,
            ]);
        }





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
            'nombre' => 'required|string|max:255|unique:productos,nombre',
            'descripcion' => 'required|string',
            'marca' => 'required|string|max:255',
            'precio_proveedor' => 'required|numeric|min:0',
            'precio_lista' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'medida' => 'required|string|max:50',
            'id_categoria' => 'required|exists:categorias,id',
            'id_subcategoria_1' => 'nullable|exists:subcategorias,id',
            'id_subcategoria_2' => 'nullable|exists:subcategorias,id',
            'id_subcategoria_3' => 'nullable|exists:subcategorias,id',
            'main_photo' => 'required|image|mimes:jpeg,png,jpg,webp',
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
        $categorias = Categorias::all(); // Obtiene todas las categorías
        return view('catalogo', compact('productos', 'categorias')); // Pasa productos y categorías a la vista
    }



    public function filtrar(Request $request)
    {
        $query = Productos::query();
        $categorias = Categorias::all();

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
        return view('catalogo', compact('productos', 'categorias'));
    }



    public function mostrarDetalle($id)
    {
        // Obtener el producto por su ID
        $producto = Productos::findOrFail($id);

        // Obtener productos relacionados de la misma categoría
        $productosRelacionados = Productos::where('id_categoria', $producto->id_categoria)
            ->where('id', '!=', $id) // Excluir el producto actual
            ->take(3) // Limitar a 4 productos relacionados
            ->get();

        // Obtener todas las categorías
        $categorias = Categorias::with('subcategorias')->get();

        // Pasar las variables 'producto', 'productosRelacionados' y 'categorias' a la vista
        return view('detalle', compact('producto', 'productosRelacionados', 'categorias'));
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

        $categorias = Categorias::with('subcategorias')->get();

        // Retornar la vista con ambos conjuntos de datos
        return view('tienda', [
            'productosMasVendidos' => $productosMasVendidos,
            'productosMasRecientes' => $productosMasRecientes,
            'categorias' => $categorias,
        ]);
    }




    public function agregarAlCarrito(Request $request, $id)
    {
        $producto = Productos::find($id);
        $esEstudiante = Auth::check() && Auth::user()->persona->estudiante ? 1 : 0;

        $cantidad = (int)$request->cantidad;

        if (!$producto || $cantidad <= 0 || $cantidad > $producto->stock) {
            return response()->json(['success' => false, 'message' => 'Cantidad inválida o insuficiente stock']);
        }

        $carrito = session()->get('carrito', []);



        if (isset($carrito[$id])) {
            // Asegúrate de no exceder el stock total
            if ($carrito[$id]['cantidad'] + $cantidad > $producto->stock) {
                return response()->json(['success' => false, 'message' => 'Cantidad excede el stock disponible']);
            }
            $carrito[$id]['cantidad'] += $cantidad;
        } else {
            $precio = $esEstudiante ? $producto->precio_lista : $producto->precio_venta; // Determinar precio según condición

            $carrito[$id] = [
                "nombre" => $producto->nombre,
                "precio" => $precio,
                "cantidad" => $cantidad,
                "main_photo" => $producto->main_photo
            ];
        }

        session()->put('carrito', $carrito);

        return response()->json(['success' => true, 'carrito' => $carrito]);
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
public function storeCategoria(Request $request)
{
        $request->validate([
            'nombre_categoria' => 'required|string|max:255|unique:categorias,nombre',
            'foto_categoria' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'crop_x_categoria' => 'nullable|numeric',
            'crop_y_categoria' => 'nullable|numeric',
            'crop_width_categoria' => 'nullable|numeric',
            'crop_height_categoria' => 'nullable|numeric',
        ]);



        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('foto_categoria')->getContent());
        if ($request->has('crop_x_categoria') && $request->has('crop_y_categoria') && $request->has('crop_width_categoria') && $request->has('crop_height_categoria')) {
            $image->crop(
                $request->input('crop_width_categoria'),
                $request->input('crop_height_categoria'),
                $request->input('crop_x_categoria'),
                $request->input('crop_y_categoria')
            );
        }


        $image = $image->toWebp(90);
        $fileName = "{$request->nombre_categoria}.webp";
        Storage::disk('s3')->put("images/categorias/{$fileName}", $image);

        $url = Storage::disk('s3')->url("images/categorias/{$fileName}");
        $categoria = Categorias::create([
            'nombre' => $request->nombre_categoria,
            'photo' => $url,
        ]);

        return redirect()->route('dashboard.productos')->with('success', 'Categoría creada exitosamente');
    }


    // Método para almacenar una nueva subcategoría
    public function storeSubcategoria(Request $request)
    {
        $request->validate([
            'nombre_subcategoria' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $cantidadSubcategorias = Subcategoria::where('categoria_id', $request->categoria_id)->count();

        if ($cantidadSubcategorias >= 3) {
            return redirect()->route('dashboard.productos')->with('error', 'No puedes tener más de 3 subcategorías por categoría elimina alguna.');
        }

        Subcategoria::create([
            'nombre' => $request->nombre_subcategoria,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('dashboard.productos')->with('success', 'Subcategoría creada exitosamente');
    }

    public function eliminarSubcategoriaProducto($productoId, $subcategoriaId)
    {
        $producto = Productos::findOrFail($productoId);
        $subcategoria = Subcategoria::findOrFail($subcategoriaId);

        // Elimina la subcategoría de la relación
        $producto->subcategoria()->detach($subcategoria->id);

        return redirect()->route('dashboard.productos')->with('success', 'Subcategoría eliminada');
    }

    public function agregarSubcategoria(Request $request, Productos $producto)
    {
        $request->validate([
            'subcategorias' => 'required|exists:subcategorias,id', // Validar que la subcategoría exista
        ]);

        $producto->subcategoria()->attach($request->subcategorias);

        return back()->with('success', 'Subcategoría agregada exitosamente.');
    }







    public function pago()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $carrito = session()->get('carrito', []);
        $subtotal = array_reduce($carrito, function ($total, $item) {
            return $total + $item['precio'] * $item['cantidad'];
        }, 0);

        $subtotal_in_cents = $subtotal * 100;

        // Crear la sesión de Stripe
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'mxn',
                        'product_data' => [
                            'name' => 'Carrito de compras',
                        ],
                        'unit_amount' => $subtotal_in_cents,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel'),
        ]);


        return redirect($session->url);
    }

    public function success(Request $request)
    {
        // Configurar la clave de API de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Obtener el session_id desde la URL de retorno
        $sessionId = $request->get('session_id');

        // Asegúrate de que el session_id sea válido y no esté vacío
        if (!$sessionId) {
            return redirect()->route('error');  // Redirigir a una página de error si el sessionId es inválido
        }

        // Intentar obtener la sesión de Stripe
        try {
            $session = Session::retrieve($sessionId);

            $usuario = Auth::user();

            $total = 0; // Inicializa el total en 0
            $descuentoTotal = 0; // Inicializa el descuento total en 0
            $estado = 'preparando para entrega';
            $claveEntrega = $this->generarClaveEntrega();
            $idComprador = $usuario->persona->comprador->id;
            $esEstudiante = $usuario->persona->estudiante ? 1 : 0;
            $idEstudiante = $usuario->persona->estudiante ? $usuario->persona->estudiante->matricula : null;
            $stripe_paymet_id = $session->payment_intent;
            $fechaPago = date('Y-m-d H:i:s', $session->created);
            $sessionCarrito = session()->get('carrito', []);

            // Crear el pedido
            $pedido = Pedidos::create([
                'total' => 0, // Será actualizado después de calcular el total
                'estado' => $estado,
                'clave_entrega' => $claveEntrega,
                'fecha-hora_pedido' => now(),
                'id_comprador' => $idComprador,
                'es_estudiante' => $esEstudiante,
                'id_estudiante' => $idEstudiante,
                'stripe_payment_id' => $stripe_paymet_id,
                'estado_pago' => 'completado',
                'fecha_pago' => $fechaPago,
            ]);

            // Procesar los productos del carrito
            foreach ($sessionCarrito as $index => $producto) {
                $productoId = $index;
                $productoRegistro = Productos::findOrFail($productoId);

                // Determinar el precio aplicado
                $precioAplicado = $esEstudiante
                    ? $productoRegistro->precio_lista
                    : $productoRegistro->precio_venta;

                // Calcular descuento por producto (si aplica)
                $descuento = $esEstudiante
                    ? $productoRegistro->precio_venta - $productoRegistro->precio_lista
                    : 0;

                // Actualizar el total y el descuento acumulado
                $total += $precioAplicado * $producto['cantidad'];
                $descuentoTotal += $descuento * $producto['cantidad'];

                // Crear el detalle del pedido
                DetallePedido::create([
                    'id_pedido' => $pedido->id,
                    'id_producto' => $productoId,
                    'cantidad' => $producto['cantidad'],
                    'precio_aplicado' => $precioAplicado,
                    'descuento' => $descuento,
                ]);
            }

            // Actualizar el total del pedido
            $pedido->update([
                'total' => $total,
            ]);

            return redirect()->route('tienda.mis-pedidos');

        } catch (\Stripe\Exception\UnexpectedValueException $e) {
            return redirect()->route('error')->with('error', 'Error al recuperar la sesión de pago.');
        }
    }

public function cancel()
{
return view('cancel');
}

    public function generarClaveEntrega()
    {
        $palabras = [
            'barberia', 'estilo', 'corte', 'barbero', 'afeitado', 'peluqueria', 'manicura', 'pedicura',
            'estilo', 'belleza', 'salon', 'cabello', 'coloracion', 'trenza', 'maquillaje', 'brillo',
            'cepillo', 'tinte', 'liso', 'rizado', 'barba', 'desvanecido', 'tijeras', 'cera'
        ];

        // Seleccionar una palabra aleatoria
        $palabra = $palabras[array_rand($palabras)];

        $numero = rand(1, 99);

        $claveEntrega = $palabra . $numero;


        return $claveEntrega;
    }


public function __construct()
{
    Stripe::setApiKey(env('sk_test_51QKnwPEU75Ud4jS0uyDd5ojyadWAeGWamhPjusVK5McEutT9OPV3BRS7ZF3yhi5jVQ68QaE12Nwj6eaes8FGjI7z00w466kkdN'));
}


public function obtenerCategorias()
{
    // Obtener categorías con sus subcategorías
    $categorias = Categorias::with('subcategorias')->get();
    return view('tuVista', compact('categorias'));
}


}
