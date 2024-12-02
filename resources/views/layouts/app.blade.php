<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IBA&E')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Paleta de colores */
        :root {
            --color-fondo: #F8F9FA; /* Gris claro para fondo principal */
            --color-primario: #0D1E4C; /* Azul oscuro */
            --color-secundario: #83A6CE; /* Azul claro */
            --color-acento: #C48CB3; /* Rosa oscuro */
            --color-texto: #26415E; /* Azul medio */
            --color-footer: #0B1B32; /* Azul noche */
        }

        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: var(--color-fondo);
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
            background-color: var(--color-primario);
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
            color: var(--color-texto);
            font-family: 'Roboto', sans-serif;
            padding: 20px;
        }

        .map-title {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: bold;
            color: var(--color-primario);
        }

        .map-description {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: var(--color-secundario);
        }

        /* --- Contenedor del mapa con animación de entrada --- */
        .map-container {
            position: relative;
            padding-bottom: 56.25%; /* Relación de aspecto 16:9 */
            height: 0;
            max-width: 100%;
            margin: 0 auto 20px;
            border: 2px solid var(--color-secundario);
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
            background-color: var(--color-acento);
            border: none;
            padding: 12px 24px;
            font-size: 1.2rem;
            border-radius: 5px;
            transition: background-color 0.3s;
            color: white;
            text-decoration: none;
        }

        .map-button:hover {
            background-color: var(--color-secundario);
        }

        /* --- NAVBAR STYLES --- */
        .navbar {
            background: linear-gradient(90deg, var(--color-primario), var(--color-acento));
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
            background: linear-gradient(90deg, var(--color-primario), var(--color-acento));
        }

        .navbar-nav {
            display: flex;
            align-items: center;
        }

        .nav-item a {
            padding: 5px 1rem;
            margin: 0 -0.25rem;
            font-size: 27px;
            border: none;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            background-image: linear-gradient(
                to right,
                var(--color-acento),
                var(--color-acento) 50%,
                var(--color-fondo) 50%
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
            border-bottom: 3px solid var(--color-acento);
        }

        .nav-item .icono {
            color: var(--color-fondo);
            margin-right: 20px;
        }

        .login-button {
            background-color: var(--color-primario); /* Azul oscuro */
            color: var(--color-fondo); /* Blanco */
            padding: 10px 20px; /* Tamaño del botón */
            border: 2px solid var(--color-primario); /* Borde definido */
            border-radius: 5px; /* Esquinas redondeadas */
            font-size: 16px; /* Tamaño del texto */
            cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
            transition: all 0.3s ease; /* Transición suave para cambios */
        }

        .login-button:hover {
            background-color: var(--color-acento); /* Rosa oscuro */
            color: var(--color-texto); /* Azul medio */
            border-color: var(--color-acento); /* Cambia el color del borde */
            transform: scale(1.05); /* Pequeño efecto de zoom */
        }

        .login-button:active {
            background-color: var(--color-secundario); /* Azul claro */
            border-color: var(--color-secundario); /* Cambia el borde */
            transform: scale(0.95); /* Efecto de clic */
        }

        .login-button:disabled {
            background-color: var(--color-footer); /* Azul noche */
            color: var(--color-fondo); /* Blanco */
            border-color: var(--color-footer); /* Misma tonalidad */
            cursor: not-allowed; /* Cursor de no permitido */
            opacity: 0.6; /* Menor opacidad */
        }
        </style>
</head>
<body>
@stack('styles')
@include('components.navbar')

<main class="container">
    @yield('content')

</main>

@if(!request()->routeIs('dashboardd'))
@include('components.footer')
    @endif
</body>

@stack('scripts')
</html>
