<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <style>
        /* Fondo elegante con imagen suave */
        body {
            background-image: url('https://picfiles.alphacoders.com/616/616408.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #5a4a4a;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        /* Contenedor principal */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            max-width: 1100px;
            padding: 2rem;
            gap: 3rem;
        }

        /* Columna con animación */
        .animation-container {
            height: 100vh;
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            width: 100%;
        }

        dotlottie-player {
            height: 100%;
            width: auto;
        }

        /* Globo de texto para el botón "Volver al Inicio" */
        .back-badge {
            position: absolute;
            bottom: 10%; /* Subido más arriba */
            left: 50%;
            transform: translateX(-50%);
            padding: 0.7rem 2rem;
            background-color: rgba(20, 29, 43, 0.9); /* Azul casi negro */
            color: #fff;
            font-weight: bold;
            border-radius: 20px;
            text-decoration: none;
            box-shadow: 0px 5px 15px rgba(20, 29, 43, 0.3);
            z-index: 10; /* Hace que el botón sobresalga */
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Columna con animación -->
    <div class="animation-container">
        <dotlottie-player src="https://lottie.host/01468193-fde7-4b26-bce5-447423f19250/vN8uWVww2A.json"
                          background="transparent"
                          speed="1"
                          playMode="normal"
                          direction="1"
                          loop
                          autoplay>
        </dotlottie-player>

        <!-- Botón "Volver al Inicio" sobresaliendo de la animación -->
        <a href="{{ url('/') }}" class="back-badge">Volver al Inicio</a>
    </div>
</div>
</body>
</html>
