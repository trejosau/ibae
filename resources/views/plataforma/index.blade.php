<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
  
.botoncin-ca{
    margin-top: 10px;
}
    .titulo{
font-size: 30px
    }
.card-text{
    margin-top: 10px; 
}
.card {
    transition: transform 0.2s; /* Animación suave al hacer hover */
    border: 2px solid transparent
}



.card-body {
    background-color: #f9f9f9; /* Color de fondo más suave para el contenido de la tarjeta */
}

.card-title {
    font-weight: bold; /* Negrita para los títulos */
}

    .titulo {
        font-size: 3rem;
        font-weight: bold;
        color: var(--primary-color);
        padding-right: 500px;
    }
    :root {
        --primary-color: #ffb3c1; /* Rosa pastel */
        --sidebar-bg: #f6f8fc; /* Azul claro muy suave */
        --sidebar-text: #34495e; /* Gris oscuro elegante */
        --sidebar-hover: rgba(52, 73, 94, .1); /* Gris oscuro suave en hover */
        --sidebar-border: 5px solid var(--primary-color);
        --body-bg: #fafafc; /* Blanco con un toque grisáceo */
        --text-color: #2c3e50; /* Azul marino oscuro */
    }

    [data-theme="dark"] {
        --primary-color: #e57373; /* Rojo coral pastel */
        --sidebar-bg: #2c2c2c; /* Gris oscuro */
        --sidebar-text: #e0e0e0; /* Blanco humo */
        --sidebar-hover: rgba(224, 224, 224, .1); /* Blanco humo suave en hover */
        --sidebar-border: 5px solid var(--primary-color);
        --body-bg: #1c1c1c; /* Negro con un toque gris */
        --text-color: #dcdcdc; /* Gris claro */
    }

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
        background-color: var(--body-bg);
        color: var(--text-color);
        transition: background-color 0.3s, color 0.3s;
    }

    .wrapper {
        display: flex;
    }

    .main {
        min-height: 100vh;
        width: 100%;
        overflow: hidden;
        background-color: var(--body-bg);
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
        background-color: var(--sidebar-bg);
        position: fixed;
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
        transition: background-color 0.2s; /* Suave transición para hover */
    }

    .toggle-btn:hover {
        background-color: var(--sidebar-hover); /* Efecto hover */
    }

    .toggle-btn i {
        font-size: 1.5rem;
        color: var(--sidebar-text);
    }

    .sidebar-logo {
        margin: auto 0;
        text-align: center; /* Centrar el contenido */
    }

    .sidebar-logo a {
        color: var(--primary-color);
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
        display: flex; /* Cambiar a flex para alinear los elementos */
        justify-content: space-between; /* Espacio entre el texto y el ícono */
        align-items: center; /* Alinear verticalmente en el centro */
        padding: 1rem 1.5rem;
        color: var(--sidebar-text);
        font-size: 1.3rem;
        white-space: nowrap;
        border-top: 3px solid transparent;
        border-left: 3px solid transparent;
        transition: background-color 0.2s; /* Transición para el hover */
        gap: 10px; /* Espacio entre el texto y el icono */
    }

    a.sidebar-link:hover {
        background-color: var(--sidebar-hover);
    }

    .sidebar-item {
        position: relative;
    }

    #sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
        position: absolute;
        top: 0;
        left: 70px;
        background-color: var(--primary-color);
        min-width: 15rem;
        display: none;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Sombra para el dropdown */
    }

    #sidebar:not(.expand) .sidebar-item:hover .has-dropdown+.sidebar-dropdown {
        display: block;
        max-height: 15em;
        width: 100%;
        opacity: 1;

    }
    #sidebar:not(.expand) .sidebar-item:hover .sidebar-link {
        background-color: var(--primary-color);
    }
    #sidebar:not(.expand) .sidebar-item:hover .sidebar-link:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    .dropdown-icon {
        margin-left: auto; /* Alinear a la derecha */
        opacity: 0; /* Comienza como invisible */
        transform: rotate(0deg); /* Sin rotación inicial */
        transition: opacity 0.3s ease, transform 0.3s ease; /* Transición suave para opacidad y rotación */
    }

    /* Color del icono en modo claro */
    #sidebar:not([data-theme="dark"]) .dropdown-icon {
        color: var(--sidebar-text); /* Color del texto */
    }

    /* Color del icono en modo oscuro */
    [data-theme="dark"] #sidebar .dropdown-icon {
        color: var(--sidebar-text); /* Blanco humo para el modo oscuro */
    }

    #sidebar.expand .sidebar-link .dropdown-icon {
        opacity: 1; /* Muestra los iconos cuando el sidebar está expandido */
    }

    #sidebar.expand .sidebar-link.collapsed .dropdown-icon {
        transform: rotate(0deg); /* Flecha hacia abajo por defecto */
    }

    #sidebar.expand .sidebar-link:not(.collapsed) .dropdown-icon {
        transform: rotate(180deg); /* Gira la flecha hacia arriba cuando está expandido */
    }

    /* Oculta los iconos cuando la barra lateral no está expandida */
    #sidebar:not(.expand) .dropdown-icon {
        opacity: 0; /* Mantiene invisibles los iconos */
        pointer-events: none; /* Evita interacciones */
        transition: opacity 0.3s ease; /* Transición suave para opacidad */
    }

    .sidebar-divider {
        width: 100%;
        height: 2px;
        background-color: var(--primary-color);
        margin: 1rem 0;
    }

    #fecha-hora {
        margin-top: .5rem;
        font-size: 1rem;
        color: var(--sidebar-text);
    }

    .usuario {
        margin-top: .5rem;
        font-size: 1.2rem;
        color: var(--sidebar-text);
    }

    .volver-home {
        font-size: 1.6rem;
        font-family: 'Poppins', sans-serif;
    }

    /* Dark Mode Switch */
    .theme-switch {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 1rem 1.5rem;
        justify-content: center;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 24px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #4CAF50;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }

    .theme-label {
        font-size: 1rem;
        font-weight: 500;
        color: var(--text-color);
        transition: color 0.3s;
    }

    /* Ajustes para el sidebar cerrado */
    #sidebar:not(.expand) .theme-label {
        display: none; /* Oculta el texto cuando el sidebar está cerrado */
    }

    #sidebar:not(.expand) .theme-switch {
        padding: 0.5rem 0; /* Ajusta el espacio para el switch */
        justify-content: center;
    }

    #sidebar.expand .theme-switch {
        padding: 1rem 1.5rem; /* Ajusta el padding cuando el sidebar está expandido */
    }

</style>

<body>
<div class="wrapper">
    @include('components.sidebarPlataforma')
    <div class="main p-3">
        @include(Route::currentRouteName())
    </div>
</div>
</body>
<script>
    const themeToggle = document.getElementById('theme-toggle');
    themeToggle.addEventListener('change', function() {
        if (themeToggle.checked) {
            document.body.setAttribute('data-theme', 'dark');
        } else {
            document.body.removeAttribute('data-theme');
        }
    });


</script>
<script>
    const themeToggle = document.getElementById('theme-toggle');
    const sidebarLinks = document.querySelectorAll('.sidebar-link');

    themeToggle.addEventListener('change', function() {
        if (themeToggle.checked) {
            document.body.setAttribute('data-theme', 'dark');
        } else {
            document.body.removeAttribute('data-theme');
        }
    });

    // Cambia las flechas al expandir o colapsar el sidebar
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function() {
            const dropdownIcon = this.querySelector('.dropdown-icon');

            if (dropdownIcon) {
                const isCollapsed = this.classList.contains('collapsed');
                dropdownIcon.classList.toggle('fa-chevron-down', isCollapsed);
                dropdownIcon.classList.toggle('fa-chevron-up', !isCollapsed);
            }
        });
    });
</script>


</html>
