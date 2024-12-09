<div>
    <!-- Filtros -->
    <div class="d-flex justify-content-center align-items-center flex-wrap mb-4">
        <!-- Filtro por Matrícula -->
        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <input
                type="text"
                class="form-control"
                placeholder="Buscar por Matrícula"
                style="border-color: #d9534f;"
                wire:model.live="matricula"
            >
        </div>
        <!-- Fecha de Inicio -->
        <div class="col-lg-2 col-md-6 col-12 mb-3">
            <input
                type="date"
                class="form-control"
                placeholder="Fecha de Inicio"
                style="border-color: #5cb85c;"
                wire:model.live="fecha_inicio"
            >
        </div>
        <!-- Fecha de Fin -->
        <div class="col-lg-2 col-md-6 col-12 mb-3">
            <input
                type="date"
                class="form-control"
                placeholder="Fecha de Fin"
                style="border-color: #5cb85c;"
                wire:model.live="fecha_fin"
            >
        </div>
    </div>

    <!-- Tabla de Pagos -->
    <div class="table-responsive">
        <table class="table table-striped" style="background-color: #fff; color: #4a4a4a; border-radius: 8px;">
            <thead style="background-color: #e6d4d2;">
            <tr>
                <th style="color: #d9534f;">Matrícula</th>
                <th style="color: #d9534f;">Nombre del Estudiante</th>
                <th style="color: #d9534f;">Adeudo</th>
                <th style="color: #d9534f;">Acciones</th> <!-- Nueva columna de acciones -->
            </tr>
            </thead>
            <tbody>
            @foreach($colegiaturas as $colegiatura)
                <tr>
                    <td>{{ $colegiatura->estudianteCurso->estudiante->matricula ?? 'N/A' }}</td>
                    <td>{{ $colegiatura->estudianteCurso->estudiante->persona->nombre ?? 'N/A' }}</td>
                    <td>${{ $colegiatura->adeudo }}</td>
                    <td>
                        <!-- Botón para abrir el modal -->
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetails{{ $colegiatura->estudianteCurso->id }}">
                            Ver Detalles
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $colegiaturas->links() }}
        </div>
    </div>

    <!-- Modal para detalles -->
    @foreach($colegiaturas as $colegiatura)
        <div class="modal fade" id="modalDetails{{ $colegiatura->estudianteCurso->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $colegiatura->estudianteCurso->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #e6d4d2;">
                        <h5 class="modal-title" id="modalLabel{{ $colegiatura->estudianteCurso->id }}" style="color: #d9534f;">Detalles del Curso y Pagos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Detalles del Curso -->
                        <div class="mb-3">
                            <strong style="color: #d9534f;">Curso Actual:</strong>
                            <p style="color: #4a4a4a; margin-top: 5px;">{{ $colegiatura->estudianteCurso->cursoApertura->curso->nombre ?? 'N/A' }}</p>
                        </div>

                        <!-- Detalles de las Semanas -->
                        <div class="mb-3">
                            <strong style="color: #d9534f;">Semanas:</strong>
                            <ul class="list-unstyled mt-3">
                                @foreach($colegiatura->estudianteCurso->colegiaturas as $semana)
                                    <li style="color: #4a4a4a; margin-bottom: 10px;">
                                        <strong>{{ $semana->semana }}:</strong>
                                        @if($semana->colegiatura == 1)
                                            <span class="badge bg-success ms-2">Pagado</span>
                                            <span style="color: #4a4a4a;">${{ $semana->Monto }}</span>
                                            <div><strong>Fecha de Pago:</strong> {{ $colegiatura->fecha_pago }}</div>
                                        @else
                                            <span class="badge bg-danger ms-2">No Pagado</span>
                                            <span style="color: #4a4a4a;">${{ $semana->Monto }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
