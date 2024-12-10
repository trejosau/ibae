<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Agenda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>

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

        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .badge {
            font-size: 0.85rem;
        }
        .alert i {
            font-size: 1.5rem;
        }
        footer {
            margin-top: 20px;
            padding: 20px;
            background-color: #343a40;
            color: white;
            text-align: center;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    @include('components.navbarSalon')
    <div class="container my-5" style="padding-top: 120px">
        <div class="mb-3">
            <a href="/salon" class="back-link">← Volver a la Salon</a>
        </div>
        <h1 class="text-center mb-4"><i class="bi bi-calendar3"></i> Mi Agenda</h1>

        @if($citas->isEmpty())
            <div class="alert alert-warning text-center">
                <p><i class="bi bi-calendar-x"></i> No tienes citas asignadas.</p>
            </div>
        @else
            <div class="table-responsive shadow-sm">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-dark">
                        <tr style="text-align: center">
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Cliente</th>
                            <th>Servicios</th>
                            <th>Estado de la Cita</th>
                            <th>Estado del Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center">
                        @foreach($citas as $cita)
                            <tr>
                                <td>
                                    <strong>Inicio:</strong>{{ \Carbon\Carbon::parse($cita->fecha_hora_inicio_cita)->format('Y-m-d') }}
                                    </strong><td>{{ \Carbon\Carbon::parse($cita->fecha_hora_inicio_cita)->format('H:i:s') }}</td>

                                </td>
                                <td>
                                    <strong>Nombre:</strong> {{ $cita->comprador->persona->users->username ?? 'Sin registrar' }}<br>
                                    <strong>Contacto:</strong> {{ $cita->comprador->persona->telefono ?? 'N/A' }}
                                </td>
                                <td>
                                    @foreach($cita->detalleCita as $detalle)
                                        <span class="badge bg-primary" style="margin:5px">{{ $detalle->servicio->nombre }}</span><br>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge" style="
                                    @if($cita->estado_cita == 'programada')
                                        background-color: blue; color: white;
                                    @elseif($cita->estado_cita == 'reprogramada')
                                        background-color: orange; color: white;
                                    @elseif($cita->estado_cita == 'cancelada')
                                        background-color: red; color: white;
                                    @elseif($cita->estado_cita == 'completada')
                                        background-color: green; color: white;
                                    @else
                                        background-color: gray; color: white;
                                    @endif">
                                    {{ ucfirst($cita->estado_cita) }}
                                </span>

                                </td>
                                <td>{{ $cita->estado_pago }}</td>
                                <td>
                                    <!-- Botón Ver Detalle -->
                                    <button
                                        class="btn btn-info btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-ver-detalle-{{ $cita->id }}">
                                        Ver Detalle
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
<!-- Paginación -->
<div class="d-flex justify-content-center mt-4">
    {{ $citas->links('pagination::bootstrap-4') }}
</div>

    @foreach ($citas as $cita)
    <div class="modal fade" id="modal-ver-detalle-{{ $cita->id }}" tabindex="-1" aria-labelledby="modalVerDetalleLabel-{{ $cita->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalVerDetalleLabel-{{ $cita->id }}">
                        Detalle de la Cita
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Información de Pago -->
                    <div class="mb-4 p-3 bg-light rounded border">
                        <h6 class="fw-bold text-primary">Información de Pago</h6>
                        <div class="row">
                            <div class="col-4">
                                <p><strong>Total:</strong> ${{ number_format($cita->total ?? 0, 2) }}</p>
                            </div>
                            <div class="col-4">
                                <p><strong>Anticipo:</strong> ${{ number_format($cita->anticipo ?? 0, 2) }}</p>
                            </div>
                            <div class="col-4">
                                <p><strong>Pago Restante:</strong> ${{ number_format($cita->pago_restante ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Servicios -->
                    <h6 class="fw-bold text-primary mb-3">Servicios</h6>
                    <div class="row">
                        @php $totalServicios = 0; @endphp
                        @foreach ($cita->detalleCita as $detalle)
                            @php
                                $servicio = $detalle->servicio;
                                $totalServicios += $servicio->precio ?? 0;
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <div class="card mb-4 border-0 shadow">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary fw-bold">{{ $servicio->nombre }}</h5>
                                        <p class="card-text text-muted small">{{ $servicio->descripcion }}</p>
                                        <p class="card-text fw-bold text-success">Precio: ${{ number_format($servicio->precio, 2) }}</p>
                                    </div>
                                    <div class="card-footer bg-light">
                                        <small class="text-muted">Duración: {{ $servicio->duracion_minima }} - {{ $servicio->duracion_maxima }} mins</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <div class="w-100 text-end">
                        <h5 class="fw-bold text-primary">
                            Total de Servicios: <span class="text-success">${{ number_format($totalServicios, 2) }}</span>
                        </h5>
                    </div>
                    @if($cita->estado_pago == 'anticipo')
                    <form action="{{ route('citas.concluirPago', $cita->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Concluir Pago</button>
                    </form>
                    @endif
                    @if($cita->estado_cita != 'completada')
                    <form action="{{ route('citas.completar', $cita->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">
                            Completar Cita
                        </button>
                    </form>
                    @endif
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach



    @foreach($citas as $cita)

    <div class="modal fade" id="modal-reprogramar-{{ $cita->id }}" tabindex="-1" aria-labelledby="reprogramarModalLabel-{{ $cita->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reprogramarModalLabel-{{ $cita->id }}">Reprogramar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('citas.reprogramar', $cita->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Usa PUT para actualizar -->
                        <div class="mb-3">
                            <label for="fecha-{{ $cita->id }}" class="form-label">Nueva Fecha</label>
                            <input type="date" id="fecha-{{ $cita->id }}" name="fecha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora-{{ $cita->id }}" class="form-label">Nueva Hora</label>
                            <input type="time" id="hora-{{ $cita->id }}" name="hora" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    @endforeach

    @include('components.footer')
</body>
</html>
