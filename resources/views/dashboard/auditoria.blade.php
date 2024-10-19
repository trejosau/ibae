@php
    // Simulación de cambios recientes para la auditoría
    $cambiosRecientes = [
        ['fecha' => '2024-10-15', 'usuario' => 'Juan Pérez', 'accion' => 'Modificar', 'detalles' => 'Cambió el estado de usuario a inactivo.'],
        ['fecha' => '2024-10-14', 'usuario' => 'María López', 'accion' => 'Agregar', 'detalles' => 'Agregó un nuevo servicio: Manicura.'],
        ['fecha' => '2024-10-13', 'usuario' => 'Carlos García', 'accion' => 'Eliminar', 'detalles' => 'Eliminó el usuario: Pedro Martínez.'],
        ['fecha' => '2024-10-12', 'usuario' => 'Juan Pérez', 'accion' => 'Modificar', 'detalles' => 'Cambió el estado de usuario a inactivo.'],
        ['fecha' => '2024-10-11', 'usuario' => 'María López', 'accion' => 'Agregar', 'detalles' => 'Agregó un nuevo servicio: Manicura.'],
        ['fecha' => '2024-10-10', 'usuario' => 'Carlos García', 'accion' => 'Eliminar', 'detalles' => 'Eliminó el usuario: Pedro Martínez.'],
        ['fecha' => '2024-10-09', 'usuario' => 'Juan Pérez', 'accion' => 'Modificar', 'detalles' => 'Cambió el estado de usuario a inactivo.'],
        ['fecha' => '2024-10-08', 'usuario' => 'María López', 'accion' => 'Agregar', 'detalles' => 'Agregó un nuevo servicio: Manicura.'],
        ['fecha' => '2024-10-07', 'usuario' => 'Carlos García', 'accion' => 'Eliminar', 'detalles' => 'Eliminó el usuario: Pedro Martínez.'],
    ];
@endphp

<div class="reportes-auditoria-section">
    <h2 class="text-center mb-4">Reportes y Auditoría</h2>



    <!-- Cambios Recientes -->
    <div class="mb-4">
        <h4>Cambios Recientes</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Detalles</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cambiosRecientes as $cambio)
                    <tr>
                        <td>{{ $cambio['fecha'] }}</td>
                        <td>{{ $cambio['usuario'] }}</td>
                        <td>{{ $cambio['accion'] }}</td>
                        <td>{{ $cambio['detalles'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .reportes-auditoria-section {
        padding: 20px;
    }
    .list-group-item {
        cursor: pointer;
    }
</style>
