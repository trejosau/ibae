<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beauty Salon Carousel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Estilo básico para el carrusel */
        .carousel-item img {
            width: 100%;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        /* Fondo con imagen del slide */
        .carousel-item {
            position: relative;
            background-size: cover;
            background-position: center;
        }

        /* Aplicar el blur solo en los bordes usando pseudo-elementos */
        .carousel-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: cover;
            background-position: center;
            z-index: -1;
            filter: blur(10px);
        }

        .slide1::before {
            background-image: url('{{ asset('images/2646156.jpg') }}');
        }

        .slide2::before {
            background-image: url('{{ asset('images/7813697.jpg') }}');
        }

        .slide3::before {
            background-image: url('{{ asset('images/7216423.jpg') }}');
        }

        /* Estilos por defecto para pantallas grandes */
        .carousel-item img {
            max-height: 500px;
            min-height: 500px;
        }

        .carousel-item {
            filter: grayscale(60%);
            transition: filter .8s ease;
        }

        .carousel-item:hover {
            filter: none;
        }

        /* Estilo personalizado para el caption */
        .carousel-caption h5 {
            font-size: 3rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #f556a3;
        }

        .carousel-caption p {
            font-size: 1.5rem;
        }

        /* Para pantallas medianas (tablets) */
        @media (max-width: 1024px) {
            .carousel-item img {
                max-height: 400px;
                min-height: 400px;
            }

            .carousel-caption h5 {
                font-size: 2.5rem;
            }

            .carousel-caption p {
                font-size: 1.3rem;
            }
        }

        /* Para pantallas pequeñas (móviles) */
        @media (max-width: 768px) {
            .carousel-item img {
                max-height: 300px;
                min-height: 300px;
            }

            .carousel-caption h5 {
                font-size: 2rem;
            }

            .carousel-caption p {
                font-size: 1.1rem;
            }
        }

        /* Para pantallas extra pequeñas */
        @media (max-width: 576px) {
            .carousel-item img {
                max-height: 250px;
                min-height: 250px;
            }

            .carousel-caption h5 {
                font-size: 1.8rem;
            }

            .carousel-caption p {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
@include('components.navbar')
<div id="carouselExampleDark" class="carousel carousel-dark slide carousel-fade mt-0" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active slide1" data-bs-interval="10000">
            <a href="https://www.example.com/">
                <img src="{{ asset('images/2646156.jpg') }}" class="d-block w-100" alt="Slide 1">
            </a>
            <div class="carousel-caption d-none d-md-block text-light">
                <h5>Mensaje publicitario</h5>
                <p>Professional treatments to enhance your natural beauty.</p>
            </div>
        </div>
        <div class="carousel-item slide2">
            <a href="https://www.example.com/">
                <img src="{{ asset('images/7813697.jpg') }}" class="d-block w-100" alt="Slide 2">
            </a>
            <div class="carousel-caption d-none d-md-block">
                <h5>Relax & Rejuvenate</h5>
                <p>Experience the luxury of a personalized beauty session.</p>
            </div>
        </div>
        <div class="carousel-item slide3">
            <a href="https://www.example.com/">
                <img src="{{ asset('images/7216423.jpg') }}" class="d-block w-100" alt="Slide 3">
            </a>
            <div class="carousel-caption d-none d-md-block">
                <h5>Your Glow, Our Priority</h5>
                <p>Expert care for your skin, hair, and wellness needs.</p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
</body>

</html>
