
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
        /* Mensaje de estado */
        .mensaje-ajax {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #333;
            color: #fff;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 16px;
            opacity: 0;
            transition: opacity 0.4s ease, transform 0.4s ease;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(20px); /* Animación de entrada */
        }
        
        .mensaje-ajax.exito {
            background-color: #333; /* Verde para éxito */
        }
        
        .mensaje-ajax.error {
            background-color: #f44336; /* Rojo para error */
        }
        
        .mensaje-ajax.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Productos relacionados */
        .productos-container {
            padding: 20px 0;
            background-color: #fff;
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
            color: #e63946; /* Rojo */
            font-size: 1.2rem;
        }
        
        .text-danger {
            color: #e63946 !important; /* Rojo */
        }
        
        .btn-agg {
            background-color: #333; 
            font-weight: bold;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            color: #fff; 
        }
        
        .btn-agg:hover {
            background-color: #e0a2a2;
            color: #333;     
            box-shadow: 0 4px 64px #dfadc3
        }
        
        .padding {
            padding-top: 90px;
        }
        
        /* Títulos */
        .titulo-grande {
            font-size: 2rem;
            color: #333; /* Negro */
            font-weight: bold;
            margin-bottom: 30px;
        }
        
        .producto-nombre {
            font-size: 2rem; /* Aumentar tamaño de fuente para el nombre del producto */
            font-weight: bold;
            color: #333; /* Negro */
        }
        
        .producto-descripcion {
            font-size: 1.2rem; /* Aumentar tamaño de fuente para la descripción */
            color: #666; /* Gris */
        }
        
        /* Información de stock */
        .stock-info {
            font-size: 0.9rem; /* Tamaño más pequeño */
            color: #888; /* Gris */
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


        .precio-producto{
            color: #333;
            font-size: 20px;
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
            <h4 class="mb-4 precio-producto fw-bold">Precio: ${{ number_format($producto->precio_venta, 2) }}</h4>
            
            <!-- Mostrar información de stock -->
            <p class="stock-info">Stock disponible: {{ $producto->stock }} unidades</p>

            <div class="cantidad-container">
                <button class="btn-cantidad" id="decrementar">-</button>
                <input type="number" id="cantidad" class="cantidad-input" value="1" min="1" max="{{ $producto->stock }}" />
                <button class="btn-cantidad" id="incrementar">+</button>
            </div>
            
            <form id="agregar-carrito-form">
                @csrf
                <input type="hidden" name="cantidad" id="cantidad-input" value="1" />
                <button type="button" class="btn btn-agg btn-lg fw-bold  mt-3" 
                        aria-label="Agregar {{ $producto->nombre }} al carrito" 
                        onclick="agregarAlCarrito({{ $producto->id }})">
                    <i class="fas fa-shopping-cart"></i> Agregar al carrito
                </button>
            </form>
            
            
            
            
            
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

function agregarAlCarrito(productoId) {
    const cantidad = document.getElementById('cantidad').value;
    const token = document.querySelector('input[name="_token"]').value;

    fetch(`/producto/${productoId}/agregar-al-carrito`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ cantidad: cantidad })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            actualizarTotalCarrito();
            cargarContenidoCarrito();
            mostrarMensaje('Producto agregado al carrito', 'exito');
        } else {
            mostrarMensaje('Hubo un problema al agregar el producto al carrito', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarMensaje('Error al procesar la solicitud', 'error');
    });
}

function mostrarMensaje(mensaje, tipo) {
    const mensajeDiv = document.createElement('div');
    mensajeDiv.className = `mensaje-ajax ${tipo}`;
    mensajeDiv.textContent = mensaje;
    
    document.body.appendChild(mensajeDiv);
    
    // Activa la animación después de un breve retraso
    setTimeout(() => {
        mensajeDiv.classList.add('show');
    }, 10);
    
    // Elimina el mensaje después de 3 segundos
    setTimeout(() => {
        mensajeDiv.remove();
    }, 3000);
}



</script>

</body>

</html>
