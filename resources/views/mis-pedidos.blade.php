<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">Tienda</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/productos">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/pedidos">Mis Pedidos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenido principal -->
<div class="container my-5">
    <h1 class="mb-4">Mis Pedidos</h1>

    <!-- Iterar sobre los pedidos -->
    @forelse ($pedidos as $pedido)
        <div class="card mb-4 shadow-sm border-0" style="background-color: #F9F7F6; border-radius: 10px;">
            <div class="card-header" style="background-color: #9AD1D4; color: #ffffff; border-radius: 10px 10px 0 0;">
                <h3 class="mb-0">Pedido #{{ $pedido->id }}</h3>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Total:</strong> ${{ number_format($pedido->total, 2) }}
                    </li>
                    <li class="list-group-item">
                        <strong>Estado:</strong> {{ ucfirst($pedido->estado) }}
                    </li>
                    <li class="list-group-item">
                        <strong>Clave de Entrega:</strong> {{ $pedido->clave_entrega }}
                    </li>
                    <li class="list-group-item">
                        <strong>Fecha de Pedido:</strong> {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y H:i') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Estado de Pago:</strong>
                        <span class="badge" style="background-color: {{ $pedido->estado_pago == 'completado' ? '#81C784' : '#FFB74D' }}; color: #ffffff;">
                                {{ $pedido->estado_pago == 'completado' ? 'Pagado' : 'Pendiente' }}
                            </span>
                    </li>
                </ul>
            </div>

            <!-- Productos del pedido -->
            <div class="card-body">
                <h5 class="card-title">Productos</h5>
                <ul class="list-group list-group-flush">
                    @foreach ($pedido->detalles as $detalle)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Producto:</strong> {{ $detalle->producto->nombre ?? 'Producto no encontrado' }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Cantidad:</strong> {{ $detalle->cantidad }}
                                </div>
                                <div class="col-md-3 text-end">
                                    <strong>Precio:</strong> ${{ number_format($detalle->precio_aplicado, 2) }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center">
            No tienes pedidos registrados.
        </div>
    @endforelse
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
