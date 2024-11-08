<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>

        .sidebar {
            background-color: transparent; /* Puede ser transparente si estás usando la clase card */
            padding: 0; /* Sin padding adicional, ya que la tarjeta manejará esto */
            margin: 0; /* Sin margen para la sidebar */
        }

        .sidebar .card {
            background-color: #f8f9fa; /* Color de fondo para la tarjeta */
            padding: 10px; /* Padding reducido para los filtros */
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%; /* Asegura que la tarjeta ocupe todo el ancho disponible */
        }

        .sidebar label {
            font-weight: bold;
            font-size: 1em; /* Tamaño de fuente reducido */
        }

        /* Aumentar tamaño de los controles dentro del formulario */
        .sidebar .form-select, .sidebar .form-control {
            margin-bottom: 10px; /* Espaciado reducido */
            font-size: 0.9em; /* Tamaño de fuente reducido */
            padding: 8px; /* Espaciado interno reducido */
        }

        /* Asegurar que el botón ocupe el 100% de su contenedor */
        .sidebar button {
            width: 100%;
            font-weight: bold;
            font-size: 0.9em; /* Tamaño de fuente reducido */
            padding: 8px; /* Espaciado interno reducido */
        }

        /* Contenedor de productos */
        .products-container .card {
        border: 1px solid #ddd; /* Contorno alrededor de cada tarjeta */
        border-radius: 10px;
        width: 100%;
        height: 600px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        }

        .products-container .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Sombra en hover */
        }

        .products-container .card img {
            max-height: 400px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            transition: transform 0.3s ease;
        }

        .products-container .card:hover img {
            transform: scale(1.1); /* Solo agrandar la imagen en hover */
        }

        .products-container .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .precio {
            color: #ff5722;
            font-size: 1.2rem;
        }

        /* Estilo para el botón "Agregar al carrito" */
        .btn-agg {
            background-color: #ff5a5f; /* Color de fondo */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            width: 100%; /* Botón ancho */
        }

        .btn-agg:hover {
            background-color: #ff4146; /* Color de fondo en hover */
        }

        .padding{
        padding-top: 150px;        
            }
        .padl
        {padding-left: 400px;}

        .btn-filtro{
        background-color: #333;
        color: white;
        }
        .btn-filtro:hover{
        background-color: #f1c6d4;
        color: #333;
        }

    </style>

</head>

<body>

    @include('components.navbarTienda')
    
    <div class="padding">


        <div class="container my-5">
            <h2 class="text-center mb-4 fw-bold text-uppercase padl" style="color: #333;">Catálogo de Productos</h2>


            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="sidebar">
                        <div class="">
                            <form id="filterForm" method="POST" action="{{ route('productos.filtrar') }}">
                                @csrf
                                <label for="id_categoria" class="form-label">Categoría:</label>
                                <select id="id_categoria" name="id_categoria" class="form-select">
                                    <option value="">Todas</option>
                                    <option value="1" {{ old('id_categoria') == 1 ? 'selected' : '' }}>Tintes</option>
                                    <option value="2" {{ old('id_categoria') == 2 ? 'selected' : '' }}>Cabello</option>
                                    <option value="3" {{ old('id_categoria') == 3 ? 'selected' : '' }}>Barbería</option>
                                    <option value="4" {{ old('id_categoria') == 4 ? 'selected' : '' }}>Maquillaje</option>
                                </select>

                                <label for="precio_min" class="form-label">Precio mínimo:</label>
                                <input type="number" id="precio_min" name="precio_min" min="0" value="{{ old('precio_min') }}" class="form-control" placeholder="$0">

                                <label for="precio_max" class="form-label">Precio máximo:</label>
                                <input type="number" id="precio_max" name="precio_max" min="0" value="{{ old('precio_max') }}" class="form-control" placeholder="$500">

                                <button type="submit" class="btn btn-filtro mt-3">Aplicar Filtros</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Productos en la columna derecha -->
                <div class="col-md-8">
                    <div class="products-container">
                        <div class="row">
                            @forelse ($productos as $producto)
                                <div class="col-md-4 mb-4"> <!-- Tres productos por fila -->
                                    <div class="producto-card">
                                        <!-- Enlace al detalle del producto -->
                                        <a href="{{ route('producto.detalle', $producto->id) }}" class="card h-100 shadow-sm border-0">
                                            <img src="{{ $producto->main_photo }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title fw-bold text-dark">{{ $producto->nombre }}</h5>
                                                <p class="card-text text-danger fw-bold mb-4 precio">Precio: ${{ number_format($producto->precio_venta, 2) }}</p>
                                            </div>
                                        </a>
                    
                                        <!-- Formulario para agregar al carrito fuera del enlace -->
                                        <form id="agregar-carrito-form">
                                            @csrf
                                            <input type="hidden" name="cantidad" id="cantidad-input" value="1" />
                                            <button type="button" class="btn btn-agg btn-lg fw-bold mt-3" 
                                                    aria-label="Agregar {{ $producto->nombre }} al carrito" 
                                                    onclick="agregarAlCarrito({{ $producto->id }})">
                                                <i class="fas fa-shopping-cart"></i> Agregar al carrito
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12">
                                    <p class="text-center text-muted">No se encontraron productos con los criterios seleccionados.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    
                    </div>
                    
                    
                </div>


            </div>


        </div>



    </div>

    

    @include('components.footer')

    <script>
        function agregarAlCarrito(productoId) {
            const cantidad = document.getElementById('cantidad-input').value;
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
