<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBA&E</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        body.loading {
            overflow: hidden;
        }

        body main {
            display: block;
        }

        main {
            display: none;
        }
    </style>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</head>
<body class="roboto loading">
@include('components.loading')

<main>
    @include('components.frames')
    @include('components.navbar')
    @include('components.servicios')
    @include('components.faq')

    <div class="container my-5 map-section">
        <h2>Encuéntranos Aquí</h2>
        <p>Estamos ubicados en el centro de Matamoros, Coahuila. Visítanos para cualquiera de nuestros servicios de belleza.</p>

        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d225.01689769054244!2d-103.22864431848255!3d25.529369616122946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fc12cfd3c23c3%3A0xb149153182ebb682!2sAv.%20V.%20Carranza%202%2C%20Centro%2C%2027440%20Matamoros%2C%20Coah.!5e0!3m2!1ses!2smx!4v1728718522640!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <a href="https://maps.app.goo.gl/8Nj58J5KquzNhz4x5" target="_blank" class="map-button mt-3">Obtener indicaciones</a>
    </div>
</main>

@include('components.footer')

<script>
    document.body.classList.add('loading');


    window.addEventListener('load', function () {
        const loadingScreen = document.getElementById('loading-screen');
        const body = document.body;

        setTimeout(() => {
            loadingScreen.style.display = 'none';
            body.classList.remove('loading');
            document.body.classList.add('loaded');
        }, 500);
    });
</script>
</body>
</html>
