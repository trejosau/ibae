<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beauty Salon Carousel</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100%;
            font-family: 'Poppins', sans-serif; /* Cambia a Poppins para un estilo moderno */
            background-color: #f3f3f3;
        }

        .navbar {
            background-color: #333; /* Color de fondo de la barra de navegación */
            color: white;
            padding: 10px;
            text-align: center;
        }

        .swiper {
            width: 100vw;
            height: 60vh; /* Ajusta la altura del carrusel */
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden; /* Ocultar cualquier parte de la imagen que sobresalga */
        }

        .swiper-slide img {
            width: 100%; /* Mantener ancho completo del contenedor */
            height: auto; /* Mantener proporción 16:9 */
            max-height: 100%; /* Limitar la altura al 100% del contenedor */
            transition: width 0.5s ease, height 0.5s ease; /* Transición suave de imagen */
            object-fit: cover; /* Cubrir todo el contenedor */
        }

        .swiper-slide.zoomed-out img {
            width: 80%; /* Ajustar ancho para simular recorte */
            height: 80%; /* Ajustar altura para simular recorte */
        }

        .outlined-text {
            position: absolute;
            font-size: 88px; /* Tamaño del texto */
            font-weight: bold;
            color: transparent;
            -webkit-text-stroke: 3px #fff; /* Contorno blanco */
            text-transform: uppercase;
            transition: color 0.5s ease, -webkit-text-stroke 0.5s ease;
        }

        .normal {
            color: #fff; /* Color del texto normal */
            -webkit-text-stroke: 0; /* Sin borde */
        }

        .zoom-out-text {
            color: transparent;
            -webkit-text-stroke: 3px #fff; /* Solo borde al hacer zoom out */
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #fff;
            width: 50px;
            height: 50px;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 20px; /* Tamaño de los iconos */
        }

        .services {
            text-align: center;
            padding: 40px;
        }

        .service-circle {
            margin: 10px;
            border-radius: 50%;
            width: 100px;
            height: 100px;
            background-color: #E8C65C;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

<!-- Barra de navegación -->
<div class="navbar">
    <h1>Beauty Salon</h1>
</div>

<div class="swiper-container swiper">
    <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide" style="background-color: #9FA051;">
            <img src="https://watermark.lovepik.com/photo/20211210/large/lovepik-beauty-salon-beauty-division-facial-care-picture_501763564.jpg" alt="Slide 1">
            <h1 class="outlined-text zoom-out-text">Alaciados</h1>
        </div>
        <!-- Slide 2 -->
        <div class="swiper-slide" style="background-color: #9B89C5;">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSr2LKcbDK7excHznv4oksGIetvmtLEJAesGA&s" alt="Slide 2">
            <h1 class="outlined-text zoom-out-text">Colorimetría</h1>
        </div>
        <!-- Slide 3 -->
        <div class="swiper-slide" style="background-color: #D7A594;">
            <img src="https://naomisheadmasters.com/wp-content/uploads/2023/12/Top-10-Salons-In-Himachal-Pradesh1.jpg" alt="Slide 3">
            <h1 class="outlined-text zoom-out-text">Producto 3</h1>
        </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<div class="services">
    <h2>Servicios de Belleza</h2>
    <div style="display: flex; justify-content: center;">
        <div class="service-circle">Servicio 1</div>
        <div class="service-circle">Servicio 2</div>
        <div class="service-circle">Servicio 3</div>
    </div>
</div>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
        loop: true,
        autoplay: {
            delay: 4000, // Cada slide dura 4 segundos en total
            disableOnInteraction: false,
        },
        speed: 500, // Velocidad del cambio de slide
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        on: {
            slideChangeTransitionStart: function () {
                const slides = document.querySelectorAll('.swiper-slide');
                slides.forEach(slide => {
                    slide.classList.add('zoomed-out');
                    const text = slide.querySelector('.outlined-text');
                    text.classList.add('zoom-out-text');
                    text.classList.remove('normal');
                });
            },
            slideChangeTransitionEnd: function () {
                const activeSlide = document.querySelector('.swiper-slide-active');
                const text = activeSlide.querySelector('.outlined-text');

                // Zoom out al inicio (primeros 1.5 segundos)
                setTimeout(() => {
                    activeSlide.classList.remove('zoomed-out');
                    text.classList.remove('zoom-out-text');
                    text.classList.add('normal');
                }, 1500); // A los 1.5 segundos

                // Zoom out al final (al segundo 4)
                setTimeout(() => {
                    activeSlide.classList.add('zoomed-out');
                    text.classList.add('zoom-out-text');
                    text.classList.remove('normal');
                }, 3500); // A los 3.5 segundos
            }
        }
    });
</script>
</body>

</html>
