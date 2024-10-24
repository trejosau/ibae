<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>



<style>
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
            <div class="tittle"><a href=""><img src="{{ asset('images/young-brunette-woman-grey-dress-posing.jpg') }}" alt="Descripción" class="imagen-circular" loading="lazy"></a></div>
            <div class="tittle"><h2>Cabello</h2></div>
        </div>
        <div>
            <div class="tittle"><a href=""><img src="{{ asset('images/hairdresser-styling-client-s-hair.jpg') }}" alt="Descripción" class="imagen-circular" loading="lazy"></a></div>
            <div class="tittle"><h2>Electricos</h2></div>
        </div>
        <div>
            <div class="tittle"><a href=""><img src="{{ asset('images/woman-using-pink-beauty-product-her-face.jpg') }}" alt="Descripción" class="imagen-circular" loading="lazy"></a></div>
            <div class="tittle"><h2>Skincare</h2></div>
        </div>
        <div>
            <div class="tittle"><a href=""><img src="{{ asset('images/woman-with-nail-art-promoting-design-luxury-earrings-ring.jpg') }}" alt="Descripción" class="imagen-circular" loading="lazy"></a></div>
            <div class="tittle"><h2>Uñas</h2></div>
        </div>
        <div>
            <div class="tittle"><a href=""><img src="{{ asset('images/makeup-brushes-with-whirling-pink-powder.jpg') }}" alt="Descripción" class="imagen-circular" loading="lazy"></a></div>
            <div class="tittle"><h2>Maquillaje</h2></div>
        </div>
</div>


<h1 class=" tittle p-5 fs-5 fw-bold" >TODOS LOS PRODUCTOS</h1>
<div class="container">
    <form id="filterForm" method="POST" action="{{ route('productos.filtrar') }}" class="p-3">
        @csrf <!-- Protección CSRF necesaria en formularios POST -->

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="id_categoria" class="form-label">Categoría:</label>
                <select id="id_categoria" name="id_categoria" class="form-select">
                    <option value="">Todas</option>
                    <option value="1" {{ old('id_categoria') == 1 ? 'selected' : '' }}>Tintes</option>
                    <option value="2" {{ old('id_categoria') == 2 ? 'selected' : '' }}>Cabello</option>
                    <option value="3" {{ old('id_categoria') == 3 ? 'selected' : '' }}>Barbería</option>
                    <option value="4" {{ old('id_categoria') == 4 ? 'selected' : '' }}>Maquillaje</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="precio_min" class="form-label">Precio mínimo:</label>
                <input type="number" id="precio_min" name="precio_min" min="0" value="{{ old('precio_min') }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="precio_max" class="form-label">Precio máximo:</label>
                <input type="number" id="precio_max" name="precio_max" min="0" value="{{ old('precio_max') }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>





    <div class="row">
        @foreach ($productos as $producto)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $producto->imagen }}" class="card-img-top" alt="{{ $producto->nombre }}">
                <div class="card-body">
                    <h5 class="card-title fw-bold pb-3">{{ $producto->nombre }}</h5>
                    <p class="card-text pb-3">{{ $producto->descripcion }}</p>
                    <p class="card-text  pb-3"><strong>Precio:</strong> <strong>${{ $producto->precio_venta }}</strong></p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@include('components.footer')

</body>
</html>


