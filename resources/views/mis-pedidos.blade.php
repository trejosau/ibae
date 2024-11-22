<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
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

        body {
            background-color: var(--color-fondo);
            font-family: 'Arial', sans-serif;
            color: var(--color-texto);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: linear-gradient(90deg, var(--color-primario), var(--color-acento));
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            margin-left: 15px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: var(--color-primario);
        }

        .pedido-card {
            background: white;
            border: 1px solid #ECECEC;
            border-radius: 15px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .pedido-header {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--color-primario);
            margin-bottom: 10px;
        }

        .pedido-status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .pedido-status.pagado {
            background: linear-gradient(90deg, var(--color-secundario), var(--color-acento));
            color: white;
        }

        .pedido-status.pendiente {
            background-color: var(--color-footer);
            color: white;
        }

        .productos-grid {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .producto-card {
            background: var(--color-fondo);
            border: 1px solid var(--color-acento);
            border-radius: 10px;
            text-align: center;
            padding: 10px;
            flex: 1 1 calc(33.333% - 15px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .producto-card img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .btn-detalle-pedido {
            background-color: var(--color-primario);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-detalle-pedido:hover {
            background-color: var(--color-secundario);
        }

        .alert {
            background: var(--color-footer);
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-size: 1rem;
        }

        footer {
            background: linear-gradient(90deg, var(--color-footer), var(--color-primario));
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar">
    <div class="container">
        <a href="/" class="navbar-brand">IBA&E</a>
        <div>
            <a href="/">Inicio</a>
            <a href="{{ route('tienda.mostrar') }}">Tienda</a>
        </div>
    </div>
</nav>

<!-- Contenido principal -->
<div class="container">
    <h1>Mis Pedidos</h1>

    <!-- Iterar sobre los pedidos -->
    @forelse ($pedidos as $pedido)
        <div class="pedido-card">
            <div class="pedido-header">
                Pedido #{{ $pedido->id }}
                <span class="pedido-status {{ $pedido->estado_pago == 'completado' ? 'pagado' : 'pendiente' }}">
                        {{ $pedido->estado_pago == 'completado' ? 'Pagado' : 'Pendiente' }}
                    </span>
            </div>
            <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($pedido['fecha-hora_pedido'])->format('d/m/Y H:i') }}</p>

            <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
            @if ($pedido->estado == 'listo para entrega')
                <p><strong>Puedes pasar a recoger el pedido:</strong> Clave: {{ $pedido->clave_entrega }}</p>
            @endif
            <hr>
            <div class="productos-grid">
                @foreach ($pedido->detalles as $detalle)
                    <div class="producto-card">
                        <img src="{{ $detalle->producto->main_photo }}" alt="{{ $detalle->producto->nombre }}">
                        <p>{{ $detalle->producto->nombre }}</p>
                        <p>Cantidad: {{ $detalle->cantidad }}</p>
                        <p>Precio: ${{ number_format($detalle->precio_aplicado, 2) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="alert">
            No tienes pedidos registrados.
        </div>
    @endforelse
</div>

<!-- Footer -->
<footer>
    © 2024 IBA&E
</footer>
</body>
</html>
