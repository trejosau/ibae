<div class="auditoria-section">
    <h2 class="text-center mb-4">Reportes y Auditoría</h2>

    @foreach($auditorias as $auditoria)
        <table class="table table-bordered table-striped table-hover text-center">
            <thead class="table-primary">
            <tr>
                <th>Fecha</th>
                <th>Operación</th>
                <th>PROCESO AFECTADO</th>
                <th>USUARIO RESPONSABLE</th>
                <th>USUARIO AFECTADO</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $auditoria->fecha }}</td>
                    <td>{{ $auditoria->operacion }}</td>
                    <td>{{ $auditoria->tabla_afectada }}</td>
                    <td>{{ $auditoria->usuario_actor }}</td>
                    <td>{{ $auditoria->AfectadoUser->name ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
    @endforeach
</div>



<style>
    .reportes-auditoria-section {
        padding: 20px;
    }
    .list-group-item {
        cursor: pointer;
    }
</style>