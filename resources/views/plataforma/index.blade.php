<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plataforma</title>

    <!-- Estilos -->
    <style>
        ::after,
        ::before {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .wrapper {
            display: flex;
        }

        .main {
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
            background-color: #fafbfe;
        }

        #sidebar {
            width: 70px;
            min-width: 70px;
            min-height: 100vh;
            z-index: 1000;
            transition: all 0.25s ease-in-out;
            background-color: #000000; /* Fondo negro */
            display: flex;
            flex-direction: column;
        }

        #sidebar.expand {
            width: 260px;
            min-width: 260px;
        }

        .toggle-btn {
            background-color: transparent;
            cursor: pointer;
            border: 0;
            padding: 1rem 1.5rem;
        }

        .toggle-btn i {
            font-size: 1.5rem;
            color: #FFF;
        }

        .sidebar-logo {
            margin: auto 0;
        }

        .sidebar-logo a {
            color: #f556a3; /* Rosa */
            font-size: 1.15rem;
            font-weight: 600;
        }

        #sidebar:not(.expand) .sidebar-logo,
        #sidebar:not(.expand) a.sidebar-link span {
            display: none;
        }

        .sidebar-nav {
            padding-top: 0;
            flex: 1 1 auto;
        }

        a.sidebar-link {
            padding: 1rem 1.5rem;
            color: #FFF;
            display: block;
            font-size: 1.3rem;
            white-space: nowrap;
            border-left: 4px solid transparent;
        }

        .sidebar-link i {
            font-size: 1.15rem;
            margin-right: 0.75rem;
        }

        .sidebar-link.ir-inicio i {
            margin-right: 0;
            margin-top: 0.6rem;
        }

        a.sidebar-link:hover {
            background-color: rgba(255, 182, 193, 0.3); /* Hover rosa claro */
            border-left: 5px solid #f556a3; /* Borde izquierdo en rosa */
        }

        a.sidebar-link.ir-inicio {
            padding-bottom: 2rem;
        }

        .sidebar-item {
            position: relative;
        }

        #sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
            position: absolute;
            top: 0;
            left: 70px;
            background-color: #2c2c2c; /* Dropdown oscuro */
            padding: 0;
            min-width: 15rem;
            display: none;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        #sidebar:not(.expand) .sidebar-item:hover .has-dropdown + .sidebar-dropdown {
            display: block;
            max-height: 15em;
            width: 100%;
            opacity: 1;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
            border: solid;
            border-width: 0 0.075rem 0.075rem 0;
            content: "";
            display: inline-block;
            padding: 2px;
            position: absolute;
            right: 1.5rem;
            top: 1.4rem;
            transform: rotate(-135deg);
            transition: all 0.2s ease-out;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
            transform: rotate(45deg);
            transition: all 0.2s ease-out;
        }

        .sidebar-divider {
            width: 100%;
            height: 2px;
            background-color: #f556a3;
            margin: 1rem 0;
        }

        #fecha-hora {
            margin-top: 0.5rem;
            font-size: 1rem;
            color: #fff;
        }

        .usuario {
            margin-top: 0.5rem;
            font-size: 1.2rem;
            color: #fff;
        }

        .volver-home {
            font-size: 1.6rem;
            font-family: 'Poppins', sans-serif;
        }

        a.sidebar-link.ir-inicio:hover {
            color: #ff69b4; /* Hover en rosa fuerte */
            border-left: 5px solid #ff69b4; /* Borde izquierdo rosa fuerte */
        }
    </style>
</head>
<body>



    @include('components.sidebarPlataforma')

    <div class="main p-3 ">

        @switch(Route::currentRouteName())

            @default
                <p>No se encontró el contenido para esta ruta.</p>
        @endswitch
    </div>


</body>
</html>
