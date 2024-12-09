<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>


<body>
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
    
        body {
            background-color: var(--color-fondo);
            color: var(--color-texto);
        }
    
        .titulo-grande {
            color: var(--color-primario);
        }
    
        .precio {
            color: var(--color-acento);
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
    
        /* Botón "Agregar al carrito" */
        .btn-agg {
            background-color: var(--color-primario);
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: auto;
        }
    
        .btn-agg:hover {
            background-color: var(--color-acento);
        }
    
        /* Contenedor de productos */
        .productos-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding: 20px 0;
        }
    
        .productos-wrapper {
            display: flex;
            transition: transform 0.5s ease;
        }
    
        .producto-card {
            min-width: 220px;
            margin: 0 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
    
        .card {
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid var(--color-secundario);
            background-color: #fff;
        }
    
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
    
        .card-title {
            height: 2.5rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            color: var(--color-texto);
        }
    
        .agotado-banner {
            position: absolute;
            top: 10px;
            left: -35px;
            width: 200px;
            height: 50px;
            background: rgba(255, 0, 0, 0.8);
            color: white;
            font-size: 16px;
            text-align: center;
            line-height: 50px;
            transform: rotate(-45deg);
            transform-origin: left top;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    
        /* Barra de búsqueda */
        .search-bar-container {
            display: flex;
            width: 100%;
            background-color: #fff;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 5px;
            transition: box-shadow 0.3s ease;
        }
    
        .search-bar {
            border: none;
            border-radius: 50px;
            padding: 12px 20px;
            width: 100%;
            font-size: 16px;
            background-color: var(--color-fondo);
            transition: all 0.3s ease;
        }
    
        .search-bar:focus {
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }
    
        .search-bar-container:hover {
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }
    
        /* Enlace de retroceso */
        .back-link {
            color: var(--color-primario);
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            transition: color 0.3s ease, transform 0.3s ease;
        }
    
        .back-link:hover {
            color: var(--color-secundario);
            text-decoration: underline;
            transform: translateX(-5px);
        }
    </style>
    
    @include('components.navbarTienda')

    <main class="main" style="margin-top: 92px;">
        @livewire('catalogo-tienda')
    </main>

    @include('components.footer')
    
    @livewireScripts
</body>

</html>
