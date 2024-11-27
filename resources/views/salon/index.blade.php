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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        
        body {
            margin: 0;
            background-color: #ccf3dc;
            overflow-x: hidden;
        }
        .btn.nav-icons {
        background-color: #cd678b; /* Color de fondo */
        color: white; /* Color del texto */
        padding: 10px 20px; /* Espaciado alrededor del texto */
        border-radius: 5px; /* Bordes redondeados */
        text-decoration: none; /* Eliminar subrayado */
        font-size: 16px; /* Tamaño de la fuente */
        font-weight: bold; /* Negrita */
        transition: background-color 0.3s, transform 0.2s; /* Transición suave */
    }

    .btn.nav-icons:hover {
        background-color: #a75b74; /* Color de fondo al pasar el ratón */
        transform: scale(1.05); /* Efecto de agrandamiento */
    }

    .btn.nav-icons:active {
        background-color: #934e66; /* Color de fondo al hacer clic */
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
        .services-section {
            background-color: #ffecec;
            padding: 50px 0;
            color: white;
            text-align: center;
            margin-top: -100px; /* Ajustar para que suba detrás de la imagen */
            position: relative;
            z-index: 1; /* Colocar debajo de la imagen */
        }

        .services-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .services-section p {
            font-size: 18px;
        }

        /* Estilos para el Swiper */
        .swiper {
            width: 100%;
            padding: 30px 0;
        }
        .label {
            position: absolute;
            bottom: 10px; /* Ajusta la distancia desde la parte inferior */
            left: 50%;
            transform: translateX(-50%);
            font-size: 2.5rem; /* Tamaño de texto */
            color: #cd678b; /* Color de texto */
            background-color: rgba(255, 255, 255, 0.5);
            padding: 5px 10px; /* Espaciado interno */
            border-radius: 5px; /* Bordes redondeados */
            text-align: center; /* Centrar texto */
            font-family: 'Quintessential', serif; /* Fuente personalizada */
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

        .photo-gallery {
            padding: 50px 0;
        }

        .photo-gallery h2 {
            margin-bottom: 30px;
            font-size: 26px;
            text-align: center;
            color: #333;
        }

        .photo-gallery .photos {
            display: flex;
            flex-wrap: wrap;
        }

        .photo-gallery .item {
            padding: 15px;
        }

        .photo-gallery figure {
            position: relative;
            overflow: hidden;
        }

        .photo-gallery img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
            aspect-ratio: 1 / 1; /* Mantener proporción 1:1 */
            display: block;
            transition: transform 0.3s ease-in-out;
        }

        /* Efecto de brillo (shine) */
        .photo-gallery figure::before {
            content: '';
            position: absolute;
            top: 0;
            left: -75%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.5) 100%);
            transform: skewX(-25deg);
            transition: left 0.75s ease-in-out;
            z-index: 1;
        }

        .photo-gallery figure:hover::before {
            left: 125%;
        }

        /* Efecto hover en la imagen */
        .photo-gallery figure:hover img {
            transform: scale(1.05);
            z-index: 2;
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
            <a href="{{ route('salon.agendar') }}" class="cta-button">Agenda tu cita ahora</a>
        </div>
        <div class="col-md-3">
            <img src="https://romanamx.com/cdn/shop/products/BeautyCreations-CORRECTORCOBERTURACOMPLETAC02BC_6.jpg?v=1647617968" alt="Imagen de salón"
                 style="border: 10px solid white; padding: 0; margin: 0;">
        </div>
        <div class="col-md-1"></div> <!-- Última columna vacía -->
    </div>

    <div class="row services-section">
        <div class="col-12">
            <span class="birthstone-regular" style="font-size: 2rem; color: #cd678b;">Nuestros servicios</span>

            <!-- Aquí va el carrusel de servicios -->
            <div class="swiper mySwiperServicios">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZfN67YRDY3wQjcDxj-GJv3hRGwgTnbKlKpw&s" alt="Paisaje minimalista">
                        <div class="label">Mechas</div>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://media.glamour.mx/photos/61908f022d97bd4c522ab7e2/master/w_1600%2Cc_limit/195052.jpg" alt="Spiderman traje rojo">
                        <div class="label">Manicura</div>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://www.olgacamargo.com/wp-content/uploads/2019/03/taninoplastia-con-keratina-olga-camargo-21-antes-y-despu%C3%A9s.jpg" alt="Spiderman 2099">
                        <div class="label">Alisados</div>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://popcosmeticsmx.com/cdn/shop/articles/Diseno_sin_titulo_43.png?v=1642804459" alt="Spider-Man 2">
                        <div class="label">Pestañas</div>
                    </div>
                    <div class="swiper-slide">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8yvgKZ0zKzisJPGvAs0aHcjyV7I3THU3jxw&s" alt="Venom Spider-Man 2">
                        <div class="label">Cejas</div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <div class="photo-gallery">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Nuestras instalaciones</h2>
            </div>
            <div class="row photos">
                <div class="col-sm-6 col-md-4 col-lg-3 item">
                    <a href="https://peakbusinessvaluation.com/wp-content/uploads/Business-Valuation-for-Buying-a-Hair-and-Nail-Salon.jpg" data-lightbox="photos">
                        <figure>
                            <img class="img-fluid" src="https://peakbusinessvaluation.com/wp-content/uploads/Business-Valuation-for-Buying-a-Hair-and-Nail-Salon.jpg" alt="Salón 1">
                        </figure>
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 item">
                    <a href="https://www.daysmart.com/salon/wp-content/uploads/sites/2/2023/09/fetaure-beauty-bar.jpg" data-lightbox="photos">
                        <figure>
                            <img class="img-fluid" src="https://www.daysmart.com/salon/wp-content/uploads/sites/2/2023/09/fetaure-beauty-bar.jpg" alt="Salón 2">
                        </figure>
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 item">
                    <a href="https://5.imimg.com/data5/SELLER/Default/2021/1/KU/WP/HK/121167792/beauty-palour-interior-500x500.jpg" data-lightbox="photos">
                        <figure>
                            <img class="img-fluid" src="https://5.imimg.com/data5/SELLER/Default/2021/1/KU/WP/HK/121167792/beauty-palour-interior-500x500.jpg" alt="Salón 3">
                        </figure>
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 item">
                    <a href="https://img.freepik.com/premium-photo/elegant-modern-beauty-salon_456977-1626.jpg" data-lightbox="photos">
                        <figure>
                            <img class="img-fluid" src="https://img.freepik.com/premium-photo/elegant-modern-beauty-salon_456977-1626.jpg" alt="Salón 4">
                        </figure>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-12">
            <div class="row">
                <!-- Columna de Imagen -->
                <div class="col-6">
                    <img
                        src="{{asset('images/logo-salon.jpg')}}"
                        alt="Rosy Saucedo Salon"
                        class="img-fluid w-100 h-100 object-fit-cover about-image"
                        style="max-height: 500px;">
                </div>

                <!-- Columna de Texto -->
                <div class="col-6 d-flex flex-column justify-content-center">
        <span class="birthstone-regular fs-2" style="color: #cd678b;">
          Sobre Rosy Saucedo Salon
        </span>
                    <p class="fs-4 pb-2 gowun-dodum-regular">
                        Este es el lugar ideal para transformar tu estilo.
                    </p>
                    <p class="fs-5 pb-4 gowun-dodum-regular ">
                        Abrimos de Lunes a Sabado de 10:00am a 8:00pm. Nos encantará conocerte y disfrutar de nuestra experiencia.
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
                                Llamanos!
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
    <div class="swiper mySwiperReferencias">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="card p-3" style="border-radius: 10px;">
                    <div class="row mb-3">
                        <div class="col-6 text-center">
                            <img src="https://th.bing.com/th/id/R.0923cb9d753205e4932b1d58fde3199a?rik=WvJvTwSyoxfJbQ&pid=ImgRaw&r=0" alt="Cliente 1" style="border-radius: 75px; border: 3px solid #f4b3c2; display: block; margin: 0 auto;">
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
                            <img src="https://th.bing.com/th/id/R.066b97a1ee609c9a0a332e9f5ab17370?rik=NG90vvPJE4BRWg&riu=http%3a%2f%2fhdqwalls.com%2fdownload%2f1%2fgorgeous-model-portrait-kr.jpg&ehk=i6ckM7pTAhYr2l96Ftt37YJtvZMR0qbzMZJVuV6OxWc%3d&risl=&pid=ImgRaw&r=0" alt="Cliente 2" style="border-radius: 75px; border: 3px solid #f4b3c2; display: block; margin: 0 auto;">
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
                            <img src="https://c.wallhere.com/photos/84/21/portrait_women_model_face_Nikolas_Verano-1461367.jpg!d" alt="Cliente 3" style="border-radius: 75px; border: 3px solid #f4b3c2; display: block; margin: 0 auto;">
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
                            <img src="https://th.bing.com/th/id/R.0830e5202e7be47ba5478bd182ec3afc?rik=%2bjJZJO0Ijhcv0w&pid=ImgRaw&r=0" alt="Cliente 4" style="border-radius: 75px; border: 3px solid #f4b3c2; display: block; margin: 0 auto;">
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
                            <img src="https://londonfem.com/wp-content/uploads/2016/06/secretos-de-belleza-londonfem.jpg" alt="Cliente 5" style="border-radius: 75px; border: 3px solid #f4b3c2; display: block; margin: 0 auto;">
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
    <div class="row" style="position: relative; height: 540px;">
        <!-- Mapa de Google embebido -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d225.0170023520013!2d-103.228792592773!3d25.529313817182658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fc10721cb0b2b%3A0x42112eb1d8fa7a46!2sInstituto%20de%20Belleza%20Arte%20%26%20Estilo!5e0!3m2!1ses!2smx!4v1729825845825!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
    <div class="container py-4 be-vietnam-pro-semibold">
        <div class="row text-center">
            <div class="col-md-4 ">
                <div class="mb-2">
                    <i class="bi bi-geo-alt-fill contact-icon" style="background-color: #82c99b; padding: 7px;  border-radius: 50%; "></i>
                </div>
                <h5>Dirección</h5>
                <p class="gowun-dodum-regular">Matamoros Coahuila <br> Av. Carranza Altos #2</p>
            </div>
            <div class="col-md-4">
                <div class="mb-2">
                    <i class="bi bi-telephone-fill contact-icon" style="background-color: #82c99b; padding: 7px;  border-radius: 50%; "></i>
                </div>
                <h5>Telefono</h5>
                <p class="gowun-dodum-regular">+52 (871) 234 56 78</p>
            </div>
            <div class="col-md-4">
                <div class="mb-2">
                    <i class="bi bi-envelope-fill contact-icon"style="background-color: #82c99b; padding: 7px;  border-radius: 50%; "></i>
                </div>
                <h5>Correo</h5>
                <p class="gowun-dodum-regular">ibae@gmail.com</p>
            </div>
        </div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

</body>
</html>
