<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles del Pedido</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('components.navbarTienda')

    <div class="checkout-container">
        <h2>Detalles del Pedido</h2>

        <div class="checkout-content">
            <div class="checkout-items">
                @foreach($carrito as $id => $producto)
                    <div class="checkout-item">
                        <div class="product-img-container">
                            <img src="{{ $producto['main_photo'] ?? '/ruta/a/imagen-placeholder.jpg' }}" alt="{{ $producto['nombre'] }}" class="product-img">
                        </div>
                        <div class="product-details">
                            <h4 class="product-name">{{ $producto['nombre'] }}</h4>
                            <p class="product-price">Precio unitario: ${{ number_format($producto['precio'], 2) }}</p>
                            <p class="product-quantity">Cantidad: {{ $producto['cantidad'] }}</p>
                            <p class="product-total">Total: ${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="checkout-summary">
                <h3>Resumen del Pedido</h3>

                <div class="order-summary">
                    <p class="order-item">Subtotal de Productos:</p>
                    @php $subtotal = 0; @endphp
                    @foreach($carrito as $producto)
                        @php
                            $subtotal += $producto['precio'] * $producto['cantidad'];
                        @endphp
                        <p class="order-item">
                            {{ $producto['nombre'] }}: ${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}
                        </p>
                    @endforeach

                    <p class="order-total">Subtotal: <span class="subtotal-amount">${{ number_format($subtotal, 2) }}</span></p>
                </div>

                <div class="payment-methods">
                    <label class="custom-radio">
                        <input type="radio" name="paymentMethod" value="cash" checked> Pago en Efectivo
                        <span class="radio-checkmark"></span>
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="paymentMethod" value="card"> Pago con Tarjeta
                        <span class="radio-checkmark"></span>
                    </label>
                </div>

                <button onclick="confirmarPago()" class="checkout-button">Proceder al Pago</button>
            </div>
        </div>
    </div>

    <script>
        function confirmarPago() {
            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;

            if (paymentMethod === 'cash') {
                alert("Procediendo con el pago en efectivo...");
            } else {
                alert("Procediendo con el pago con tarjeta...");
            }
        }
    </script>

    <style>
       /* Estilos generales */
.checkout-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 40px; /* Aumenta el padding para más espacio */
    background-color: #f9f9f9;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    color: #333;
}

/* Título principal */
.checkout-container h2 {
    text-align: center;
    font-size: 2rem;
    color: #333;
    margin-bottom: 30px; /* Más espacio debajo del título */
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 10px;
}

/* Contenido principal */
.checkout-content {
    display: flex;
    justify-content: space-between;
    gap: 40px; /* Aumenta el espacio entre las columnas */
}

/* Productos */
.checkout-items {
    flex: 3;
    display: flex;
    flex-direction: column;
    gap: 30px; /* Aumenta el espacio entre los productos */
}

/* Elemento individual de producto */
.checkout-item {
    display: flex;
    align-items: center;
    gap: 20px; /* Aumenta el espacio entre los elementos dentro de un producto */
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 20px; /* Aumenta el padding dentro de cada producto */
}

/* Contenedor de la imagen del producto */
.product-img-container {
    width: 90px;
    height: 90px;
    border-radius: 8px;
    overflow: hidden;
    background-color: #f0f0f0;
}

/* Imagen del producto */
.product-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Detalles del producto */
.product-details {
    display: flex;
    flex-direction: column;
    gap: 6px; /* Más espacio entre los detalles del producto */
}

/* Nombre del producto */
.product-name {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
}

/* Precio y cantidad */
.product-price, .product-quantity, .product-total {
    font-size: 0.95rem;
    color: #666;
}

/* Resumen del pedido */
.checkout-summary {
    flex: 1;
    padding: 30px; /* Más padding */
    background-color: #ffffff;
    border-radius: 10px;
    border: 1px solid #e0e0e0;
    text-align: center;
}

/* Título del resumen */
.checkout-summary h3 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 20px; /* Más espacio debajo del título */
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 10px;
}

/* Resumen de la orden */
.order-summary {
    text-align: left;
    font-size: 1.1rem;
    margin-bottom: 30px; /* Más espacio entre los elementos */
}

/* Items de la orden */
.order-item {
    margin: 10px 0;
    font-size: 1.1rem;
    color: #666;
}

/* Total de la orden */
.order-total {
    font-weight: bold;
    font-size: 1.4rem;
    color: #ff9b9b; /* Rosa más claro */
}

.subtotal-amount {
    color: #333;
}

/* Métodos de pago */
.payment-methods {
    margin-top: 30px; /* Más margen superior */
    margin-bottom: 30px; /* Más margen inferior */
    font-size: 1.1rem;
    color: #333;
}

/* Estilo de los botones de radio */
.custom-radio {
    display: flex;
    align-items: center;
    margin-bottom: 20px; /* Más espacio entre las opciones de pago */
    cursor: pointer;
    font-size: 1.1rem;
}

.custom-radio input[type="radio"] {
    display: none;
}

.custom-radio .radio-checkmark {
    width: 24px;
    height: 24px;
    border: 2px solid #333; /* Color más suave */
    border-radius: 50%;
    background-color: transparent;
    margin-right: 12px; /* Más espacio entre el radio y el texto */
    position: relative;
    transition: all 0.3s ease;
}

.custom-radio input[type="radio"]:checked + .radio-checkmark {
    background-color: #333; /* Color cuando está seleccionado */
}

.custom-radio input[type="radio"]:focus + .radio-checkmark {
    border-color: #333; /* Color al enfocar */
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}

/* Botón de proceder al pago */
.checkout-button {
    margin-top: 30px; /* Más espacio superior */
    padding: 14px 30px; /* Aumenta el padding */
    background-color: #333;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: background-color 0.2s ease, transform 0.2s ease;
}

.checkout-button:hover {
    background-color: #555; /* Gris más claro */
    transform: scale(1.05);
}

.checkout-button:active {
    background-color: #222; /* Gris más oscuro */
    transform: scale(1.02);
}

    </style>

    @include('components.footer')

</body>
</html>
