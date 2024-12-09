<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>


    <style>
        /* Paleta de colores */
        :root {
            --color-fondo: #F8F9FA; /* Gris claro para fondo principal */
            --color-primario: #0D1E4C; /* Azul oscuro */
            --color-secundario: #83A6CE; /* Azul claro */
            --color-acento: #C48CB3; /* Rosa oscuro */
            --color-texto: #26415E; /* Azul medio */
            --color-footer: #0B1B32; /* Azul noche */
        }

        /* Tipografía */
        .titulo-grande {
            font-size: 30px;
            font-weight: bold;
            color: var(--color-primario); /* Azul oscuro */
        }

        /* Precio */
        .precio {
            color: var(--color-acento); /* Rosa oscuro */
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        /* Botón "Agregar al carrito" */
        .btn-agg {
            background-color: var(--color-primario); /* Azul oscuro */
            color: var(--color-fondo); /* Blanco */
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: auto;
        }

        .btn-agg:hover {
            background-color: var(--color-acento); /* Rosa oscuro */
        }

        /* Contenedor de productos */
        .productos-container {
            background-color: var(--color-fondo);
            position: relative;
            overflow: hidden;
            width: 100%;
            padding: 20px 0;
        }

        .productos-wrapper {
            display: flex;
            transition: transform 0.5s ease;
        }

        /* Tarjetas de productos */
        .card-title {
            color: var(--color-texto); /* Azul medio */
            height: 2.5rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .producto-card {
            background-color: var(--color-fondo); /* Fondo claro */
            min-width: 220px;
            margin: 0 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.7); /* Fondo blanco semitransparente */
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 8px;
            padding: 10px;
            backdrop-filter: blur(5px); /* Efecto de desenfoque detrás */
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        /* Botones del carrusel */
        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            background-color: var(--color-primario);
            color: var(--color-fondo);
            border: none;
            cursor: pointer;
            width: 40px;
            height: 40px;
            font-size: 20px;
            border-radius: 50%;
            transition: background-color 0.3s ease;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: var(--color-acento); /* Rosa oscuro */
        }

        /* Contenedor del catálogo */
        .catalog-container {
            background-color: var(--color-fondo);
            border-radius: 12px;
            padding: 30px;
            max-width: 400px;
            margin: 0 auto;
        }

        .catalog-title {
            font-size: 2rem;
            color: var(--color-primario); /* Azul oscuro */
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
        }

        .catalog-link {
            display: inline-block;
            font-size: 1.25rem;
            background-color: var(--color-primario);
            color: var(--color-fondo);
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 50px;
            transition: background-color 0.3s, transform 0.3s ease;
        }

        .catalog-link:hover {
            background-color: var(--color-acento); /* Rosa oscuro */
            color: var(--color-texto); /* Azul medio */
            transform: translateY(-5px);
        }

        .catalog-link:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }


        </style>


@include('components.navbarTienda')


    @if(session('error'))
        <div class="alert alert-danger alert-custom">
            {{ session('error') }}
        </div>
    @endif
<div class="contenedor-imagen container-fluid ps-0 pe-0">


    <div class="row g-0" style="margin-top: 100px;">
        <div class="col-lg-8 col-12 px-1">
            <!-- Carrusel -->
            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicadores opcionales -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <!-- Contenido del carrusel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('images/BANNER1.jpg')}}" alt="Banner 1" class="img-fluid banner border-top-right border-bottom-right">
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('images/BANNER2.jpg')}}" alt="Banner 2" class="img-fluid banner border-top-right border-bottom-right">
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('images/BANNER3.jpg')}}" alt="Banner 3" class="img-fluid banner border-top-right border-bottom-right">
                    </div>
                </div>

                <!-- Controles de navegación -->
                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>

        <!-- Segunda fila: Columna de 4 en pantallas grandes, 2 columnas de 6 en pantallas pequeñas -->
        <div class="col-lg-4 col-12">
            <div class="row g-0">
                <!-- Primer banner de la segunda fila -->
                <div class="col-6 col-lg-12 pb-1">
                    <img src="{{asset('images/BANNER2.jpg')}}" alt="Banner 2" class="img-fluid border-top-left">
                </div>
                <!-- Segundo banner de la segunda fila -->
                <div class="col-6 col-lg-12">
                    <img src="{{asset('images/BANNER3.jpg')}}" alt="Banner 3" class="img-fluid border-bottom-left">
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Div contenedor -->
<div class="catalog-container text-center p-4">
    <h3 class="catalog-title">Visita nuestro catálogo</h3>
    <a href="{{route('catalogo')}}" class="btn catalog-link">Explorar catálogo</a>
  </div>


  <div class="col-md-12">
    <h2 class="mt-4 text-center titulo-grande pt-5 pb-3">✨ Productos Más Vendidos ✨</h2>
    <div class="productos-container">
        <div class="productos-wrapper" id="wrapper1">
            @forelse ($productosMasVendidos as $producto)
            <div class="producto-card position-relative">
                <!-- Estado Agotado -->
                @if($producto->estado === 'agotado')
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-danger bg-opacity-50 d-flex justify-content-center align-items-center">
                    <span class="text-white fs-4">Agotado</span>
                </div>
                @endif
                <!-- Enlace al detalle del producto -->
                <a href="{{ route('producto.detalle', $producto->id) }}" class="card h-100 shadow-sm border-0">
                    <img src="{{ $producto->main_photo }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark">{{ $producto->nombre }}</h5>
                        @if (auth()->check() && auth()->user()->Persona?->Estudiante)
                            <p class="card-text text-danger fw-bold mb-4 precio">Precio: ${{ number_format($producto->precio_lista, 2) }}</p>
                            <small class="text-muted">Descuento: -${{ $producto->precio_venta - $producto->precio_lista }}</small>
                        @else
                            <p class="card-text text-danger fw-bold mb-4 precio">Precio: ${{ number_format($producto->precio_venta, 2) }}</p>
                        @endif
                    </div>
                    <p>En stock:
                        <span class="badge {{ $producto->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                            {{ $producto->stock }}
                        </span>
                    </p>
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
            @empty
                <div class="col-md-12">
                    <p class="text-center text-muted">No se encontraron productos más vendidos.</p>
                </div>
            @endforelse
        </div>
        <button class="btn btn-warning carousel-control-prev" id="prevBtn1"><i class="bi bi-arrow-left"></i></button>
        <button class="btn btn-warning carousel-control-next" id="nextBtn1"><i class="bi bi-arrow-right"></i></button>
    </div>
</div>

<div class="col-md-12">
    <h2 class="mt-4 text-center titulo-grande pt-5 pb-3">✨ Productos Más Recientes ✨</h2>
    <div class="productos-container">
        <div class="productos-wrapper" id="wrapper2">
            @forelse ($productosMasRecientes as $producto)
            <div class="producto-card position-relative">
                <!-- Estado Agotado -->
                @if($producto->estado === 'agotado')
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-danger bg-opacity-50 d-flex justify-content-center align-items-center">
                    <span class="text-white fs-4">Agotado</span>
                </div>
                @endif
                <!-- Enlace al detalle del producto -->
                <a href="{{ route('producto.detalle', $producto->id) }}" class="card h-100 shadow-sm border-0">
                    <img src="{{ $producto->main_photo }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark" style="font-size: 15px">{{ $producto->nombre }}</h5>
                        @if (auth()->check() && auth()->user()->Persona?->Estudiante)
                            <p class="card-text text-danger fw-bold mb-4 precio">Precio: ${{ number_format($producto->precio_lista, 2) }}</p>
                            <small class="text-muted">Descuento: -${{ $producto->precio_venta - $producto->precio_lista }}</small>
                        @else
                            <p class="card-text text-danger fw-bold mb-4 precio">Precio: ${{ number_format($producto->precio_venta, 2) }}</p>
                        @endif
                    </div>
                    <p>En stock:
                        <span class="badge {{ $producto->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                            {{ $producto->stock }}
                        </span>
                    </p>
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
            @empty
                <div class="col-md-12">
                    <p class="text-center text-muted">No se encontraron productos más recientes.</p>
                </div>
            @endforelse
        </div>
        <button class="btn btn-warning carousel-control-prev" id="prevBtn2"><i class="bi bi-arrow-left"></i></button>
        <button class="btn btn-warning carousel-control-next" id="nextBtn2"><i class="bi bi-arrow-right"></i></button>
    </div>
</div>


<script>
    function initializeCarousel(wrapperId, prevBtnId, nextBtnId) {
        const productosWrapper = document.getElementById(wrapperId);
        const prevBtn = document.getElementById(prevBtnId);
        const nextBtn = document.getElementById(nextBtnId);
        const containerWidth = productosWrapper.parentNode.offsetWidth; // Ancho del contenedor padre
        const totalScrollWidth = productosWrapper.scrollWidth;
        let scrollAmount = 0;
        const scrollStep = 220; // Ajusta este valor según el ancho de cada tarjeta

        nextBtn.addEventListener('click', () => {
            if (scrollAmount + containerWidth < totalScrollWidth) {
                scrollAmount += scrollStep;
            } else {
                scrollAmount = 0; // Reiniciar al principio
            }
            productosWrapper.style.transform = `translateX(-${scrollAmount}px)`;
        });

        prevBtn.addEventListener('click', () => {
            if (scrollAmount > 0) {
                scrollAmount -= scrollStep;
            } else {
                scrollAmount = totalScrollWidth - containerWidth;
            }
            productosWrapper.style.transform = `translateX(-${scrollAmount}px)`;
        });
    }

    // Inicializar los carruseles con los IDs correspondientes
    initializeCarousel('wrapper1', 'prevBtn1', 'nextBtn1');
    initializeCarousel('wrapper2', 'prevBtn2', 'nextBtn2');


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




@include('components.footer')

</body>
</html>
