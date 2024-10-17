<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
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
        transition: all .25s ease-in-out;
        background-color: #081444;
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
        color: #f556a3;
        font-size: 1.15rem;
        font-weight: 600;
    }

    #sidebar:not(.expand) .sidebar-logo,
    #sidebar:not(.expand) a.sidebar-link span {
        display: none;
    }

    .sidebar-nav {
        padding-top: .5rem;
        flex: 1 1 auto;
    }

    a.sidebar-link {
        padding: .625rem 1.625rem;
        color: #FFF;
        display: block;
        font-size: 0.9rem;
        white-space: nowrap;
        border-left: 3px solid transparent;
    }

    .sidebar-link i {
        font-size: 1.1rem;
        margin-right: .75rem;
    }

    a.sidebar-link:hover {
        background-color: rgba(255, 255, 255, .075);
        border-left: 5px solid #91235a;
    }

    .sidebar-item {
        position: relative;
    }

    #sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
        position: absolute;
        top: 0;
        left: 70px;
        background-color: #d99db7;
        padding: 0;
        min-width: 15rem;
        display: none;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    #sidebar:not(.expand) .sidebar-item:hover .has-dropdown+.sidebar-dropdown {
        display: block;
        max-height: 15em;
        width: 100%;
        opacity: 1;
    }

    #sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
        border: solid;
        border-width: 0 .075rem .075rem 0;
        content: "";
        display: inline-block;
        padding: 2px;
        position: absolute;
        right: 1.5rem;
        top: 1.4rem;
        transform: rotate(-135deg);
        transition: all .2s ease-out;
    }

    #sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
        transform: rotate(45deg);
        transition: all .2s ease-out;
    }

    .sidebar-divider{
        width: 100%;
        height: 2px;
        background-color: #f556a3;
        margin: 1rem 0;
    }

    #fecha-hora {
        margin-top: .5rem;
        font-size: 1rem;
        color: #fff;
    }

    .usuario {
        margin-top: .5rem;
        font-size: 1.2rem;
        color: #fff;
    }


    </style>

<body>
@include('components.sidebar')
    <div class="main p-3 ">
        @switch(Route::currentRouteName())
            @case('dashboard.inicio')
                @include('dashboard.inicio')
                @break

            @case('dashboard.ventas')
                @include('dashboard.ventas')
                @break

            @case('dashboard.compras')
                @include('dashboard.compras')
                @break

            @case('dashboard.citas')
                @include('dashboard.citas')
                @break

            @case('dashboard.servicios')
                @include('dashboard.servicios')
                @break

            @case('dashboard.productos')
                @include('dashboard.productos')
                @break


            @default
                <p>No se encontró el contenido para esta ruta.</p>
        @endswitch
    </div>
</div>

</body>

</html>
