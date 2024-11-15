<div class="container mt-5" style="background-color: #f9f3f0; padding: 20px; border-radius: 8px; ">
    <h2 class="text-center mb-4" style="color: #d9534f;">Historial de Pagos</h2>

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Buscar por Matrícula" style="border-color: #d9534f;">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Buscar por Nombre" style="border-color: #d9534f;">
        </div>
        <div class="col-md-4">
            <input type="date" class="form-control" placeholder="Fecha de Pago" style="border-color: #d9534f;">
        </div>
    </div>

    <table class="table table-striped table-responsive w-100" style="background-color: #fff; color: #4a4a4a;">
        <thead style="background-color: #e6d4d2;">
            <tr>
                <th style="color: #d9534f;">Matrícula</th>
                <th style="color: #d9534f;">Nombre del Estudiante</th>
                <th style="color: #d9534f;">Fecha de Pago</th>
                <th style="color: #d9534f;">Adeudo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($colegiaturas as $colegiatura)
                <tr class="clickable-row" data-type="colegiatura" style="cursor: pointer;">
                    <td>{{ $colegiatura->estudianteCurso->estudiante->matricula ?? 'N/A' }}</td>
                    <td>{{ $colegiatura->estudianteCurso->estudiante->persona->nombre ?? 'N/A' }}</td>
                    <td>{{ $colegiatura->fecha_pago }}</td>
                    <td>${{ $colegiatura->adeudo }}</td>
                </tr>
                <tr class="details-row" style="display: none; background-color: #f1e3e1;">
                    <td colspan="4">
                        <div class="p-3" style="background-color: #fff; border: 1px solid #e6d4d2; border-radius: 5px;">
                            <strong style="color: #d9534f;">Curso Actual:</strong>
                            <p style="color: #4a4a4a;">{{ $colegiatura->estudianteCurso->cursoApertura->curso->nombre ?? 'N/A' }}</p>
                            
                            <strong style="color: #d9534f;">Semanas:</strong>
                            <ul class="list-unstyled mt-3">
                                @foreach($colegiatura->estudianteCurso->colegiaturas as $semana)
                                    <li style="color: #4a4a4a;">
                                        {{ $semana->semana }}: 
                                        @if($semana->colegiatura == 1)
                                            <span class="badge bg-success ms-2">Pagado</span>
                                            <span style="color: #4a4a4a;">${{ $semana->Monto }}</span>
                                        @else
                                            <span class="badge bg-danger ms-2">No Pagado</span>
                                            <span style="color: #4a4a4a;">${{ $semana->Monto }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', function() {
            const detailsRow = this.nextElementSibling;
            detailsRow.style.display = detailsRow.style.display === 'none' ? '' : 'none';
        });
    });
</script>
