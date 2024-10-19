<div class="citas-section">
    <h2 class="text-center mb-4">Sección de Citas</h2>

    <!-- Filtros -->


    <!-- Gráfica de Citas -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-info h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-calendar-alt fa-2x text-info"></i> Gráfica de Citas
                    </h5>
                    <div id="grafica-citas" class="text-center">
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-6">
            <div class="input-group">
                <label class="input-group-text" for="filtro-estilista">Filtrar por Estilista</label>
                <select class="form-select" id="filtro-estilista">
                    <option selected>Selecciona un estilista...</option>
                    <option value="1">Estilista 1</option>
                    <option value="2">Estilista 2</option>
                    <option value="3">Estilista 3</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="input-group">
                <label class="input-group-text" for="filtro-fecha">Filtrar por Fecha</label>
                <input type="date" class="form-control" id="filtro-fecha">
            </div>
        </div>
    </div>
    <!-- Citas Recientes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-primary h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-list-alt fa-2x text-primary"></i> Citas Recientes
                    </h5>
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Servicios</th>
                            <th>Estilista</th> <!-- Nueva columna para Estilista -->
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Ana López</td>
                            <td>2024-10-15</td>
                            <td>10:00 AM</td>
                            <td>Corte + Peinado</td>
                            <td>Estilista 1</td> <!-- Estilista asignado -->
                            <td>Completada</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-cita">Editar</button>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-ver-detalle">Ver Detalle</button>
                                <button class="btn btn-danger btn-sm">Cancelar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar-cita">Agregar Cita</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Ver Detalle de Cita -->
    <div class="modal fade" id="modal-ver-detalle" tabindex="-1" aria-labelledby="modal-ver-detalle-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-ver-detalle-label">Detalle de la Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Cliente:</strong> Ana López</li>
                        <li class="list-group-item"><strong>Fecha:</strong> 2024-10-15</li>
                        <li class="list-group-item"><strong>Hora:</strong> 10:00 AM</li>
                        <li class="list-group-item"><strong>Servicios:</strong> Corte de cabello, Peinado</li>
                        <li class="list-group-item"><strong>Estilista:</strong> Estilista 1</li> <!-- Estilista en el detalle -->
                        <li class="list-group-item"><strong>Observaciones:</strong> Cliente solicitó peinado con ondas suaves.</li>
                        <li class="list-group-item"><strong>Estado:</strong> Completada</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Cita -->
    <div class="modal fade" id="modal-agregar-cita" tabindex="-1" aria-labelledby="modal-agregar-cita-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-agregar-cita-label">Agregar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="cliente-cita" class="form-label">Cliente</label>
                            <input type="text" class="form-control" id="cliente-cita" placeholder="Nombre del Cliente">
                        </div>
                        <div class="mb-3">
                            <label for="fecha-cita" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha-cita">
                        </div>
                        <div class="mb-3">
                            <label for="hora-cita" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="hora-cita">
                        </div>
                        <div class="mb-3">
                            <label for="servicios-cita" class="form-label">Servicios</label>
                            <select multiple class="form-select" id="servicios-cita">
                                <option value="1">Corte de Cabello</option>
                                <option value="2">Peinado</option>
                                <option value="3">Mechas</option>
                                <option value="4">Maquillaje</option>
                                <option value="5">Pedicura</option>
                            </select>
                            <small class="form-text text-muted">Mantén presionada la tecla Ctrl (Windows) o Cmd (Mac) para seleccionar múltiples servicios.</small>
                        </div>
                        <div class="mb-3">
                            <label for="estilista-cita" class="form-label">Estilista</label>
                            <select class="form-select" id="estilista-cita">
                                <option value="1">Estilista 1</option>
                                <option value="2">Estilista 2</option>
                                <option value="3">Estilista 3</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary">Agregar Cita</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
