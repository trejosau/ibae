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
/* Espaciado superior para el contenedor de imágenes */
.contenedor-imagen {
    padding-top: 120px;
}

/* Configuración del grid */
.contenedor {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px; /* Espacio entre las columnas */
    justify-items: center; /* Centra los elementos en cada columna */
}

/* Estilos para los títulos */
.tittle {
    text-align: center;
    margin-top: 10px;
    transition: color 0.3s ease, transform 0.3s ease; /* Transiciones para el efecto en el título */
}

/* Efecto en el título al pasar el cursor */
.tittle:hover {
    color: #ff5a5f; /* Cambia el color al pasar el cursor */
    transform: translateY(-5px); /* Mueve el texto un poco hacia arriba */
}

/* Estilos para las imágenes circulares */
.imagen-circular {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transiciones para efectos en la imagen */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Sombra inicial */
}

/* Efecto en la imagen al pasar el cursor */
.imagen-circular:hover {
    transform: scale(1.1); /* Aumenta el tamaño ligeramente */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Sombra más pronunciada en hover */
}


        /* Contenedor de productos */
  /* Contenedor de productos */
.products-container .card {
    border: 1px solid #ddd; /* Contorno alrededor de cada tarjeta */
    border-radius: 10px;
    width: 100%;
    height: 600px;
    overflow: hidden;
    transition: box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
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
    width: 100%;
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
    margin-bottom: 1rem; /* Espacio debajo del precio */
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
    margin-top: auto; /* Empuja el botón a la parte inferior del contenedor */
}

.btn-agg:hover {
    background-color: #ff4146; /* Color de fondo en hover */
}

/* Ajuste adicional para el contenedor de productos */
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
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%; /* Asegura que el contenido esté alineado correctamente */
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

/* Ajuste de la posición de los controles de navegación del carrusel */
.carousel-control-prev,
.carousel-control-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10; /* Asegura que los botones estén encima del contenido */
    background-color: #333; /* Color amarillo brillante para los botones */
    color: white;
    border: none;
    cursor: pointer;
    width: 40px;
    height: 40px;
    font-size: 20px;
    border-radius: 50%;
    transition: background-color 0.3s ease;
}

/* Ajusta la distancia de los botones del borde */


.carousel-control-prev:hover,
.carousel-control-next:hover {
    background-color: #f1c6d4; /* Color más oscuro al pasar el mouse sobre los botones */
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
