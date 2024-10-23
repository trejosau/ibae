<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            background-color: #ccf3dc;
            overflow-x: hidden;
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
            animation: fadeIn 1.5s ease-in-out; /* Animación de entrada */
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


        .image-section {
            text-align: left;
            padding: 50px;
            position: relative;
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

        /* Card styles */
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%;
            text-align: center;
        }

        .card img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .card h5 {
            margin: 10px 0;
            font-size: 1.2rem;
        }

        .card p {
            font-size: 0.9rem;
            color: #666;
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

            <!-- Aquí va el carrusel de servicios -->
            <div class="swiper mySwiperServicios">
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
    <div class="row pb-5">
        <div class="col-12">
            <div class="row">
                <!-- Columna de Imagen -->
                <div class="col-6">
                    <img
                        src="https://images.hdqwalls.com/download/spiderman-red-suit-minimal-4k-xc-1080x1920.jpg"
                        alt="Spiderman traje rojo"
                        class="img-fluid w-100 h-100 object-fit-cover"
                        style="max-height: 500px;">
                </div>

                <!-- Columna de Texto -->
                <div class="col-6 d-flex flex-column justify-content-center">
        <span class="birthstone-regular fs-2" style="color: #cd678b;">
          Sobre Rosy Saucedo Salon
        </span>
                    <p class="fs-4 pb-2 gowun-dodum-regular">
                        Este es el lugar ideal para transformar tu estilo y resaltar tu belleza única.
                    </p>
                    <p class="fs-5 pb-4 gowun-dodum-regular ">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem eius deleniti recusandae ipsa, quam pariatur optio deserunt tenetur tempore at veritatis dolor dolore, repudiandae laborum aperiam blanditiis.
                    </p>
                    <div class="d-flex align-items-center gap-3 be-vietnam-pro-semibold">
                        <div
                            class="icon-background"
                            style="background-color: #82c99b; padding: 15px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-phone fa-2x text-white"></i>
                        </div>
                        <div>
                            <div
                                class="fs-6 text-muted"
                                style="font-size: 1rem; margin-bottom: 10px;">
                                Call us now!
                            </div>
                            <div
                                class="phone-number"
                                style="font-size: 1.25rem; color: #52986b;">
                                +52 (871) 234 56 78
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="row" style="position: relative; height: 540px;">
        <!-- Mapa de Google embebido -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d225.01693992381237!2d-103.2288307!3d25.5293471!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fc12cfd56e333%3A0x921f869f5ff67324!2sAv.%20V.%20Carranza%202-altos%2C%20Centro%2C%2027440%20Matamoros%2C%20Coah.!5e0!3m2!1ses!2smx!4v1729703356765!5m2!1ses!2smx" width="600" height="540" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <!-- Imagen PNG superpuesta -->
        <div class="col-12"
             style="
         position: absolute;
         top: 0;
         right: 0;
         height: 540px;
         background-image: url('{{asset('images/beauty-png.png')}}');
         background-size: contain;
         background-repeat: no-repeat;
         background-position: right;
         width: 100%;
         z-index: 1;
         pointer-events: none;">
        </div>
    </div>
    <div class="container py-4">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="mb-2">
                    <i class="bi bi-geo-alt-fill contact-icon" style="background-color: #82c99b; padding: 7px;  border-radius: 50%; "></i>
                </div>
                <h5>Address</h5>
                <p>Matamoros Coahuila <br> Av. Carranza Altos #2</p>
            </div>
            <div class="col-md-4">
                <div class="mb-2">
                    <i class="bi bi-telephone-fill contact-icon" style="background-color: #82c99b; padding: 7px;  border-radius: 50%; "></i>
                </div>
                <h5>Phone</h5>
                <p>+52 (871) 234 56 78</p>
            </div>
            <div class="col-md-4">
                <div class="mb-2">
                    <i class="bi bi-envelope-fill contact-icon"style="background-color: #82c99b; padding: 7px;  border-radius: 50%; "></i>
                </div>
                <h5>Email</h5>
                <p>ibae@gmail.com</p>
            </div>
        </div>

    </div>
    <!-- Aquí va el carrusel de referencias -->
    <div class="swiper mySwiperReferencias">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="card p-3" style="border-radius: 10px;">
                    <div class="row mb-3">
                        <div class="col-6 text-center">
                            <img src="https://via.placeholder.com/150" alt="Cliente 1" style="border-radius: 75px; border: 3px solid #f4b3c2; display: block; margin: 0 auto;">
                            <h5 class="text-primary" style="color: #cd678b;">Cliente 1</h5>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold text-primary" style="color: #cd678b;">Servicios realizados:</p>
                            <ul class="list-unstyled" style="color: #cd678b;">
                                <li>Manicura</li>
                                <li>Pedicura</li>
                                <li>Uñas de Gel</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            <p>Excelente servicio, ambiente relajante.</p>
                            <p class="mb-2">"Muy feliz con los resultados!"</p>
                            <p class="font-weight-bold" style="color: #f4b3c2;">Fecha: 23/10/2024</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide">
                <div class="card p-3" style="border-radius: 10px;">
                    <div class="row mb-3">
                        <div class="col-6 text-center">
                            <img src="https://via.placeholder.com/150" alt="Cliente 2" style="border-radius: 75px; border: 3px solid #f4b3c2; display: block; margin: 0 auto;">
                            <h5 class="text-primary" style="color: #cd678b;">Cliente 2</h5>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold text-primary" style="color: #cd678b;">Servicios realizados:</p>
                            <ul class="list-unstyled" style="color: #cd678b;">
                                <li>Manicura</li>
                                <li>Arte en Uñas</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            <p>Trabajo amistoso y profesional!</p>
                            <p class="mb-2">"Absolutamente amé mis uñas!"</p>
                            <p class="font-weight-bold" style="color: #f4b3c2;">Fecha: 23/10/2024</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide">
                <div class="card p-3" style="border-radius: 10px;">
                    <div class="row mb-3">
                        <div class="col-6 text-center">
                            <img src="https://via.placeholder.com/150" alt="Cliente 3" style="border-radius: 75px; border: 3px solid #f4b3c2; display: block; margin: 0 auto;">
                            <h5 class="text-primary" style="color: #cd678b;">Cliente 3</h5>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold text-primary" style="color: #cd678b;">Servicios realizados:</p>
                            <ul class="list-unstyled" style="color: #cd678b;">
                                <li>Uñas de Gel</li>
                                <li>Punta Francesa</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            <p>Gran atención a los detalles!</p>
                            <p class="mb-2">"El mejor servicio de uñas en la ciudad!"</p>
                            <p class="font-weight-bold" style="color: #f4b3c2;">Fecha: 23/10/2024</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 4 -->
            <div class="swiper-slide">
                <div class="card p-3" style="border-radius: 10px;">
                    <div class="row mb-3">
                        <div class="col-6 text-center">
                            <img src="https://via.placeholder.com/150" alt="Cliente 4" style="border-radius: 75px; border: 3px solid #f4b3c2; display: block; margin: 0 auto;">
                            <h5 class="text-primary" style="color: #cd678b;">Cliente 4</h5>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold text-primary" style="color: #cd678b;">Servicios realizados:</p>
                            <ul class="list-unstyled" style="color: #cd678b;">
                                <li>Pedicura</li>
                                <li>Arte en Uñas</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            <p>Experiencia increíble, grandes resultados!</p>
                            <p class="mb-2">"Volveré seguro!"</p>
                            <p class="font-weight-bold" style="color: #f4b3c2;">Fecha: 23/10/2024</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 5 -->
            <div class="swiper-slide">
                <div class="card p-3" style="border-radius: 10px;">
                    <div class="row mb-3">
                        <div class="col-6 text-center">
                            <img src="https://via.placeholder.com/150" alt="Cliente 5" style="border-radius: 75px; border: 3px solid #f4b3c2; display: block; margin: 0 auto;">
                            <h5 class="text-primary" style="color: #cd678b;">Cliente 5</h5>
                        </div>
                        <div class="col-6">
                            <p class="font-weight-bold text-primary" style="color: #cd678b;">Servicios realizados:</p>
                            <ul class="list-unstyled" style="color: #cd678b;">
                                <li>Manicura</li>
                                <li>Uñas de Gel</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            <p>Servicio de alta calidad, muy recomendado.</p>
                            <p class="mb-2">"Simplemente la mejor experiencia!"</p>
                            <p class="font-weight-bold" style="color: #f4b3c2;">Fecha: 23/10/2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Agregar navegación (opcional) -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>



















</main>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    // Inicializar el carrusel de referencias
    var swiperReferencias = new Swiper(".mySwiperReferencias", {
        slidesPerView: 3, // Muestra 3 imágenes por slide
        spaceBetween: 30,  // Espacio entre slides
        slidesPerGroup: 1, // Avanza 1 slide a la vez
        loop: true,        // Habilita el bucle infinito
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    // Inicializar el carrusel de servicios
    var swiperServicios = new Swiper(".mySwiperServicios", {
        slidesPerView: 3, // Muestra 3 imágenes por slide
        spaceBetween: 30,  // Espacio entre slides
        slidesPerGroup: 1, // Avanza 1 slide a la vez
        loop: true,        // Habilita el bucle infinito
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>


</body>
</html>
