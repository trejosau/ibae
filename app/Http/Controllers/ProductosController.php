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

    public function eliminarSubcategoria($id)
        {
            $subcategoria = Subcategoria::find($id);

            $subcategoria->Categories()->detach();
            $subcategoria->delete();
            return redirect()->back();
        }

    public function catalogo()
    {
        $productos = Productos::all(); // Obtiene todos los productos
        $categorias = Categorias::with('subcategorias')->get(); // Obtiene todas las categorías
        return view('catalogo', compact('productos', 'categorias')); // Pasa productos y categorías a la vista
    }


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

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string' => 'El nombre del producto debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del producto no puede tener más de 255 caracteres.',
            'nombre.unique' => 'Ya existe un producto con este nombre.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'marca.required' => 'La marca es obligatoria.',
            'marca.string' => 'La marca debe ser una cadena de texto.',
            'marca.max' => 'La marca no puede tener más de 255 caracteres.',
            'precio_proveedor.required' => 'El precio proveedor es obligatorio.',
            'precio_proveedor.numeric' => 'El precio proveedor debe ser un número.',
            'precio_proveedor.min' => 'El precio proveedor no puede ser negativo.',
            'precio_lista.required' => 'El precio de lista es obligatorio.',
            'precio_lista.numeric' => 'El precio de lista debe ser un número.',
            'precio_lista.min' => 'El precio de lista no puede ser negativo.',
            'precio_venta.required' => 'El precio de venta es obligatorio.',
            'precio_venta.numeric' => 'El precio de venta debe ser un número.',
            'precio_venta.min' => 'El precio de venta no puede ser negativo.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad no puede ser negativa.',
            'medida.required' => 'La medida es obligatoria.',
            'medida.string' => 'La medida debe ser una cadena de texto.',
            'medida.max' => 'La medida no puede tener más de 50 caracteres.',
            'id_categoria.required' => 'La categoría es obligatoria.',
            'id_categoria.exists' => 'La categoría seleccionada no existe.',
            'id_subcategoria_1.exists' => 'La subcategoría 1 seleccionada no existe.',
            'id_subcategoria_2.exists' => 'La subcategoría 2 seleccionada no existe.',
            'id_subcategoria_3.exists' => 'La subcategoría 3 seleccionada no existe.',
            'main_photo.required' => 'La foto principal es obligatoria.',
            'main_photo.image' => 'La foto principal debe ser una imagen.',
            'main_photo.mimes' => 'La foto principal debe ser de tipo jpeg, png, jpg o webp.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',
            'estado.required' => 'El estado del producto es obligatorio.',
            'estado.in' => 'El estado debe ser activo o inactivo.',
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
    // Buscar el producto en la base de datos usando el ID
    $producto = Productos::find($id);
    $esEstudiante = Auth::check() && Auth::user()->persona->estudiante ? 1 : 0;

    // Obtener la cantidad seleccionada por el usuario
    $cantidad = (int) $request->cantidad;

    // Validaciones de cantidad y existencia en stock
    if (!$producto || $cantidad <= 0 || $cantidad > $producto->stock) {
        return response()->json(['success' => false, 'message' => 'Cantidad inválida o insuficiente stock']);
    }

    // Obtener el carrito actual desde la sesión
    $carrito = session()->get('carrito', []);

    // Verificar si el producto ya está en el carrito
    if (isset($carrito[$id])) {
        // Si ya está en el carrito, verificar que la cantidad no exceda el stock
        if ($carrito[$id]['cantidad'] + $cantidad > $producto->stock) {
            return response()->json(['success' => false, 'message' => 'Cantidad excede el stock disponible']);
        }
        // Incrementar la cantidad en el carrito
        $carrito[$id]['cantidad'] += $cantidad;
    } else {
        // Si el producto no está en el carrito, agregarlo
        $precio = $esEstudiante ? $producto->precio_lista : $producto->precio_venta;

        // Agregar el producto al carrito con su información
        $carrito[$id] = [
            'id' => $producto->id, // Usamos 'id' como referencia del producto
            'nombre' => $producto->nombre,
            'precio' => $precio,
            'cantidad' => $cantidad,
            'main_photo' => $producto->main_photo,
        ];
    }

    // Guardar el carrito actualizado en la sesión
    session()->put('carrito', $carrito);

    // Retornar respuesta con el carrito actualizado
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





public function checkout()
{
    // Obtener el carrito desde la sesión
    $carrito = session()->get('carrito', []);
    $productos_actualizados = [];
    $errores_stock = [];

    // Iterar sobre los productos en el carrito
    foreach ($carrito as $id => $item) {
        // Buscar el producto en la base de datos utilizando el 'id' almacenado en el carrito
        $producto = Productos::find($id);

        $user = auth()->user();

        $precioAplicado = $producto->precio_venta;

        if ($user->hasRole('estudiante')) {
            $precioAplicado = $producto->precio_lista;
        }


        if ($producto) {
            // Verificar si el stock disponible es suficiente
            if ($producto->stock >= $item['cantidad']) {
                // Producto con stock suficiente
                $productos_actualizados[] = [
                    'id_producto' => $id,  // Usar el 'id' como referencia
                    'nombre' => $producto->nombre,
                    'precio' => $precioAplicado,
                    'cantidad' => $item['cantidad'],
                    'main_photo' => $producto->main_photo
                ];
            } else {
                // Producto sin stock suficiente
                $errores_stock[] = [
                    'nombre' => $producto->nombre,
                    'stock_disponible' => $producto->stock,
                    'cantidad_solicitada' => $item['cantidad']
                ];
            }
        }
    }

    // Calcular el subtotal solo para los productos válidos
    $subtotal = array_reduce($productos_actualizados, function ($total, $item) {
        return $total + $item['precio'] * $item['cantidad'];
    }, 0);

    if ($errores_stock) {

        // Eliminar el carrito de la sesión
        session()->forget('carrito');
        // Redirigir con mensaje de error
        return redirect()->back()->with('error', 'Tenias algun prodcuto con stock insuficiente tu carrito se ha eliminado.');
    }
    // Retornar la vista con los datos procesados
    return view('checkout', compact('productos_actualizados', 'subtotal', 'errores_stock'));
}

public function storeCategoria(Request $request)
{
    $request->validate([
        'nombre_categoria' => 'required|string|max:255|unique:categorias,nombre|regex:/^[\pL\s]+$/u',
    ]);

    $categoria = Categorias::create([
            'nombre' => $request->nombre_categoria,
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

        $productoIds = array_keys($carrito);

        $productosStock = Productos::whereIn('id', $productoIds)
            ->get(['id', 'stock'])
            ->pluck('stock', 'id'); // Obtiene un arreglo clave => valor de stock por id

        $productosAEliminar = []; // Arreglo para almacenar los productos a eliminar

        // Recorremos el carrito y verificamos la cantidad
        foreach ($carrito as $id => $producto) {
            // Verifica si la cantidad del producto es mayor que el stock
            if ($producto['cantidad'] > ($productosStock[$id] ?? 0)) {
                // Agrega el producto al arreglo de eliminación
                $productosAEliminar[] = $id;
            }
        }

        // Si hay productos a eliminar, los eliminamos del carrito y redirigimos
        if (!empty($productosAEliminar)) {
            // Elimina los productos que exceden el stock
            foreach ($productosAEliminar as $id) {
                unset($carrito[$id]);
            }

            // Actualiza el carrito en la sesión
            session()->put('carrito', $carrito);

            // Redirecciona con el mensaje de error
            return redirect('/tienda')->with('error', 'Uno o más productos de tu carrito se agotaron, intenta de nuevo.');
        }


        $subtotal = array_reduce($carrito, function ($total, $item) {
            return $total + $item['precio'] * $item['cantidad'];
        }, 0);

        $subtotal_in_cents = $subtotal * 100;


        foreach ($carrito as $index => $producto) {
            $productoId = $index;
            $productoRegistro = Productos::findOrFail($productoId);

            $productoRegistro->stock -= $producto['cantidad'];
            if ($productoRegistro->stock = 0) {
                $productoRegistro->estado = 'agotado';
            }
            $productoRegistro->save();
        }

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
                'total' => 0,
                'estado' => $estado,
                'clave_entrega' => $claveEntrega,
                'fecha_hora_pedido' => now(),
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
                $productoRegistro->stock += $producto['cantidad'];
                $productoRegistro->save(); // Guardar el cambio de stock
                // Verificar si hay suficiente stock disponible
                if ($productoRegistro->stock < $producto['cantidad']) {
                    throw new \Exception('Stock insuficiente para el producto solicitado.');
                }

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

            // Eliminar el carrito de la sesión
            session()->forget('carrito');

            return redirect()->route('tienda.mis-pedidos');

        } catch (\Stripe\Exception\UnexpectedValueException $e) {
            return redirect()->route('error')->with('error', 'Error al recuperar la sesión de pago.');
        }
    }


    public function cancel()
    {
        $carrito = session()->get('carrito', []);

        foreach ($carrito as $index => $producto) {
            $productoId = $index;
            $productoRegistro = Productos::findOrFail($productoId);

            $productoRegistro->stock += $producto['cantidad'];
            $productoRegistro->save();
        }

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





}
