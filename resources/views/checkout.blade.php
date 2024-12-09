
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles del Pedido</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="main-container">
        <a href="/tienda" class="back-link">← Volver a la tienda</a>

        <div class="checkout-container">
            <h2>Detalles del Pedido</h2>

            <div class="checkout-content">
                <!-- Lista de Productos -->
                <div class="checkout-items">
                    @if(!empty($productos_actualizados) && count($productos_actualizados) > 0)
                        @foreach($productos_actualizados as $producto)
                            <div class="checkout-item">
                                <div class="product-img-container">
                                    <img src="{{ $producto['main_photo'] }}" alt="{{ $producto['nombre'] }}" class="product-img">
                                </div>
                                <div class="product-details">
                                    <h4 class="product-name">{{ $producto['nombre'] }}</h4>
                                    <p class="product-price">Precio: ${{ number_format($producto['precio'], 2) }}</p>
                                    <p class="product-quantity">Cantidad: {{ $producto['cantidad'] }}</p>
                                    <p class="product-total">Total: ${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No hay productos en el carrito.</p>
                    @endif
                </div>

                <!-- Resumen del Pedido -->
                <div class="checkout-summary">
                    <h3>Resumen del Pedido</h3>

                    <div class="order-summary">
                        <div class="order-item">Subtotal de Productos :</div>
                        @if(isset($subtotal) && $subtotal > 0)
                            <div class="subtotal">
                                <h3>Subtotal: ${{ number_format($subtotal, 2) }}</h3>
                            </div>
                        @else
                            <p>No hay productos válidos en el pedido.</p>
                        @endif
                    </div>

                    @if(!empty($errores_stock))
                        <div class="stock-errors">
                            <h3>Errores de Stock</h3>
                            <ul>
                                @foreach($errores_stock as $error)
                                    <li>
                                        {{ $error['nombre'] }} - Stock disponible: {{ $error['stock_disponible'] }}, solicitado: {{ $error['cantidad_solicitada'] }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pago') }}" method="POST">
                        @csrf
                        <button type="submit" class="checkout-button" @if(empty($productos_actualizados)) disabled @endif>
                            Proceder al Pago
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <style>
        /* Contenedor Principal */
        .main-container {
            padding-top: 50px;
            padding-bottom:70px;
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 20px;
            padding-right: 20px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            font-size: 1.1rem;
            color: #333;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .checkout-container {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        .checkout-container h2 {
            text-align: center;
            font-size: 2rem;
            color: #333;
            margin-bottom: 30px;
        }

        /* Estructura Principal */
        .checkout-content {
            display: grid;
            gap: 30px;
        }

        @media (min-width: 768px) {
            .checkout-content {
                grid-template-columns: 2fr 1fr;
            }
        }

        /* Productos */
        .checkout-items {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .checkout-item {
            display: flex;
            align-items: center;
            gap: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            transition: box-shadow 0.3s ease;
        }

        .checkout-item:hover {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        /* Imagen del Producto */
        .product-img-container {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            background-color: #f0f0f0;
        }

        .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-details {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .product-price, .product-quantity, .product-total {
            font-size: 0.9rem;
            color: #666;
        }

        /* Resumen del Pedido */
        .checkout-summary {
            padding: 25px;
            background-color: #fff;
            border-radius: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .checkout-summary h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .order-summary {
            text-align: left;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .order-item {
            margin: 10px 0;
            font-size: 1rem;
            color: #555;
        }

        .order-total {
            font-weight: bold;
            font-size: 1.3rem;
            color: #ff5a5f;
            margin-top: 10px;
        }

        .subtotal-amount {
            color: #333;
        }

        /* Botón de Pago */
        .checkout-button {
            margin-top: 20px;
            padding: 15px 25px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .checkout-button:hover {
            background-color: #444;
        }
    </style>



    @include('components.footer')

</body>
</html>
