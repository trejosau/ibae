
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
        








.btn-rel{
    background-color: #333;
    color: white;
    width: 100%;
    margin-top: auto;
}

.btn-rel:hover{
    background-color: #e0a2a2;
            color: #333;     
            box-shadow: 0 4px 64px #dfadc3
}
/* Ajuste adicional para el contenedor de productos */
.productos-container {
    position: relative;
    overflow: hidden;
    width: 100%;
    padding: 20px 0;
}

.productos-wrapper {
    display: flex; /* Contenedor flexible */
    justify-content: space-between; /* Espaciado uniforme entre los elementos */
    align-items: center; /* Alineación vertical centrada */
    flex-wrap: wrap; /* Permite que los elementos se ajusten a la siguiente línea si es necesario */
    transition: transform 0.5s ease; /* Animación suave para transformaciones */
    gap: 15px; /* Espaciado entre elementos */
}

/* Opcional: Limitar el tamaño de los elementos */
.productos-wrapper > * {
    flex: 1 1 calc(25% - 15px); /* Cada elemento ocupa 25% del espacio, menos el margen */
    max-width: calc(25% - 15px); /* Control de tamaño máximo */
    box-sizing: border-box; /* Incluye márgenes y bordes en el tamaño total */
}

/* Responsividad: Ajuste para pantallas más pequeñas */
@media (max-width: 768px) {
    .productos-wrapper > * {
        flex: 1 1 calc(50% - 15px); /* Cada elemento ocupa 50% en pantallas medianas */
        max-width: calc(50% - 15px);
    }
}

@media (max-width: 576px) {
    .productos-wrapper > * {
        flex: 1 1 100%; /* Cada elemento ocupa todo el ancho en pantallas pequeñas */
        max-width: 100%;
    }
}


.producto-card {
    min-width: 220px;
    margin: 0 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%; 
}

.card {
    text-decoration: none; /* Evita subrayado en el enlace */
    transition: transform 0.3s, box-shadow 0.3s; /* Transiciones para el hover */
}

.card:hover {
    transform: scale(1.05); /* Aumenta el tamaño en hover */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Sombra en hover */
}
.card-title {
    height: 2.5rem; /* Fija la altura del título */
    overflow: hidden; /* Oculta el contenido que sobrepasa la altura */
    text-overflow: ellipsis; /* Agrega puntos suspensivos al texto largo */
    white-space: nowrap; 
    font-size: 17px;/* Evita que el texto haga salto de línea */
    margin-bottom: 0.5rem; /* Asegura espacio entre elementos */
}

.precio {
    color: #ff5722; /* Color vibrante para el precio */
    font-size: 1.2rem; /* Tamaño de fuente más grande para el precio */
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
            padding-top: 120px;
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
                <!-- Campo de cantidad con validación -->
                <input 
                    type="number" 
                    id="cantidad" 
                    class="cantidad-input" 
                    value="1" 
                    min="1" 
                    max="{{ $producto->stock }}" 
                />
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
                        <img src="{{ asset($productoRelacionado->main_photo) }}" alt="{{ $productoRelacionado->nombre }}" style="height: 300px; width:300px;" class="card-img-top img-fluid rounded-top">
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
            
                <!-- Formulario para agregar al carrito fuera del enlace -->
                <form id="agregar-carrito-form">
                    @csrf
                    <input type="hidden" name="cantidad" id="cantidad-input" value="1" />
                    <button type="button" class="btn btn-rel fw-bold mt-3" 
                            aria-label="Agregar {{ $productoRelacionado->nombre }} al carrito" 
                            onclick="agregarAlCarrito({{ $productoRelacionado->id }})">
                        <i class="fas fa-shopping-cart"></i> Agregar al carrito
                    </button>
                </form>
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
    const cantidad = parseInt(document.getElementById('cantidad').value, 10);
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
            mostrarMensaje(data.message || 'Error al agregar el producto', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarMensaje('Error al procesar la solicitud', 'error');
    });
}


document.getElementById('incrementar').addEventListener('click', () => {
    const cantidadInput = document.getElementById('cantidad');
    const maxCantidad = parseInt(cantidadInput.max, 10);
    let cantidad = parseInt(cantidadInput.value, 10);

    if (cantidad < maxCantidad) {
        cantidad++;
        cantidadInput.value = cantidad;
    }
});

document.getElementById('decrementar').addEventListener('click', () => {
    const cantidadInput = document.getElementById('cantidad');
    let cantidad = parseInt(cantidadInput.value, 10);

    if (cantidad > 1) {
        cantidad--;
        cantidadInput.value = cantidad;
    }
});

document.getElementById('cantidad').addEventListener('input', (event) => {
    const input = event.target;
    const min = parseInt(input.min, 10);
    const max = parseInt(input.max, 10);
    let value = parseInt(input.value, 10);

    if (value < min) {
        input.value = min;
    } else if (value > max) {
        input.value = max;
    }
});


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
