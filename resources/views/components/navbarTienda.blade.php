<style>
    /* Estilos de la barra de navegación */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background-color: rgb(255, 105, 135);
        padding: 10px 20px;
    }

    .navegacion {
        position: fixed;
        top: 60px; /* Ajusta según la altura del navbar */
        left: 0;
        right: 0;
        z-index: 999;
        text-align: center;
        padding: 20px 0;
        display: flex;
        justify-content: center;
        gap: 30px;
        font-family: 'Arial', sans-serif;
        font-size: 16px;
        background-color: #fff;
    }

    .navegacion a {
        color: #333;
        text-decoration: none;
        font-weight: bold;
        padding: 10px;
        position: relative;
        transition: color 0.3s ease;
    }

    .navegacion a:hover {
        color: #e63946;
    }

    .navegacion-item {
        position: relative;
    }

    /* Estilos del mega menú */
    .mega-menu {
        display: none;
        position: absolute;
        background-color: #f9f9f9; /* Fondo claro del mega menú */
        padding: 10px; /* Ajustar padding para el contenido */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 8px;
        width: auto; /* Auto width based on content */
        white-space: nowrap; /* Evita el wrap del texto */
        overflow: visible; /* Evita scroll en el dropdown */
    }

    .mega-menu .container-fluid {
        display: flex;
        flex-wrap: nowrap; /* Mantiene las columnas en una línea */
        justify-content: space-between; /* Asegura un espaciado adecuado */
    }

    /* Estilos de las columnas */
    .mega-menu .col-md-4,
    .mega-menu .col-md-3,
    .mega-menu .col-md-2,
    .mega-menu .col-md-5 {
        flex: 1; /* Las columnas ocuparán espacio igual */
        box-sizing: border-box;
        padding: 10px; /* Espaciado interno para las columnas */
        margin-right: 10px; /* Margen derecho entre columnas */
        border-right: 1px dashed #ccc; /* Borde sutil entre columnas */
        min-width: 180px; /* Aumenta el ancho mínimo de las columnas */
        max-width: 250px; /* Ajusta según sea necesario */
        overflow: hidden; /* Evita que el contenido sobresalga */
        text-overflow: ellipsis; /* Muestra '...' si el texto es demasiado largo */
        white-space: normal; /* Permitir que el texto haga wrap */
        background-color: #ffeef8; /* Color de fondo rosa pastel para las columnas */
    }

    /* Elimina el borde derecho de la última columna */
    .mega-menu .col-md-4:last-child,
    .mega-menu .col-md-3:last-child,
    .mega-menu .col-md-2:last-child,
    .mega-menu .col-md-5:last-child {
        border-right: none; /* Sin borde en la última columna */
        margin-right: 0; /* Sin margen en la última columna */
    }

    /* Estilos de encabezados y enlaces de subcategorías */
    .mega-menu h3 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 18px;
        background-color: #f0c4d0; /* Color de fondo pastel para los encabezados */
        padding: 5px;
        border-radius: 4px; /* Bordes redondeados para los encabezados */
        color: #333; /* Color del texto */
    }

    .mega-menu a {
        display: block;
        margin-bottom: 5px;
        padding: 5px;
        color: #555; /* Color del texto de los enlaces */
        transition: background-color 0.3s ease;
        border-radius: 3px; /* Bordes redondeados para enlaces */
        position: relative; /* Para permitir el uso de pseudo-elementos */
    }

    .mega-menu a:before {
        content: "•"; /* Punto antes de cada enlace */
        color: #e63946; /* Color del punto */
        margin-right: 5px; /* Espacio entre el punto y el texto */
    }

    .mega-menu a:hover {
        background-color: #f0e1e5; /* Color de fondo claro al pasar el ratón */
    }

    /* Mostrar el mega menú al pasar el ratón */
    .navegacion-item:hover .mega-menu {
        display: block;
    }

    /* Clearfix para el contenedor */
    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">TuLogo</a>
        <div class="form-inline">
            <input type="text" placeholder="Buscar productos...">
            <button type="button">Buscar</button>
        </div>
        <div class="nav-icons">
            <a href="#"><span>$0.00</span> <i class="fas fa-shopping-cart"></i></a>
        </div>
    </div>
</nav>

<nav class="navegacion">
    <div class="navegacion-item">
        <a href="#">Tintes</a>
        <div class="mega-menu clearfix">
            <div class="container-fluid">
                <div class="col-md-4">
                    <h3>TINTES</h3>
                    <a href="#">Tintes Permanentes</a>
                    <a href="#">Tintes Temporales</a>
                    <a href="#">Tintes Orgánicos</a>
                    <a href="#">Tintes Sin Amoniaco</a>
                </div>
                <div class="col-md-4">
                    <h3>Productos Relacionados</h3>
                    <a href="#">Shampoo para tintes</a>
                    <a href="#">Acondicionadores</a>
                    <a href="#">Tratamientos Post-Tinte</a>
                    <a href="#">Protección del Color</a>
                </div>
                <div class="col-md-4">
                    <h3>Accesorios</h3>
                    <a href="#">Accesorios para teñir</a>
                    <a href="#">Peróxido</a>
                    <a href="#">Decolorantes</a>
                    <a href="#">Pinceles y Bowls</a>
                </div>
            </div>
        </div>
    </div>

    <div class="navegacion-item">
        <a href="#">Cabello</a>
        <div class="mega-menu clearfix">
            <div class="container-fluid">
                <div class="col-md-3">
                    <h3>CABELLO</h3>
                    <a href="#">Shampoo y Acondicionador</a>
                    <a href="#">Tratamientos capilares</a>
                    <a href="#">Cuidado del cuero cabelludo</a>
                </div>
                <div class="col-md-3">
                    <h3>Estilo</h3>
                    <a href="#">Geles y ceras</a>
                    <a href="#">Lacas</a>
                    <a href="#">Pomadas</a>
                </div>
                <div class="col-md-3">
                    <h3>Secado</h3>
                    <a href="#">Secadoras de cabello</a>
                    <a href="#">Difusores</a>
                </div>
                <div class="col-md-3">
                    <h3>Accesorios</h3>
                    <a href="#">Planchas</a>
                    <a href="#">Rizadores</a>
                    <a href="#">Peines</a>
                </div>
            </div>
        </div>
    </div>

    <div class="navegacion-item">
        <a href="#">Barbería</a>
        <div class="mega-menu clearfix">
            <div class="container-fluid">
                <div class="col-md-4">
                    <h3>BARBERÍA</h3>
                    <a href="#">Cortes</a>
                    <a href="#">Rasuradoras</a>
                    <a href="#">Navajas</a>
                </div>
                <div class="col-md-4">
                    <h3>Cuidado</h3>
                    <a href="#">Cremas y lociones</a>
                    <a href="#">Aceites para barba</a>
                </div>
                <div class="col-md-4">
                    <h3>Accesorios</h3>
                    <a href="#">Peines y cepillos</a>
                    <a href="#">Tijeras</a>
                </div>
            </div>
        </div>
    </div>

    <div class="navegacion-item">
        <a href="#">Uñas</a>
        <div class="mega-menu clearfix">
            <div class="container-fluid">
                <div class="col-md-5">
                    <h3>UÑAS</h3>
                    <a href="#">Esmaltes</a>
                    <a href="#">Gel para uñas</a>
                    <a href="#">Tratamientos para uñas</a>
                </div>
                <div class="col-md-5">
                    <h3>HERRAMIENTAS</h3>
                    <a href="#">Pinceles</a>
                    <a href="#">Esponjas</a>
                    <a href="#">Limas</a>
                </div>
            </div>
        </div>
    </div>
</nav>
