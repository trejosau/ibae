<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Efecto hover en las tarjetas de productos */
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
        .products-container {
            display: flex;
            flex-wrap: wrap;
            margin-left: 20px; /* Espacio entre la barra lateral y los productos */
        }

        /* Ajuste en las tarjetas de productos */
        .products-container .col-md-4 {
            flex: 1 1 calc(33.333% - 20px); /* Tres productos por fila */
            margin-bottom: 20px;
        }

        .products-container .card {
            transition: transform 0.2s;
            border-radius: 10px;
            width: 100%;
            height: 600px; /* Altura aumentada del card de productos */
            overflow: hidden; /* Para evitar que el contenido se desborde */
        }

        .products-container .card img {
            max-height: 400px; /* Altura de la imagen ajustada */
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .products-container .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%; /* Se asegura de que el cuerpo ocupe todo el espacio */
        }

        /* Estilo para mantener el contenido centrado */
        .container {
            max-width: 1200px; /* Ajusta este valor para aumentar el ancho del contenedor */
            margin: 0 auto; /* Centra el contenedor en la página */
            padding: 20px; /* Agrega padding alrededor del contenedor */
        }

        .padding {
            padding-top: 120px; 
        }
        
    </style>
</head>
<body>

    @include('components.navbarTienda')
    
    <div class="padding">
        <div class="container my-5">
            <h2 class="text-center mb-4 fw-bold text-uppercase" style="color: #0d6efd;">Catálogo de Productos</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="sidebar">
                        <div class="card">
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

                                <button type="submit" class="btn btn-primary mt-3">Aplicar Filtros</button>
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
                                    <div class="card h-100 shadow-sm border-0">
                                        <img src="{{ $producto->main_photo }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title fw-bold text-dark">{{ $producto->nombre }}</h5>
                                            <p class="card-text text-muted">{{ $producto->descripcion }}</p>
                                            <p class="card-text text-success fw-bold mb-4">Precio: ${{ $producto->precio_venta }}</p>
                                            <a href="{{ route('producto.detalle', $producto->id) }}" class="btn btn-outline-primary mt-auto fw-bold">Ver más</a>
                                        </div>
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

    @include('components.footer')

</body>
</html>
