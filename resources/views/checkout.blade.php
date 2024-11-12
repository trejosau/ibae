@extends('layouts.app')

@section('content')
<div class="checkout-container">
    <h2>Detalles del Pedido</h2>

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
        <p>Subtotal: <span class="subtotal-amount">${{ number_format($subtotal, 2) }}</span></p>
        <button onclick="confirmarPago()" class="checkout-button">Proceder al Pago</button>
    </div>
</div>
@endsection

<script>
function confirmarPago() {
    alert("Redirigiendo a la pasarela de pago...");
    // Aquí puedes redirigir a la pasarela de pago
}
</script>

<style>
/* Estilos generales */
.checkout-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f7f9fc;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.checkout-container h2, .checkout-container h3 {
    text-align: center;
    color: #333;
}

/* Estilos para los productos */
.checkout-items {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
}

.checkout-item {
    display: flex;
    align-items: center;
    gap: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.product-img-container {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
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
    color: #333;
    font-weight: 600;
}

.product-price, .product-quantity, .product-total {
    color: #555;
    font-size: 0.95rem;
}

/* Estilos para el resumen del pedido */
.checkout-summary {
    margin-top: 30px;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.subtotal-amount {
    font-weight: 600;
    font-size: 1.3rem;
    color: #333;
}

/* Estilos para el botón de pago */
.checkout-button {
    margin-top: 20px;
    padding: 12px 20px;
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.checkout-button:hover {
    background-color: #45a049;
}
</style>
