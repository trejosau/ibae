<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* General card styling */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-height: 450px; /* Altura mínima */
            max-height: 600px; /* Altura máxima */
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Distribuye contenido */
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 2px solid #eaeaea;
            padding: 15px;
        }

        .card-title {
            font-size: 1.25rem;
            color: #cd678b;
        }

        .card-body {
            padding: 20px;
            line-height: 1.6; /* Espaciado entre líneas */
        }

        .card-subtitle {
            font-size: 1rem;
            color: #6c757d;
        }

        .badge {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 10px;
        }

        /* Styling for services list */
        ul.list-unstyled {
            margin-top: 15px;
            padding-left: 1rem;
            line-height: 1.8; /* Espaciado entre líneas */
        }

        ul.list-unstyled li {
            margin-bottom: 8px;
        }

        ul .d-none {
            display: none;
        }

        /* Layout adjustments */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Espaciado entre tarjetas */
        }
    </style>
</head>
<body>
    @include('components.navbarSalon')

    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    
        @if ($citas->isEmpty())
            <div class="alert alert-info">
                No tienes citas registradas.
            </div>
        @else
            <div class="row" style="padding-top: 120px">
                @foreach ($citas as $cita)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    Cita del {{ $cita->fecha_hora_inicio_cita->format('d/m/Y H:i') }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Información del estilista -->
                                <p>
                                    <strong>Estilista:</strong> {{ $cita->estilista?->persona?->nombre ?? 'No asignado' }}
                                </p>
    
                                <!-- Información de la cita -->
                                <p class="card-text">
                                    <strong>Estado de la cita:</strong>
                                    <span class="badge 
                                        @if($cita->estado_cita === 'programada') bg-success 
                                        @elseif($cita->estado_cita === 'cancelada') bg-danger 
                                        @else bg-warning 
                                        @endif">
                                        {{ ucfirst($cita->estado_cita) }}
                                    </span>
                                </p>
                                <p class="card-text">
                                    <strong>Estado del pago:</strong> {{ ucfirst($cita->estado_pago) }}
                                </p>
                                <p class="card-text">
                                    <strong>Total:</strong> ${{ number_format($cita->total, 2) }}
                                </p>
                                <p class="card-text">
                                    <strong>Anticipo:</strong> ${{ number_format($cita->anticipo, 2) }}
                                </p>
                                <p class="card-text">
                                    <strong>Pago Restante:</strong> ${{ number_format($cita->pago_restante, 2) }}
                                </p>
    
                                <!-- Servicios asociados -->
                                <h6 class="mt-3"><strong>Servicios:</strong></h6>
                                <ul class="list-unstyled">
                                    @forelse ($cita->detalleCita as $detalle)
                                        <li>{{ $detalle->servicio->nombre ?? 'Sin servicio' }}</li>
                                    @empty
                                        <li>No hay servicios asociados.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    

    @include('components.footer')


</body>
</html>
