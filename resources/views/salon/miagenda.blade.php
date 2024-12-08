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
        <h1 class="text-center mb-4"><i class="bi bi-calendar3"></i> Mi Agenda</h1>
    
        @if($citas->isEmpty())
            <div class="alert alert-warning text-center">
                <p><i class="bi bi-calendar-x"></i> No tienes citas asignadas.</p>
            </div>
        @else
            <div class="table-responsive shadow-sm">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th>Fecha y Hora</th>
                            <th>Cliente</th>
                            <th>Servicios</th>
                            <th>Estado de la Cita</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($citas as $cita)
                            <tr>
                                <td>
                                    <strong>Inicio:</strong> {{ \Carbon\Carbon::parse($cita->fecha_hora_inicio_cita)->format('d/m/Y h:i A') }}<br>
                                    <strong>Fin:</strong> {{ \Carbon\Carbon::parse($cita->fecha_hora_fin_cita)->format('d/m/Y h:i A') }}
                                </td>
                                <td>
                                    <strong>Nombre:</strong> {{ $cita->comprador->persona->nombre ?? 'Sin registrar' }}<br>
                                    <strong>Contacto:</strong> {{ $cita->comprador->persona->telefono ?? 'N/A' }}
                                </td>
                                <td>
                                    @foreach($cita->detalleCita as $detalle)
                                        <span class="badge bg-primary">{{ $detalle->servicio->nombre }}</span><br>
                                    @endforeach
                                </td>
                                <td>
                                    @php
                                        $estadoClass = match($cita->estado_cita) {
                                            'programada' => 'bg-info text-dark',
                                            'reprogramada' => 'bg-warning text-dark',
                                            'cancelada' => 'bg-danger',
                                            'completada' => 'bg-success',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $estadoClass }}">{{ ucfirst($cita->estado_cita) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    @include('components.footer')
</body>
</html>
