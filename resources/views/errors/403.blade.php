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
            background-image: url('https://get.wallhere.com/photo/reflection-sky-vehicle-cartoon-Steven-Universe-landmark-screenshot-computer-wallpaper-atmosphere-of-earth-80676.png');
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
            background-color: rgba(255, 255, 255, 0.9); /* Azul casi negro */
            color: #000000;
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

    <div class="row">
        <div class="col-12">
            <div class="card border-danger h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title">Error 403</h5>
                    <p class="card-text h2">No tienes permisos para acceder a esta página.</p>
                </div>
            </div>
        </div>
	</div>
    <div class="animation-container">
        <dotlottie-player src="https://lottie.host/90989bdd-ae79-4fc2-b230-c5a530228dd1/wyf5FOCTuC.json"
        background="transparent"
        speed="1"
        style="width: 300px; height: 300px"
        direction="1"
        playMode="normal"
        loop autoplay>
    </dotlottie-player>

        <!-- Botón "Volver al Inicio" sobresaliendo de la animación -->
        <a href="{{ url('/') }}" class="back-badge">Volver al Inicio</a>
    </div>
</div>
</body>
</html>


<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
