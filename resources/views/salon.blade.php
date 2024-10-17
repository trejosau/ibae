@extends('layouts.app')

@section('title', 'Salon')

@section('content')

<style>
    .contenedor{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: 1fr 1fr;
    }

    .button{
        text-align: center;
    }

    .splide__slide img {
        width: 100%;           
        height: auto;
        max-height: 400px;   
        object-fit: cover;     
    }

    .tittle{
        text-align: center
    }
</style>

<main>
    <!-- Carrusel Splide -->
    <div id="splide" class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <img src="{{ asset('images/brunette-woman-with-mobile-phone-getting-her-hair-done.jpg') }}" alt="Imagen 1">
                </li>
                <li class="splide__slide">
                    <img src="{{ asset('images/cheerful-stylist-applying-makeup-anonymous-woman.jpg') }}" alt="Imagen 2">
                </li>
                <li class="splide__slide">
                    <img src="{{ asset('images/table-stylist-studio.jpg') }}" alt="Imagen 3">
                </li>
            </ul>
        </div>
    </div>

    <div class="tittle"> <h1 class="fs-1 pb-3">Nuestros Servicios</h1></div>

    <div class="contenedor">

            <div class="lista 1">
                <div> <img class="img-fluid p-4" src="{{ asset('images/healthy-beautiful-manicure-manicurist.jpg') }}" alt=""></div>
                <div class="tittle"><H2>Manicura y Pedicura</H2></div>
            </div>

            <div class="lista 2">
                <div> <img class="img-fluid p-4" src="{{ asset('images/blonde-girl-getting-her-hair-done.jpg') }}" alt=""></div>
                <div class="tittle"><h2>Color</h2></div>
            </div>

            <div class="lista 3">
                <div> <img class="img-fluid p-4" src="{{ asset('images/woman-getting-her-hair-cut-beauty-salon.jpg') }}" alt=""></div>
                <div class="tittle"><h2>Corte y Estilizado</h2></div>

            </div>

            <div class="lista 4">
                <div> <img class="img-fluid p-4" src="{{ asset('images/hairdresser-styling-client-s-hair.jpg') }}" alt=""></div>
                <div class="tittle"><h2>Alisado y Tratamiento</h2></div>

            </div>

            <div class="lista 5">
                <div> <img class="img-fluid p-4" src="{{ asset('images/high-angle-hand-holding-pink-swab.jpg') }}" alt=""></div>
                <div class="tittle"><h2>Cejas y Pestañas</h2></div>

            </div>

            <div class="lista 6">
                <div> <img class="img-fluid p-4" src="{{ asset('images/beautiful-female-model-with-natural-make-up-done-by-professional-artist.jpg') }}" alt=""></div>
                <div class="tittle"><h2>Maquillaje y Peinado</h2></div>
            </div>

    </div>

    <div class="tittle pt-5 pb-5"><a href="#"  class="btn btn-primary">Agenda Tu Cita</a></div>
</main>

<!-- Agrega los scripts de Splide al final -->
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
