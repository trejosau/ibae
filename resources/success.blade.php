<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Exitosa</title>
    <style>
        /* Paleta de colores */
        :root {
            --color-fondo: #F8F9FA;
            --color-primario: #0D1E4C;
            --color-secundario: #83A6CE;
            --color-acento: #C48CB3;
            --color-texto: #26415E;
            --color-footer: #0B1B32;
        }

        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: var(--color-fondo);
            color: var(--color-texto);
        }

        header {
            padding: 10px 20px;
            background-color: var(--color-primario);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: 1.2em;
        }

        .container {
            margin: 20px;
            padding: 20px;
            border: 1px solid var(--color-secundario);
            border-radius: 10px;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            color: var(--color-primario);
        }

        .productos {
            margin: 20px 0;
        }

        .producto {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid var(--color-secundario);
            border-radius: 5px;
        }

        .boton {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: var(--color-acento);
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            text-align: center;
        }

        .boton:hover {
            background-color: #a5648a;
        }
    </style>
</head>
<body>
    <header>
        <a href="/tienda">Regresar a la tienda</a>
    </header>
    <div class="container">
        <h1>¡Gracias por tu compra!</h1>
        <p>Estos son los productos que compraste:</p>
        <div class="productos">
            @foreach(session()->get('carrito', []) as $producto)
            <div class="producto">
                <span>{{ $producto['nombre'] }}</span>
                <span>{{ $producto['cantidad'] }} x ${{ $producto['precio'] }}</span>
            </div>
            @endforeach
        </div>
        <a href="/mis-pedidos" class="boton">Ir a mis pedidos</a>
    </div>
</body>
</html>
