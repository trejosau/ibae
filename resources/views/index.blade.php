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
        /* --- FRAME CONTAINER --- */
        .frame-container {
            position: relative;
            height: calc(100vh - 99px);
            background-color: #202020;
        }

        /* Fotogramas */
        .frame {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .frame-container .frame:first-child {
            display: block;
        }

        .map-section {
            text-align: center;
            color: #1e1e1e;
            font-family: 'Roboto', sans-serif;
            padding: 20px;
        }

        .map-title {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        .map-description {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #555;
        }

        /* --- Contenedor del mapa con animación de entrada --- */
        .map-container {
            position: relative;
            padding-bottom: 56.25%; /* Relación de aspecto 16:9 */
            height: 0;
            max-width: 100%;
            margin: 0 auto 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            opacity: 0; /* Oculto inicialmente */
            transform: translateY(80px) scale(0.95);
            filter: blur(8px);
            transition: opacity 1s ease-out, transform 1s ease-out, filter 1s ease-out;
        }

        /* Activación de la animación */
        .map-container.show {
            opacity: 1;
            transform: translateY(0) scale(1);
            filter: blur(0);
        }

        /* --- Estilo del iframe dentro del contenedor del mapa --- */
        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
            border-radius: 8px;
        }

        /* --- Botón para obtener indicaciones --- */
        .map-button {
            background-color: #ff69b4;
            border: none;
            padding: 12px 24px;
            font-size: 1.2rem;
            border-radius: 5px;
            transition: background-color 0.3s;
            color: white;
            text-decoration: none;
        }

        .map-button:hover {
            background-color: #e357a1;
        }


        /* --- NAVBAR STYLES --- */
        .navbar {
            background-color: #081444;
            transition: background-color 0.3s, box-shadow 0.3s;
            padding: 10px 0;
            box-shadow: none;
        }

        @media (min-width: 768px) {
            .navbar {
                min-height: 99px;
                max-height: 99px;
            }
        }

        .fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: #081444;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
        }

        .nav-item a {
            padding: 5px 1rem;
            margin: 0 -.25rem;
            font-size: 27px;
            border: none;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            background-image: linear-gradient(
                to right,
                #e089b2,
                #e089b2 50%,
                #ffffff 50%
            );
            background-size: 200% 100%;
            background-position: -100%;
            display: inline-block;
            position: relative;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.2s ease-in-out;
        }

        .nav-item a:hover {
            background-position: 0;
            border-bottom: 3px solid #e089b2;
        }


        .nav-item .icono {
            color: #ffffff;
            margin-right: 20px;
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
        <h1>IBAE</h1>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d225.0170023520013!2d-103.228792592773!3d25.529313817182658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fc10721cb0b2b%3A0x42112eb1d8fa7a46!2sInstituto%20de%20Belleza%20Arte%20%26%20Estilo!5e0!3m2!1ses!2smx!4v1729825845825!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
        }, 0);
    });
</script>
</body>
</html>
