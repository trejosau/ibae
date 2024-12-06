@extends('layouts.app')


@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Mis Citas</h2>

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
        <div class="row">
            @foreach ($citas as $cita)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Cita del {{ $cita->fecha_hora_inicio_cita->format('d/m/Y H:i') }}</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Estilista: {{ $cita->estilista->nombre ?? 'No asignado' }}</h6>
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

                            <h6 class="mt-3"><strong>Servicios:</strong></h6>
                            <ul class="list-unstyled">
                                @foreach ($cita->detalleCita as $detalle)
                                    <li>{{ $detalle->servicio->nombre ?? 'Sin servicio' }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
