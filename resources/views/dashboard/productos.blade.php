<div class="productos-section">
    <h2 class="text-center mb-4">Gestión de Productos</h2>

    <!-- Tabla de Productos -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-success h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-box-open fa-2x text-success"></i> Lista de Productos
                    </h5>
                    <table class="table table-bordered  table-hover text-center">
                        <thead>
                        <tr>
                            <th>Nombre del Producto</th>
                            <th>Cantidad en Stock</th>
                            <th>Precio de Venta</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <span class="text-primary">Shampoo Hidratante</span>
                                <br>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-catalogo-producto-1" class="text-info">[Ver Catálogo]</a>
                            </td>
                            <td>50</td>
                            <td>$150</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-producto-1">Modificar</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-primary">Acondicionador Nutritivo</span>
                                <br>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-catalogo-producto-2" class="text-info">[Ver Catálogo]</a>
                            </td>
                            <td>30</td>
                            <td>$180</td>
                            <td>Activo</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-producto-2">Modificar</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar-producto">Agregar Producto</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Producto -->
    <div class="modal fade" id="modal-agregar-producto" tabindex="-1" aria-labelledby="modal-agregar-producto-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-agregar-producto-label">Agregar Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre-nuevo-producto" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre-nuevo-producto" placeholder="Ingrese el nombre del producto" required>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad-nuevo-producto" class="form-label">Cantidad en Stock</label>
                            <input type="number" class="form-control" id="cantidad-nuevo-producto" placeholder="Ingrese la cantidad disponible" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio-nuevo-producto" class="form-label">Precio de Venta</label>
                            <input type="number" class="form-control" id="precio-nuevo-producto" placeholder="Ingrese el precio de venta" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado-nuevo-producto" class="form-label">Estado</label>
                            <select class="form-select" id="estado-nuevo-producto" required>
                                <option value="activo" selected>Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="imagen-nuevo-producto" class="form-label">Imagen Principal</label>
                            <input type="file" class="form-control" id="imagen-nuevo-producto" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar Producto</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para el Catálogo de Imágenes del Producto 1 -->
    <div class="modal fade" id="modal-catalogo-producto-1" tabindex="-1" aria-labelledby="modal-catalogo-producto-1-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-catalogo-producto-1-label">Catálogo de Imágenes - Shampoo Hidratante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Imagen Principal</h6>
                            <div class="text-center">
                                <img src="https://th.bing.com/th/id/OIP.xUPlHVpDpgOIMzYgPuyPVQHaHa?rs=1&pid=ImgDetMain" class="img-fluid mb-2" alt="Imagen Principal" id="imagen-principal-1">
                                <button class="btn btn-info btn-sm mt-3" id="editar-imagen-principal-1">Editar Imagen</button>
                            </div>
                        </div>
                    </div>
                    <!-- Input hidden que se activará al dar click en "Editar Imagen" -->
                    <input type="file" id="input-editar-imagen-principal-1" style="display:none;" accept="image/*">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para el Catálogo de Imágenes del Producto 2 -->
    <div class="modal fade" id="modal-catalogo-producto-2" tabindex="-1" aria-labelledby="modal-catalogo-producto-2-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-catalogo-producto-2-label">Catálogo de Imágenes - Acondicionador Nutritivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Imagen Principal</h6>
                            <div class="text-center">
                                <img src="path/to/main-image-2.jpg" class="img-fluid mb-2" alt="Imagen Principal" id="imagen-principal-2">
                                <button class="btn btn-info btn-sm mt-3" id="editar-imagen-principal-2">Editar Imagen</button>
                            </div>
                        </div>
                    </div>
                    <!-- Input hidden que se activará al dar click en "Editar Imagen" -->
                    <input type="file" id="input-editar-imagen-principal-2" style="display:none;" accept="image/*">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Producto 1 -->
    <div class="modal fade" id="modal-editar-producto-1" tabindex="-1" aria-labelledby="modal-editar-producto-1-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editar-producto-1-label">Modificar Producto - Shampoo Hidratante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre-producto-1" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre-producto-1" value="Shampoo Hidratante" required>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad-producto-1" class="form-label">Cantidad en Stock</label>
                            <input type="number" class="form-control" id="cantidad-producto-1" value="50" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio-producto-1" class="form-label">Precio de Venta</label>
                            <input type="number" class="form-control" id="precio-producto-1" value="150" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado-producto-1" class="form-label">Estado</label>
                            <select class="form-select" id="estado-producto-1" required>
                                <option value="activo" selected>Activo</option>
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

    <!-- Modal para Editar Producto 2 -->
    <div class="modal fade" id="modal-editar-producto-2" tabindex="-1" aria-labelledby="modal-editar-producto-2-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editar-producto-2-label">Modificar Producto - Acondicionador Nutritivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre-producto-2" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre-producto-2" value="Acondicionador Nutritivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad-producto-2" class="form-label">Cantidad en Stock</label>
                            <input type="number" class="form-control" id="cantidad-producto-2" value="30" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio-producto-2" class="form-label">Precio de Venta</label>
                            <input type="number" class="form-control" id="precio-producto-2" value="180" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado-producto-2" class="form-label">Estado</label>
                            <select class="form-select" id="estado-producto-2" required>
                                <option value="activo" selected>Activo</option>
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
