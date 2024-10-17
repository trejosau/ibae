<div class="container mt-5 salon-servicios-dashboard">
    <h2 class="text-center mb-4">Servicios del Salón</h2>

    <div class="row mb-4">
        <div class="col-md-6">
            <h4 class="text-center mb-3">Gestión de Servicios</h4>

            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal-agregar-servicio">
                Agregar Servicio
            </button>

            <table class="table table-bordered text-center">
                <thead class="table-dark">
                <tr>
                    <th>Nombre del Servicio</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Alisado</td>
                    <td>$550</td>
                    <td><span class="badge bg-success">Activo</span></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-servicio">Editar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Servicio Más Solicitado
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Alisado</h5>
                    <p class="card-text">Veces solicitado: 35</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Servicio -->
    <div class="modal fade" id="modal-agregar-servicio" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre-servicio" class="form-label">Nombre del Servicio</label>
                            <input type="text" class="form-control" id="nombre-servicio" placeholder="Ingrese el nombre">
                        </div>
                        <div class="mb-3">
                            <label for="precio-servicio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio-servicio" placeholder="Ingrese el precio">
                        </div>
                        <div class="mb-3">
                            <label for="estado-servicio" class="form-label">Estado</label>
                            <select class="form-select" id="estado-servicio">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Servicio -->
    <div class="modal fade" id="modal-editar-servicio" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editar-nombre-servicio" class="form-label">Nombre del Servicio</label>
                            <input type="text" class="form-control" id="editar-nombre-servicio" value="Alisado">
                        </div>
                        <div class="mb-3">
                            <label for="editar-precio-servicio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="editar-precio-servicio" value="550">
                        </div>
                        <div class="mb-3">
                            <label for="editar-estado-servicio" class="form-label">Estado</label>
                            <select class="form-select" id="editar-estado-servicio">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
