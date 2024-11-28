<div class="container mt-5 p-4" style="background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <h2 class="text-center mb-4" style="color: #d9534f; font-weight: bold;">Historial de Pagos</h2>

    <!-- Tabla de Pagos -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover" style="background-color: #fff; border-radius: 8px; overflow: hidden;">
            <thead class="text-center" style="background-color: #f2dede; color: #d9534f; font-weight: bold;">
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
                    <tr style="text-align: center; color: #5a5a5a;">
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
