<div class="container mt-5">
    <h2 class="text-center mb-4">Historial de Pagos</h2>

    <!-- Tabla de Pagos -->
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Nombre del Curso</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Pago</th>
                <th>Semana</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($colegiaturas as $pago)
                <tr>
                    <td>{{ $pago->nombre_curso }}</td>
                    <td>{{ $pago->fecha_inicio }}</td>
                    <td>{{ $pago->fecha_pago }}</td>
                    <td>{{ $pago->semana }}</td>
                    <td>${{ number_format($pago->Monto, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('table tbody tr');

        rows.forEach(function(row) {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
