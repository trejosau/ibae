<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis Citas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
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

        .table th, .table td {
            vertical-align: middle;
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 10px;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeeba;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding: 10px;
        }

        .pagination .page-link {
            border-radius: 20px;
            padding: 8px 16px;
            margin: 0 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #007bff;
            color: #fff;
        }

        .pagination .active .page-link {
            background-color: #007bff;
            color: #fff;
        }

        .table th {
            background-color: #f1f1f1;
            color: #495057;
        }

        .table td {
            background-color: #fff;
        }
    </style>
</head>

<body>
    @include('components.navbarSalon')

    <div class="container mt-5">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($citas->isEmpty())
            <div class="alert alert-warning text-center">
                <p><i class="bi bi-calendar-x"></i> No tienes citas registradas.</p>
            </div>
        @else
            <div style="padding-top: 100px">
                <div class="mb-3">
                    <a href="/salon" class="back-link">← Volver al Salón</a>
                </div>

                <div>
                    <h2 style="text-align: center; font-size:30px; margin:10px;">Mis citas</h2>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Fecha y Hora</th>
                            <th>Estilista</th>
                            <th>Estado de la Cita</th>
                            <th>Estado del Pago</th>
                            <th>Total</th>
                            <th>Anticipo</th>
                            <th>Pago Restante</th>
                            <th>Servicios</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($citas as $cita)
                            <tr>
                                <td>{{ $cita->fecha_hora_inicio_cita->format('d/m/Y H:i') }}</td>
                                <td>{{ $cita->estilista?->persona?->nombre ?? 'No asignado' }}</td>
                                <td>
                                    <span class="badge 
                                        @if($cita->estado_cita === 'programada') bg-primary 
                                        @elseif($cita->estado_cita === 'cancelada') bg-danger 
                                        @elseif($cita->estado_cita === 'completada') bg-success 
                                        @else bg-warning 
                                        @endif">
                                        {{ ucfirst($cita->estado_cita) }}
                                    </span>
                                </td>
                                <td>{{ ucfirst($cita->estado_pago) }}</td>
                                <td>${{ number_format($cita->total, 2) }}</td>
                                <td>${{ number_format($cita->anticipo, 2) }}</td>
                                <td>${{ number_format($cita->pago_restante, 2) }}</td>
                                <td>
                                    <ul class="list-unstyled">
                                        @forelse ($cita->detalleCita as $detalle)
                                            <li>{{ $detalle->servicio->nombre ?? 'Sin servicio' }}</li>
                                        @empty
                                            <li>No hay servicios asociados.</li>
                                        @endforelse
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-4">
                    {{ $citas->links('pagination::bootstrap-4') }}
                </div>

            </div>
        @endif
    </div>

    @include('components.footer')
</body>
</html>
