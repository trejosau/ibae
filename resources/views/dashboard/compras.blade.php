<div class="citas-section">
    <h2 class="text-center mb-4">Sección de Citas</h2>

    <!-- Gráfica de Citas -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-info h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-calendar-alt fa-2x text-info"></i> Gráfica de Citas
                    </h5>
                    <div id="grafica-citas" class="text-center">
                        <p>[Gráfica de Citas Aquí]</p>
                    </div>
                </div>
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
                            <td>Completada</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-cita">Editar</button>
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
                        <button type="button" class="btn btn-primary">Agregar Cita</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
