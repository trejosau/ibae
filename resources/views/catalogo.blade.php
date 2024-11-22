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
    
.precio {
    color: #ff5722;
    font-size: 1.2rem;
    margin-bottom: 1rem; /* Espacio debajo del precio */
}

/* Estilo para el botón "Agregar al carrito" */
.btn-agg {
    background-color: #333; /* Color de fondo */
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
    width: 100%; /* Botón ancho */
    margin-top: auto; /* Empuja el botón a la parte inferior del contenedor */
}

.btn-agg:hover {
    background-color: #f0c4d0; /* Color de fondo en hover */
}

/* Ajuste adicional para el contenedor de productos */
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

.card-title {
    height: 2.5rem; /* Fija la altura del título */
    overflow: hidden; /* Oculta el contenido que sobrepasa la altura */
    text-overflow: ellipsis; /* Agrega puntos suspensivos al texto largo */
    white-space: nowrap; /* Evita que el texto haga salto de línea */
    font-size: 1rem; /* Ajusta el tamaño de la fuente */
    margin-bottom: 0.5rem; /* Asegura espacio entre elementos */
}


.producto-card {
    min-width: 220px;
    margin: 0 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%; /* Asegura que el contenido esté alineado correctamente */
}

.card {
    text-decoration: none; /* Evita subrayado en el enlace */
    transition: transform 0.3s, box-shadow 0.3s; /* Transiciones para el hover */
}

.card:hover {
    transform: scale(1.05); /* Aumenta el tamaño en hover */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Sombra en hover */
}


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
        background-color: #f8f9fa;
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

    .back-link {
        color: #333;
        text-decoration: none;
        font-weight: bold;
        font-size: 1.1rem;
        display: inline-flex;
        align-items: center;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .back-link:hover {
        color: #555; /* Color más claro al pasar el mouse */
        text-decoration: underline;
        transform: translateX(-5px); /* Movimiento sutil hacia la izquierda */
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
