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
    .titulo-grande {
        font-size: 30px; /* Tamaño de la fuente más grande */
        font-weight: bold; /* Asegura que el texto sea más visible */
    }

.contenedor-imagen{
    padding-top: 120px;
}
        .contenedor{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    }

.tittle{
text-align: center;
}


    .imagen-circular {
    width: 150px;      /* Ajusta el tamaño de la imagen según sea necesario */
    height: 150px;     /* La altura debe coincidir con el ancho para un círculo perfecto */
    border-radius: 50%; /* Esto hace que la imagen sea circular */
    object-fit: cover;  /* Asegura que la imagen cubra el área sin distorsionarse */
}


        .navbar-brand:hover {
            color: #ffd700;
        }

        .form-inline {
            flex: 1; /* Permite que el buscador ocupe el espacio disponible */
            display: flex;
            justify-content: center; /* Centra el buscador */
        }

        .form-inline input {
            width: 70%; /* Ancho del buscador */
            padding: 10px; /* Espaciado interno */
            border: 1px solid #ddd; /* Borde del buscador */
            border-radius: 20px; /* Bordes redondeados */
            outline: none; /* Sin contorno al seleccionar */
        }

        .form-inline button {
            margin-left: 10px; /* Espacio entre el buscador y el botón */
            padding: 10px 15px; /* Espaciado interno */
            background-color: #ffd700; /* Color del botón */
            border: none; /* Sin borde */
            border-radius: 20px; /* Bordes redondeados */
            color: #333; /* Color del texto */
            cursor: pointer; /* Cambia el cursor al pasar el mouse */
        }

        .form-inline button:hover {
            background-color: #ffc107; /* Color al pasar el mouse */
        }

        .nav-icons {
            display: flex;
            align-items: center;
            margin-left: 20px; /* Espacio entre el buscador y los iconos */
        }

        .nav-icons a {
            color: #fff; /* Color de los iconos */
            margin-left: 15px; /* Espacio entre los iconos */
            position: relative; /* Posición relativa para el badge */
        }

        .badge {
            background-color: #dc3545; /* Color del badge */
            color: #fff; /* Color del texto en el badge */
            border-radius: 50%; /* Badge redondeado */
            padding: 5px 10px; /* Espaciado interno del badge */
            position: absolute; /* Posiciona el badge sobre el icono */
            top: -10px; /* Ajusta la posición vertical del badge */
            right: -10px; /* Ajusta la posición horizontal del badge */
            font-size: 12px; /* Tamaño del texto del badge */
        }


</style>

@include('components.navbarTienda')


<div class="contenedor-imagen container-fluid ps-0 pe-0">
    <div class="row g-0">
        <div class="col-lg-8 col-12 px-1"> <!-- Usamos padding en lugar de margen -->
            <img src="{{asset('images/BANNER1.jpg')}}" alt="Banner 1" class="img-fluid banner border-top-right border-bottom-right">
        </div>

        <!-- Segunda fila: Columna de 4 en pantallas grandes, 2 columnas de 6 en pantallas pequeñas -->
        <div class="col-lg-4 col-12">
            <div class="row g-0 "> <!-- Sin margen entre los banners secundarios -->
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

<div class="tittle p-5 fs-4"><h1>ECHA UN VISTAZO A NUESTRAS CATEGORIAS</h1></div>

<div class="contenedor pb-4">
    <div>
        <div class="tittle">
            <a href="{{ route('productos.categoria', ['id_categoria' => 1]) }}">
                <img src="{{ asset('images/young-brunette-woman-grey-dress-posing.jpg') }}" alt="Cabello" class="imagen-circular" loading="lazy">
            </a>
        </div>
        <div class="tittle"><h2>Cabello</h2></div>
    </div>
    <div>
        <div class="tittle">
            <a href="{{ route('productos.categoria', ['id_categoria' => 2]) }}">
                <img src="{{ asset('images/hairdresser-styling-client-s-hair.jpg') }}" alt="Electricos" class="imagen-circular" loading="lazy">
            </a>
        </div>
        <div class="tittle"><h2>Electricos</h2></div>
    </div>
    <div>
        <div class="tittle">
            <a href="{{ route('productos.categoria', ['id_categoria' => 3]) }}">
                <img src="{{ asset('images/woman-using-pink-beauty-product-her-face.jpg') }}" alt="Skincare" class="imagen-circular" loading="lazy">
            </a>
        </div>
        <div class="tittle"><h2>Skincare</h2></div>
    </div>
    <div>
        <div class="tittle">
            <a href="{{ route('productos.categoria', ['id_categoria' => 4]) }}">
                <img src="{{ asset('images/woman-with-nail-art-promoting-design-luxury-earrings-ring.jpg') }}" alt="Uñas" class="imagen-circular" loading="lazy">
            </a>
        </div>
        <div class="tittle"><h2>Uñas</h2></div>
    </div>
    <div>
        <div class="tittle">
            <a href="{{ route('productos.categoria', ['id_categoria' => 5]) }}">
                <img src="{{ asset('images/makeup-brushes-with-whirling-pink-powder.jpg') }}" alt="Maquillaje" class="imagen-circular" loading="lazy">
            </a>
        </div>
        <div class="tittle"><h2>Maquillaje</h2></div>
    </div>
</div>

<div class="col-md-12">
    <h2 class="mt-4 text-center titulo-grande pt-5 pb-3">Artículos Más Vendidos</h2>
    <div class="productos-container">
        <div class="productos-wrapper" id="wrapper1">
            @forelse ($productosMasVendidos as $producto)
                <div class="producto-card"> 
                    <a href="{{ route('producto.detalle', $producto->id) }}" class="card h-100 shadow-sm border-0">
                        <img src="{{ $producto->main_photo }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark">{{ $producto->nombre }}</h5>
                            <p class="card-text text-danger fw-bold mb-4 precio">Precio: ${{ number_format($producto->precio_venta, 2) }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-md-12">
                    <p class="text-center text-muted">No se encontraron productos recientes.</p>
                </div>
            @endforelse
        </div>
        <button class="btn btn-warning carousel-control-prev" id="prevBtn1"><i class="bi bi-arrow-left"></i></button>
        <button class="btn btn-warning carousel-control-next" id="nextBtn1"><i class="bi bi-arrow-right"></i></button>
    </div>
</div>

<div class="col-md-12">
    <h2 class="mt-4 text-center titulo-grande pt-5 pb-3">Productos Más Recientes</h2>
    <div class="productos-container">
        <div class="productos-wrapper" id="wrapper2">
            @forelse ($productosMasRecientes as $producto)
                <div class="producto-card"> 
                    <a href="{{ route('producto.detalle', $producto->id) }}" class="card h-100 shadow-sm border-0">
                        <img src="{{ $producto->main_photo }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark">{{ $producto->nombre }}</h5>
                            <p class="card-text text-danger fw-bold mb-4 precio">Precio: ${{ number_format($producto->precio_venta, 2) }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-md-12">
                    <p class="text-center text-muted">No se encontraron productos recientes.</p>
                </div>
            @endforelse
        </div>
        <button class="btn btn-warning carousel-control-prev" id="prevBtn2"><i class="bi bi-arrow-left"></i></button>
        <button class="btn btn-warning carousel-control-next" id="nextBtn2"><i class="bi bi-arrow-right"></i></button>
    </div>
</div>

<style>
    .productos-container {
        position: relative;
        overflow: hidden;
        width: 100%;
        padding: 20px 0;
    }

    .productos-wrapper {
        display: flex;
        transition: transform 0.5s ease;
    }

    .producto-card {
        min-width: 220px;
        margin: 0 10px;
    }

    .card {
        text-decoration: none; /* Evita subrayado en el enlace */
        transition: transform 0.3s, box-shadow 0.3s; /* Transiciones para el hover */
    }

    .card:hover {
        transform: scale(1.05); /* Aumenta el tamaño en hover */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Sombra en hover */
    }

    .precio {
        color: #ff5722; /* Color vibrante para el precio */
        font-size: 1.2rem; /* Tamaño de fuente más grande para el precio */
    }

    .carousel-control-prev, .carousel-control-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: #ffc107; /* Color amarillo brillante para los botones */
        color: white;
        border: none;
        cursor: pointer;
        width: 40px;
        height: 40px;
        font-size: 20px;
        border-radius: 50%;
        transition: background-color 0.3s ease;
    }

    .carousel-control-prev:hover, .carousel-control-next:hover {
        background-color: #e0a800; /* Color más oscuro al pasar el mouse sobre los botones */
    }

    .carousel-control-prev {
        left: 10px;
    }

    .carousel-control-next {
        right: 10px;
    }
</style>


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
</script>




@include('components.footer')

</body>
</html>
