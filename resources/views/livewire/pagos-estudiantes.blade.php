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
        <table class="table table-striped">
            <thead style="background-color: #e6d4d2;">
            <tr>
                <th style="color: #d9534f;">#</th>
                <th style="color: #d9534f;">Estudiante</th>
                <th style="color: #d9534f;">Curso</th>
                <th style="color: #d9534f;">Pagos Completados</th>
                <th style="color: #d9534f;">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($colegiaturas as $index => $estudianteCurso)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $estudianteCurso->estudiante->persona->nombre ?? 'N/A' }}</td>
                    <td>{{ $estudianteCurso->cursoApertura->curso->nombre ?? 'N/A' }}</td>
                    <td>{{ $estudianteCurso->pagos_completados }} / {{ $estudianteCurso->total_semanas }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalDetails{{ $estudianteCurso->id }}">
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
    @foreach($colegiaturas as $estudianteCurso)
        <div class="modal fade" id="modalDetails{{ $estudianteCurso->id }}" tabindex="-1"
             aria-labelledby="modalLabel{{ $estudianteCurso->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #e6d4d2;">
                        <h5 class="modal-title" id="modalLabel{{ $estudianteCurso->id }}" style="color: #d9534f;">
                            Detalles del Curso y Pagos
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Detalles del Curso -->
                        <div class="mb-3">
                            <strong style="color: #d9534f;">Curso Actual:</strong>
                            <p style="color: #4a4a4a; margin-top: 5px;">
                                {{ $estudianteCurso->cursoApertura->curso->nombre ?? 'N/A' }}
                            </p>
                        </div>

                        <!-- Detalles de las Semanas -->
                        <div class="mb-3">
                            <strong style="color: #d9534f;">Semanas:</strong>
                            <ul class="list-unstyled mt-3">
                                @foreach($estudianteCurso->colegiaturas as $semana)
                                    <li style="color: #4a4a4a; margin-bottom: 10px;">
                                        <strong>{{ $semana->semana }}:</strong>
                                        @if($semana->colegiatura == 1)
                                            <span class="badge bg-success ms-2">Pagado</span>
                                            <span style="color: #4a4a4a;">${{ $semana->Monto }}</span>
                                            <div><strong>Fecha de Pago:</strong> {{ $semana->fecha_pago }}</div>
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
