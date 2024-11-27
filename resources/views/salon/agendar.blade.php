<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Resumen de la Cita</title>
    <style>
        .logo {
            width: auto;
            height: 64px;
        }

        header {
            background-color: #ccf3dc;
        }

        .main-content {
            padding: 20px;
        }


        .service-card.selected {
            background-color: #d6e7ff !important; /* Fondo pastel completo */
            border: 1px solid #80b3ff; /* Borde suave en azul pastel */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Agregar una sombra ligera para resaltar */
        }

        .service-card.selected:hover {
            background-color: #c5d9ff !important; /* Fondo más suave al pasar el ratón */
        }

    </style>
</head>
<body>

<header class="py-2">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <img src="{{asset('images/logo-salon.jpg')}}" alt="Rosy Saucedo Salon" class="img-fluid w-100 h-100 object-fit-cover">
        </div>
        <div class="d-flex">
            <a href="/salon" class="btn btn-outline-primary me-2 d-flex align-items-center">
                <i class="fa fa-chevron-circle-left me-2"></i>
                Volver
            </a>
        </div>


    </div>
</header>

<main class="main-content">
    <livewire:servicios-disponibles />
</main>

</body>
</html>
