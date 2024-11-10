<div class="servicios-section">
    <div class="filter-section mb-4">
        <h2 class="text-center mb-4">Filtrar Servicios</h2>
        <div class="row align-items-end">
            <div class="col-md-5 mb-3">
                <label for="select-mes" class="form-label">Seleccionar Mes</label>
                <select class="form-select" id="select-mes">
                    <option value="" disabled selected>Seleccione un mes</option>
                    <option value="enero">Enero</option>
                    <option value="febrero">Febrero</option>
                    <option value="marzo">Marzo</option>
                    <option value="abril">Abril</option>
                    <option value="mayo">Mayo</option>
                    <option value="junio">Junio</option>
                    <option value="julio">Julio</option>
                    <option value="agosto">Agosto</option>
                    <option value="septiembre">Septiembre</option>
                    <option value="octubre">Octubre</option>
                    <option value="noviembre">Noviembre</option>
                    <option value="diciembre">Diciembre</option>
                </select>
            </div>
            <div class="col-md-5 mb-3">
                <label for="select-ano" class="form-label">Seleccionar Año</label>
                <select class="form-select" id="select-ano">
                    <option value="" disabled selected>Seleccione un año</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <!-- Agrega más años si es necesario -->
                </select>
            </div>
            <div class="col-md-2 mb-3 text-end">
                <label class="form-label d-none">Filtrar</label> <!-- Label hidden for accessibility -->
                <button class="btn btn-primary w-100" id="btn-filtrar">Filtrar</button>
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

