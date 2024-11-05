<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle del Producto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<style>
/* Navbar */
.navbar-brand:hover {
    color: #ffd700;
    transition: color 0.3s ease;
}

.form-inline {
    flex: 1;
    display: flex;
    justify-content: center;
}

.form-inline input {
    width: 70%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 20px;
    outline: none;
    transition: box-shadow 0.3s ease;
}

.form-inline input:focus {
    box-shadow: 0 0 8px rgba(255, 215, 0, 0.5);
}

.form-inline button {
    margin-left: 10px;
    padding: 10px 15px;
    background-color: #ffd700;
    border: none;
    border-radius: 20px;
    color: #333;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.form-inline button:hover {
    background-color: #ffc107;
    transform: scale(1.05);
}

/* Iconos de navegación */
.nav-icons {
    display: flex;
    align-items: center;
    margin-left: 20px;
}

.nav-icons a {
    color: #fff;
    margin-left: 15px;
    position: relative;
    transition: color 0.3s ease;
}

.nav-icons a:hover {
    color: #ffd700;
}

/* Badge */
.badge {
    background-color: #dc3545;
    color: #fff;
    border-radius: 50%;
    padding: 5px 10px;
    position: absolute;
    top: -10px;
    right: -10px;
    font-size: 12px;
}

/* Productos relacionados */
.productos-container {
    padding: 20px 0;
    background-color: #f8f9fa;
}

.productos-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.producto-card {
    flex: 1 1 220px;
    margin: 0 10px;
}

.card {
    transition: transform 0.3s, box-shadow 0.3s;
    color: inherit;
    border-radius: 10px;
    overflow: hidden;
    background-color: #fff;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

/* Precio y botones */
.precio {
    color: #dc3545;
    font-size: 1.2rem;
}

.text-danger {
    color: #dc3545 !important;
}

.btn-warning {
    background-color: #ff9800;
    border-color: #ff9800;
    font-weight: bold;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.btn-warning:hover {
    background-color: #e68900;
    box-shadow: 0 4px 12px rgba(230, 137, 0, 0.3);
}

.padding {
    padding-top: 90px;
}

/* Títulos */
.titulo-grande {
    font-size: 2rem;
    color: #333;
    font-weight: bold;
    margin-bottom: 30px;
}

.producto-nombre {
    font-size: 2rem; /* Aumentar tamaño de fuente para el nombre del producto */
    font-weight: bold;
}

.producto-descripcion {
    font-size: 1.2rem; /* Aumentar tamaño de fuente para la descripción */
    color: #666; /* Color más suave para la descripción */
}

/* Información de stock */
.stock-info {
    font-size: 0.9rem; /* Tamaño más pequeño */
    color: #888; /* Color gris */
    margin-top: 10px; /* Espaciado superior */
}


.cantidad-container {
    margin-top: 20px;
    display: flex;
    align-items: center; /* Centrar verticalmente */
}

/* Estilo para el campo de cantidad */
.cantidad-input {
    width: 80px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-align: center;
    margin: 0 10px; /* Espaciado lateral */
}

/* Botones de + y - */
.btn-cantidad {
    padding: 10px 15px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-cantidad:hover {
    background-color: #e0e0e0;
}
</style>

@include('components.navbarTienda')

<!-- Contenedor principal -->
<div class="container my-5 padding">
    <div class="row">
        <div class="col-md-6">
            <!-- Imagen principal del producto -->
            @if($producto->main_photo)
                <img src="{{ asset($producto->main_photo) }}" alt="{{ $producto->nombre }}" class="img-fluid rounded shadow mb-4">
            @else
                <div class="alert alert-warning">Imagen no disponible</div>
            @endif
        </div>

        <div class="col-md-6 pt-3">
            <h2 class="producto-nombre mb-3">{{ $producto->nombre }}</h2>
            <p class="producto-descripcion mb-4">{{ $producto->descripcion }}</p>
            <h4 class="mb-4 text-danger fw-bold">Precio: ${{ number_format($producto->precio_venta, 2) }}</h4>
            
            <!-- Mostrar información de stock -->
            <p class="stock-info">Stock disponible: {{ $producto->stock }} unidades</p>

            <div class="cantidad-container">
                <button class="btn-cantidad" id="decrementar">-</button>
                <input type="number" id="cantidad" class="cantidad-input" value="1" min="1" max="{{ $producto->stock }}" />
                <button class="btn-cantidad" id="incrementar">+</button>
            </div>
            
            <button type="submit" class="btn btn-warning btn-lg fw-bold text-white mt-3">Agregar al carrito</button>
        </div>
    </div>

    <hr class="my-4">

    <!-- Sección de productos relacionados -->
    <h3 class="mb-4 text-center titulo-grande">Productos Relacionados</h3>
    <div class="productos-container">
        <div class="productos-wrapper">
            @forelse($productosRelacionados as $productoRelacionado)
                <div class="producto-card">
                    <a href="{{ route('producto.detalle', $productoRelacionado->id) }}" class="card h-100 shadow-sm border-0 text-decoration-none">
                        @if($productoRelacionado->main_photo)
                            <img src="{{ asset($productoRelacionado->main_photo) }}" alt="{{ $productoRelacionado->nombre }}" class="card-img-top img-fluid rounded-top">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa;">
                                <p class="text-muted">Imagen no disponible</p>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark">{{ $productoRelacionado->nombre }}</h5>
                            <p class="card-text text-danger fw-bold precio mb-4">Precio: ${{ number_format($productoRelacionado->precio_venta, 2) }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-md-12">
                    <p class="text-center text-muted">No se encontraron productos relacionados.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@include('components.footer')

<script>
document.addEventListener('DOMContentLoaded', () => {
    const cantidadInput = document.getElementById('cantidad');
    const incrementarBtn = document.getElementById('incrementar');
    const decrementarBtn = document.getElementById('decrementar');

    // Incrementar cantidad
    incrementarBtn.addEventListener('click', () => {
        if (parseInt(cantidadInput.value) < parseInt(cantidadInput.max)) {
            cantidadInput.value = parseInt(cantidadInput.value) + 1;
        }
    });

    // Decrementar cantidad
    decrementarBtn.addEventListener('click', () => {
        if (parseInt(cantidadInput.value) > 1) {
            cantidadInput.value = parseInt(cantidadInput.value) - 1;
        }
    });
});
</script>

</body>

</html>
