@php
    $notificaciones = [
        ['mensaje' => 'Nuevo mensaje de Juan Pérez', 'tiempo' => '5 min'],
        ['mensaje' => 'Tu cita ha sido confirmada', 'tiempo' => '10 min'],
        ['mensaje' => 'Recordatorio: Tu contraseña expira en 2 días', 'tiempo' => '2 horas'],
        ['mensaje' => 'Nueva actualización disponible', 'tiempo' => '1 día'],
        ['mensaje' => 'Tienes una reunión programada para mañana', 'tiempo' => '3 horas'],
        ['mensaje' => 'Nueva solicitud de amistad', 'tiempo' => '15 min'],
        ['mensaje' => 'Se ha publicado un nuevo comentario en tu publicación', 'tiempo' => '2 días'],
    ];
@endphp

<li>
    <h6 class="dropdown-header">Notificaciones</h6>
</li>

@foreach ($notificaciones as $index => $notificacion)
    @if ($index < 5) <!-- Mostrar solo las primeras 5 notificaciones -->
    <li>
        <a class="dropdown-item" href="#">
            <div class="d-flex justify-content-between">
                <span>{{ $notificacion['mensaje'] }}</span>
                <small class="text-muted">{{ $notificacion['tiempo'] }}</small>
            </div>
        </a>
    </li>
    @endif
@endforeach

<li>
    <div class="dropdown-divider"></div>
</li>
<li>
    <a class="dropdown-item text-center" href="#" id="verMasNotificaciones">Mostrar más</a>
</li>
<li>
    <div class="dropdown-divider"></div>
</li>
<li>
    <a class="dropdown-item" href="">Limpiar notificaciones</a>
</li>
<li>
    <a class="dropdown-item" href="{{ route('profile') }}">Historial de notificaciones</a>
</li>
