<div class="servicios-section">
    <h2 class="text-center mb-4">Sección de Servicios</h2>

    <!-- Gráfica de Servicios -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-info h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-chart-pie fa-2x text-info"></i> Gráfica de Servicios Solicitados
                    </h5>
                    <div id="grafica-servicios" class="text-center">
                        <p>[Gráfica de Servicios Aquí]</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Servicios Activos -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-success h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-cut fa-2x text-success"></i> Servicios Activos
                    </h5>
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Corte de Cabello</td>
                            <td>$250</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-servicio">Editar</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Alisado</td>
                            <td>$550</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-servicio">Editar</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Mechas</td>
                            <td>$2200</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-servicio">Editar</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar-servicio">Agregar Servicio</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Servicio -->
    <div class="modal fade" id="modal-agregar-servicio" tabindex="-1" aria-labelledby="modal-agregar-servicio-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-agregar-servicio-label">Agregar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre-servicio" class="form-label">Nombre del Servicio</label>
                            <input type="text" class="form-control" id="nombre-servicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio-servicio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio-servicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado-servicio" class="form-label">Estado</label>
                            <select class="form-select" id="estado-servicio" required>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Agregar Servicio</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Servicio -->
    <div class="modal fade" id="modal-editar-servicio" tabindex="-1" aria-labelledby="modal-editar-servicio-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editar-servicio-label">Editar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre-servicio-editar" class="form-label">Nombre del Servicio</label>
                            <input type="text" class="form-control" id="nombre-servicio-editar" value="Corte de Cabello" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio-servicio-editar" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio-servicio-editar" value="250" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado-servicio-editar" class="form-label">Estado</label>
                            <select class="form-select" id="estado-servicio-editar" required>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
