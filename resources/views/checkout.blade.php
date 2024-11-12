@extends('layouts.app')

@section('content')
<div class="checkout-container">
    <h2>Detalles del Pedido</h2>

    <div class="checkout-items">
        @foreach($carrito as $id => $producto)
            <div class="checkout-item" data-product-id="{{ $id }}">
                <div class="product-img-container">
                    <img src="{{ $producto['main_photo'] ?? '/ruta/a/imagen-placeholder.jpg' }}" alt="{{ $producto['nombre'] }}" class="product-img">
                </div>
                <div class="product-details">
                    <h4 class="product-name">{{ $producto['nombre'] }}</h4>
                    <p class="product-price">Precio unitario: ${{ number_format($producto['precio'], 2) }}</p>
                    <div class="quantity-control">
                        <button class="decrement-btn" onclick="updateQuantity({{ $id }}, -1)">-</button>
                        <span class="product-quantity" id="quantity-{{ $id }}">{{ $producto['cantidad'] }}</span>
                        <button class="increment-btn" onclick="updateQuantity({{ $id }}, 1)">+</button>
                    </div>
                    <p class="product-total" id="product-total-{{ $id }}">
                        Total: ${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="checkout-summary">
        <h3>Resumen del Pedido</h3>
        <p>Subtotal: <span id="subtotal-amount">${{ number_format($subtotal, 2) }}</span></p>
        <button onclick="confirmarPago()" class="checkout-button">Proceder al Pago</button>
    </div>
</div>
@endsection

<script>

function updateQuantity(productId, amount) {
    fetch(`/checkout/${productId}/update`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ amount: amount })
    })
    .then(response => {
        console.log(response);
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.getElementById(`quantity-${productId}`).innerText = data.newQuantity;
            document.getElementById(`product-total-${productId}`).innerText = `Total: $${data.newTotal.toFixed(2)}`;
            document.getElementById('subtotal-amount').innerText = `$${data.subtotal.toFixed(2)}`;
        } else {
            alert(data.message || 'Error al actualizar la cantidad');
        }
    })
    .catch(error => console.error('Error:', error));
}


</script>

<style>
.quantity-control {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 5px 0;
}

.increment-btn, .decrement-btn {
    padding: 5px 10px;
    background-color: #ddd;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
}

.increment-btn:hover, .decrement-btn:hover {
    background-color: #ccc;
}
</style>
