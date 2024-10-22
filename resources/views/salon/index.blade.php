<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Transparente</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            background-color: #ccf3dc; /* Color del body */
            overflow-x: hidden; /* Evitar scroll horizontal */
        }

        .header {
            background-color: transparent;
            position: absolute;
            width: 100%;
            max-height: 110px;
            z-index: 1000;
            transition: background-color 0.3s ease-in-out; /* Transición de color al hacer scroll */
            animation: slideDown 1s ease-out;
            margin-bottom: 110px;
        }

        .navbar {
            box-shadow: none;
            padding: 0;
        }

        .navbar-nav {
            display: flex;
            justify-content: center; /* Centrar los elementos del menú */
            flex-wrap: wrap;
            padding: 10px;
        }

        .nav-item {
            margin: 0 15px; /* Espacio entre los elementos */
        }

        .nav-link {
            color: #cd678b; /* Color del texto */
            transition: color 0.3s, border 0.3s, transform 0.3s; /* Transiciones para el color, borde y transformación */
            padding: 10px 15px; /* Espacio interior */
            border: 2px solid transparent; /* Borde transparente inicialmente */
            border-radius: 50px; /* Borde circular */
        }

        .nav-link:hover {
            color: #f4b3c2; /* Color del texto al pasar el mouse */
            border-color: #f4b3c2; /* Borde al pasar el mouse */
        }

        .icons {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .icons a {
            color: #cd678b;
            margin-left: 15px;
            transition: color 0.3s, transform 0.3s;
        }

        .icons a:hover {
            color: #f4b3c2;
            transform: rotate(15deg) scale(1.1);
        }

        .logo {
            max-width: 100px; /* Ajusta el tamaño máximo según lo necesites */
            height: auto; /* Mantiene la proporción de la imagen */
            display: block; /* Se comporta como un bloque */
            animation: fadeIn 5s ease-in-out; /* Animación de entrada */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        main {
            padding-top: 120px;
        }

        /* Estilos para la sección de la imagen y texto */
        .image-section {
            text-align: left;
            padding: 50px;
            position: relative; /* Hacer la posición relativa para la imagen */
        }

        .image-section .text-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .image-section h1 {
            font-size: 48px;
            color: #333;
            margin-bottom: 20px;
        }

        .cta-button {
            background-color: #cd678b;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 30px;
            transition: background-color 0.3s ease-in-out;
            margin-top: 20px;
        }

        .cta-button:hover {
            background-color: #f4b3c2;
        }

        .image-section img {
            max-width: 100%;
            max-height: 600px; /* Establece la altura máxima */
            height: auto; /* Mantiene la proporción de la imagen */
            position: relative;
            z-index: 2;
        }

        /* Nueva sección con fondo cd678b */
        .new-section {
            background-color: #ffecec;
            padding: 50px 0;
            color: white;
            text-align: center;
            margin-top: -100px; /* Ajustar para que suba detrás de la imagen */
            position: relative;
            z-index: 1; /* Colocar debajo de la imagen */
        }

        .new-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .new-section p {
            font-size: 18px;
        }

        /* Estilos para el Swiper */
        .swiper {
            width: 100%;
            padding: 30px 0;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: cover;
        }
    </style>
</head>
<body>
@include('components.navbarSalon')

<main class="container-fluid">
    <div class="row image-section">
        <div class="col-md-3"></div> <!-- Primera columna vacía -->
        <div class="col-md-5 text-content">
            <span class="birthstone-regular" style="font-size: 2rem; color: #d99db7;">Rosy Saucedo Salon</span>
            <h1 class="quintessential-regular">Transforma tu look con nosotros</h1>
            <button class="cta-button">Agenda tu cita ahora</button>
        </div>
        <div class="col-md-3">
            <img src="https://romanamx.com/cdn/shop/products/BeautyCreations-CORRECTORCOBERTURACOMPLETAC02BC_6.jpg?v=1647617968" alt="Imagen de salón"
                 style="border: 10px solid white; padding: 0; margin: 0;">
        </div>
        <div class="col-md-1"></div> <!-- Última columna vacía -->
    </div>

    <div class="row new-section">
        <div class="col-12">
            <span class="birthstone-regular" style="font-size: 2rem; color: #cd678b;">Nuestros servicios</span>

            <!-- Aquí va el carrusel -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://images.hdqwalls.com/download/minimal-landscape-sunrise-4k-jy-1080x1920.jpg" alt="Paisaje minimalista">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.hdqwalls.com/download/spiderman-red-suit-minimal-4k-xc-1080x1920.jpg" alt="Spiderman traje rojo">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.hdqwalls.com/download/exploring-the-world-spiderman-2099-h8-1080x1920.jpg" alt="Spiderman 2099">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.hdqwalls.com/download/marvels-spider-man-2-game-5k-4b-1080x1920.jpg" alt="Spider-Man 2">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.hdqwalls.com/download/venom-unleashed-marvels-spider-man-2-fw-1080x1920.jpg" alt="Venom Spider-Man 2">
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>

</body>
</html>
