<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Cancelada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            font-family: Arial, sans-serif;
        }

        .error-container {
            text-align: center;
            margin-top: 10%;
        }

        .btn-primary-custom {
            background-color: var(--color-primario);
            color: #fff;
            border: none;
        }

        .btn-primary-custom:hover {
            background-color: var(--color-secundario);
            color: #fff;
        }

        .header-text {
            color: var(--color-acento);
        }
    </style>
</head>
<body>
    <div class="container error-container">
        <h1 class="header-text">Compra Cancelada</h1>
        <p>Lo sentimos, tu compra fue cancelada. Si necesitas ayuda, contáctanos.</p>
        <a href="/tienda" class="btn btn-primary-custom">Regresar a la Tienda</a>
    </div>
</body>
</html>
