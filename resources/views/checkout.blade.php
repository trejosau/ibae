@extends('layouts.app')

@section('content')
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

            <!-- Mostrar cada producto sumando el total -->
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

            <!-- Opciones de pago con botones de radio -->
            <div class="payment-methods">
                <label class="custom-radio">
                    <input type="radio" name="paymentMethod" value="cash" checked> Pago en Efectivo
                    <span class="radio-checkmark"></span>
                </label>
                <label class="custom-radio">
                    <input type="radio" name="paymentMethod" value="card"> Pago con Tarjeta
                    <span class="radio-checkmark "></span>
                </label>
            </div>

            <button onclick="confirmarPago()" class="checkout-button">Proceder al Pago</button>
        </div>
    </div>
</div>
@endsection

<script>
function confirmarPago() {
    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
    
    if (paymentMethod === 'cash') {
        alert("Procediendo con el pago en efectivo...");
    } else {
        alert("Procediendo con el pago con tarjeta...");
    }

    // Aquí puedes agregar la lógica para redirigir a la pasarela de pago dependiendo del tipo de pago seleccionado
}
</script>

<style>
/* Estilos generales */
.checkout-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 30px;
    background-color: #f9f9f9;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    color: #333;
    font-family: Arial, sans-serif;
}

.checkout-container h2 {
    text-align: center;
    font-size: 2rem;
    color: #333;
    margin-bottom: 25px;
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 10px;
}

.checkout-content {
    display: flex;
    justify-content: space-between;
    gap: 25px;
}

.checkout-items {
    flex: 3;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.checkout-item {
    display: flex;
    align-items: center;
    gap: 15px;
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 15px;
}

.product-img-container {
    width: 90px;
    height: 90px;
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
    gap: 4px;
}

.product-name {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
}

.product-price, .product-quantity, .product-total {
    font-size: 0.95rem;
    color: #666;
}

/* Estilo del resumen de los productos */
.checkout-summary {
    flex: 1;
    padding: 25px;
    background-color: #ffffff;
    border-radius: 10px;
    border: 1px solid #e0e0e0;
    text-align: center;
}

.checkout-summary h3 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 15px;
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 10px;
}

.order-summary {
    text-align: left;
    font-size: 1.1rem;
    margin-bottom: 25px;
}

.order-item {
    margin: 8px 0;
    font-size: 1.1rem;
    color: #666;
}

.order-total {
    font-weight: bold;
    font-size: 1.4rem;
    color: #ff9b9b; /* Rosa más claro */
}

.subtotal-amount {
    color: #333;
}

/* Estilos personalizados para los botones de radio */
.payment-methods {
    margin-top: 20px;
    margin-bottom: 25px;
    font-size: 1.1rem;
    color: #333;
}

.custom-radio {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    cursor: pointer;
    font-size: 1.1rem;
}

.custom-radio input[type="radio"] {
    display: none;
}

.custom-radio .radio-checkmark {
    width: 22px;
    height: 22px;
    border: 2px solid #333; /* Color más suave */
    border-radius: 50%; /* Esto hace el radio button redondeado */
    background-color: transparent;
    margin-right: 10px;
    position: relative;
    transition: all 0.3s ease;
}

.custom-radio input[type="radio"]:checked + .radio-checkmark {
    background-color: #333; /* Color del radio button seleccionado */
}

.custom-radio input[type="radio"]:focus + .radio-checkmark {
    border-color: #333; /* Color al enfocar */
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}

/* Botón de pago */
.checkout-button {
    margin-top: 20px;
    padding: 12px 25px;
    background-color: #333; /* Gris oscuro */
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
