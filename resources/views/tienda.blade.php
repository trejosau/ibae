@extends('layouts.app')

@section('content')
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

    .splide__slide img {
        width: 100%;           
        height: auto;
        max-height: 400px;   
        object-fit: cover;     
    }
    .imagen-circular {
    width: 150px;      /* Ajusta el tamaño de la imagen según sea necesario */
    height: 150px;     /* La altura debe coincidir con el ancho para un círculo perfecto */
    border-radius: 50%; /* Esto hace que la imagen sea circular */
    object-fit: cover;  /* Asegura que la imagen cubra el área sin distorsionarse */
}




</style>

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


<div id="splide" class="splide">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide">
                <img src="{{ asset('images/2646156.jpg') }}" alt="Imagen 1">
            </li>
            <li class="splide__slide">
                <img src="{{ asset('images/7216423.jpg') }}" alt="Imagen 2">
            </li>
            <li class="splide__slide">
                <img src="{{ asset('images/7813697.jpg') }}" alt="Imagen 3">
            </li>
        </ul>
    </div>
</div>

<div class="tittle p-5 fs-4"><h1>ECHA UN VISTAZO A NUESTRAS CATEGORIAS</h1></div>

<div class="contenedor pb-4">
        <div>
            <div class="tittle"><a href=""><img src="{{ asset('images/hairdresser-styling-client-s-hair.jpg') }}" alt="Descripción" class="imagen-circular"></a></div>
            <div class="tittle"><h2>Cabello</h2></div>
        </div>
        <div>
            <div class="tittle"><a href=""><img src="{{ asset('images/hairdresser-styling-client-s-hair.jpg') }}" alt="Descripción" class="imagen-circular"></a></div>
            <div class="tittle"><h2>Cabello</h2></div>
        </div>
        <div>
            <div class="tittle"><a href=""><img src="{{ asset('images/hairdresser-styling-client-s-hair.jpg') }}" alt="Descripción" class="imagen-circular"></a></div>
            <div class="tittle"><h2>Cabello</h2></div>
        </div>
        <div>
            <div class="tittle"><a href=""><img src="{{ asset('images/hairdresser-styling-client-s-hair.jpg') }}" alt="Descripción" class="imagen-circular"></a></div>
            <div class="tittle"><h2>Cabello</h2></div>
        </div>
        <div>
            <div class="tittle"><a href=""><img src="{{ asset('images/hairdresser-styling-client-s-hair.jpg') }}" alt="Descripción" class="imagen-circular"></a></div>
            <div class="tittle"><h2>Cabello</h2></div>
        </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Splide('#splide', {
            type   : 'loop',     // Carrusel en bucle
            perPage: 1,          // Mostrar una imagen a la vez
            autoplay: true,      // Reproducción automática
            interval: 3000,      // Intervalo de 3 segundos
        }).mount();
    });
</script>
@endsection
