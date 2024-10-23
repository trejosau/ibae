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

        .contenedor{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    }

.tittle{
text-align: center;
}
 .navegacion {
        text-align: center;
        padding: 20px;
        display: flex; /* Align items horizontally */
        justify-content: center;
        gap: 30px; /* Space between items */
        font-family: 'Arial', sans-serif;
        font-size: 16px;
    }
    .navegacion a {
        color: #333;
        text-decoration: none;
        font-weight: bold;
        padding: 10px;
        position: relative;
        transition: color 0.3s ease;
    }
    .navegacion a:hover {
        color: #e63946; /* Modern red color */
    }

    /* Mega menu general styles */
    .navegacion-item {
        position: relative; /* To position the mega-menu relative to the link */
    }

    .mega-menu1 {
        display: none; /* Hidden by default */
        position: absolute;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Modern shadow effect */
        z-index: 1000;
        top: 100%; /* Aligns just below the link */
        left: -100px;
        right: 0;
        border-radius: 8px; /* Soft corners for a modern look */
        width: 800px; /* Increase width of the mega menu */
        max-height: 400px; /* Increase max height to allow more content */
        overflow-y: auto; /* Enable scrolling if content overflows */
    }
    .mega-menu2 {
        display: none; /* Hidden by default */
        position: absolute;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Modern shadow effect */
        z-index: 1000;
        top: 100%; /* Aligns just below the link */
        left: -100px;
        right: 0;
        border-radius: 8px; /* Soft corners for a modern look */
        width: 800px; /* Increase width of the mega menu */
        max-height: 400px; /* Increase max height to allow more content */
        overflow-y: auto; /* Enable scrolling if content overflows */
    }
    .mega-menu3 {
        display: none; /* Hidden by default */
        position: absolute;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Modern shadow effect */
        z-index: 1000;
        top: 100%; /* Aligns just below the link */
        left: -100px;
        right: 0;
        border-radius: 8px; /* Soft corners for a modern look */
        width: 800px; /* Increase width of the mega menu */
        max-height: 400px; /* Increase max height to allow more content */
        overflow-y: auto; /* Enable scrolling if content overflows */
    }
    .mega-menu4 {
        display: none; /* Hidden by default */
        position: absolute;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Modern shadow effect */
        z-index: 1000;
        top: 100%; /* Aligns just below the link */
        left: -300px;
        right: 0;
        border-radius: 8px; /* Soft corners for a modern look */
        width: 800px; /* Increase width of the mega menu */
        max-height: 400px; /* Increase max height to allow more content */
        overflow-y: auto; /* Enable scrolling if content overflows */
    }

    .mega-menu h3 {
        margin-top: 0; /* Removes top margin for the headings */
        margin-bottom: 10px; /* Space below each heading */
        font-size: 18px; /* Slightly larger font size for headings */
    }

    .mega-menu a {
        display: block; /* Makes each link a block element */
        margin-bottom: 5px; /* Adds space between links */
        padding: 5px; /* Adds padding to each link */
        color: #333;
        transition: background-color 0.3s ease; /* Smooth background color transition */
    }

    .mega-menu a:hover {
        background-color: #f0f0f0; /* Highlight color on hover */
    }

    /* Show the mega menu on hover */
    .navegacion-item:hover .mega-menu {
        display: block;
    }

    /* Clearfix for container */
    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    .imagen-circular {
    width: 150px;      /* Ajusta el tamaño de la imagen según sea necesario */
    height: 150px;     /* La altura debe coincidir con el ancho para un círculo perfecto */
    border-radius: 50%; /* Esto hace que la imagen sea circular */
    object-fit: cover;  /* Asegura que la imagen cubra el área sin distorsionarse */
}

        .navbar {
            background-color: #6c757d; /* Color de fondo del navbar */
            padding: 15px;
        }

        .navbar-brand {
            color: #fff; /* Color del logo */
            font-size: 24px; /* Tamaño del logo */
        }

        .navbar-brand:hover {
            color: #ffd700; /* Color del logo al pasar el mouse */
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
<!-- Modern navigation with mega menu -->
<div class="accordion" id="categoryAccordion">
    <nav class="navegacion">
        <div class="navegacion-item">
            <a href="#">Tintes</a>
            <div class="mega-menu mega-menu1 clearfix">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <h3>TINTES</h3>
                            <a href="#">Tintes Permanentes</a>
                            <a href="#">Tintes temporales y fantasía</a>
                            <a href="#">Peróxido, decolorantes y aditivos</a>
                            <a href="#">Accesorios para teñir</a>
                            <a href="#">Cobertura de canas</a>
                            <a href="#">Depositadores de color</a>
                        </div>
                        <div class="col-md-3">
                            <h3>Productos Relacionados</h3>
                            <a href="#">Shampoo para tintes</a>
                            <a href="#">Acondicionadores</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="navegacion-item">
            <a href="#">Cabello</a>
            <div class="mega-menu mega-menu2 clearfix">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <h3>CABELLO</h3>
                            <a href="#">Shampoo y acondicionador</a>
                            <a href="#">Tratamientos capilares</a>
                            <a href="#">Mascarillas para el cabello</a>
                            <a href="#">Sérum y aceites</a>
                            <a href="#">Cepillos y peines</a>
                        </div>
                        <div class="col-md-3">
                            <h3>Accesorios</h3>
                            <a href="#">Secadoras de cabello</a>
                            <a href="#">Planchas</a>
                            <a href="#">Rizadores</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="navegacion-item">
            <a href="#">Barbería</a>
            <div class="mega-menu mega-menu3 clearfix">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <h3>BARBERÍA</h3>
                            <a href="#">Cortes</a>
                            <a href="#">Rasuradoras</a>
                            <a href="#">Cremas y lociones</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="navegacion-item">
            <a href="#">Maquillaje</a>
            <div class="mega-menu mega-menu4 clearfix">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <h3>ROSTRO</h3>
                            <a href="#">Bases</a>
                            <a href="#">Correctores</a>
                            <a href="#">Paletas de maquillaje</a>
                            <a href="#">Iluminadores</a>
                            <a href="#">Polvos</a>
                            <a href="#">Rubores & Bronceadores</a>
                        </div>
                        <div class="col-md-3">
                            <h3>LABIOS</h3>
                            <a href="#">Delineadores</a>
                            <a href="#">Lápiz labial</a>
                            <a href="#">Brillo Labial</a>
                            <a href="#">Bálsamo Labial</a>
                        </div>
                        <div class="col-md-3">
                            <h3>OJOS</h3>
                            <a href="#">Paletas de maquillaje</a>
                            <a href="#">Delineadores</a>
                            <a href="#">Cejas</a>
                            <a href="#">Pestañas postizas</a>
                        </div>
                        <div class="col-md-3">
                            <h3>ACCESORIOS</h3>
                            <a href="#">Brochas y aplicadores</a>
                            <a href="#">Cosmetiqueras</a>
                            <a href="#">Organizadores</a>
                            <a href="#">Espejos</a>
                            <a href="#">Herramientas y accesorios</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>


<div class="container-fluid ps-0 pe-0">
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


<h1 class=" tittle p-5 fs-5" >TODOS LOS PRODUCTOS</h1>
<div class="container">
    <div class="row">
        @foreach ($productos as $producto)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $producto->imagen }}" class="card-img-top" alt="{{ $producto->nombre }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">{{ $producto->descripcion }}</p>
                    <p class="card-text"><strong>Precio:</strong> ${{ $producto->precio_venta }}</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

</body>
</html>


