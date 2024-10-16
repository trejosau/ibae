@extends('layouts.app')

@section('title', 'Salon')

@section('content')

<style>
    .contenedor{
        display: grid;
        grid-template-columns: 1fr 1fr;
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
                    <img src="{{ asset('images/brunette-woman-with-mobile-phone-getting-her-hair-done.jpg') }}" alt="Imagen 2">
                </li>
                <li class="splide__slide">
                    <img src="{{ asset('images/brunette-woman-with-mobile-phone-getting-her-hair-done.jpg') }}" alt="Imagen 3">
                </li>
            </ul>
        </div>
    </div>

    <div class="contenedor row">
        <div>
            <img class="img-fluid pt-4 pb-4" src="{{ asset('images/brunette-woman-with-mobile-phone-getting-her-hair-done.jpg') }}" alt="">
        </div>

        <div class="justify-content-center">
            <h2 class="fs-2 pt-4">Salon Ibae</h2>
            <p class="fs-4 pb-4 pt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem eius deleniti recusandae ipsa, quam pariatur optio deserunt tenetur tempore at veritatis dolor dolore, repudiandae laborum aperiam blanditiis corporis? Sapiente, cupiditate!</p>

            <div class="button">
                <a href="#" class="btn btn-primary">Reservar una Cita</a>
            </div>
        </div>
    </div>
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
