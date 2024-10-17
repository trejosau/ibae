<div class="ventas-section">
    <h2 class="text-center mb-4">Sección de Ventas</h2>

    <!-- Gráfica de Ventas -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-info h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-chart-line fa-2x text-info"></i> Gráfica de Ventas
                    </h5>
                    <div id="grafica-ventas" class="text-center">
                        <!-- Aquí iría la gráfica -->
                        <p>[Gráfica de Ventas Aquí]</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros y Búsqueda -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="input-group">
                <select class="form-select" id="filtro-tipo-venta" aria-label="Tipo de Venta">
                    <option selected>Filtrar por Tipo de Venta</option>
                    <option value="all">Todas</option>
                    <option value="online">ONLINE</option>
                    <option value="fisica">FÍSICA</option>
                </select>
                <input type="text" class="form-control" placeholder="Buscar por nombre..." id="buscar-venta">
                <button class="btn btn-primary" type="button">Buscar</button>
            </div>
        </div>
    </div>

    <!-- Ventas Recientes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-success h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i> Ventas Recientes
                    </h5>
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th>Nombre del Comprador</th>
                            <th>Fecha de la Compra</th>
                            <th>Total de la Venta</th>
                            <th>Estado</th>
                            <th>Tipo de Venta</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Juan Pérez</td>
                            <td>2024-10-05</td>
                            <td>$250</td>
                            <td>Completada</td>
                            <td>ONLINE (Pick & Go)</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-venta">Editar</button>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-detalle-venta">Ver detalle</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>María López</td>
                            <td>2024-10-04</td>
                            <td>$150</td>
                            <td>Completada</td>
                            <td>FÍSICA (Punto de Venta)</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-venta">Editar</button>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-detalle-venta">Ver detalle</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Pedro González</td>
                            <td>2024-10-03</td>
                            <td>$300</td>
                            <td>Pendiente</td>
                            <td>ONLINE (Pick & Go)</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-venta">Editar</button>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-detalle-venta">Ver detalle</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Ana Martínez</td>
                            <td>2024-10-02</td>
                            <td>$200</td>
                            <td>Completada</td>
                            <td>FÍSICA (Punto de Venta)</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-venta">Editar</button>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-detalle-venta">Ver detalle</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Laura Torres</td>
                            <td>2024-10-01</td>
                            <td>$180</td>
                            <td>Pendiente</td>
                            <td>ONLINE (Pick & Go)</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-venta">Editar</button>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-detalle-venta">Ver detalle</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar-venta">Agregar Venta</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Venta -->
    <div class="modal fade" id="modal-editar-venta" tabindex="-1" aria-labelledby="modal-editar-venta-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editar-venta-label">Editar Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre-comprador" class="form-label">Nombre del Comprador</label>
                            <input type="text" class="form-control" id="nombre-comprador" value="Juan Pérez">
                        </div>
                        <div class="mb-3">
                            <label for="fecha-compra" class="form-label">Fecha de Compra</label>
                            <input type="date" class="form-control" id="fecha-compra" value="2024-10-05">
                        </div>
                        <div class="mb-3">
                            <label for="total-venta" class="form-label">Total de la Venta</label>
                            <input type="text" class="form-control" id="total-venta" value="$250">
                        </div>
                        <div class="mb-3">
                            <label for="estado-venta" class="form-label">Estado</label>
                            <select class="form-select" id="estado-venta">
                                <option selected>Completada</option>
                                <option>Pendiente</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tipo-venta" class="form-label">Tipo de Venta</label>
                            <select class="form-select" id="tipo-venta">
                                <option selected>ONLINE (Pick & Go)</option>
                                <option>FÍSICA (Punto de Venta)</option>
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

    <!-- Modal para Agregar Venta -->
    <div class="modal fade" id="modal-agregar-venta" tabindex="-1" aria-labelledby="modal-agregar-venta-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-agregar-venta-label">Agregar Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre-comprador-nueva" class="form-label">Nombre del Comprador</label>
                            <input type="text" class="form-control" id="nombre-comprador-nueva" placeholder="Ingrese el nombre del comprador">
                        </div>
                        <div class="mb-3">
                            <label for="fecha-compra-nueva" class="form-label">Fecha de Compra</label>
                            <input type="date" class="form-control" id="fecha-compra-nueva">
                        </div>
                        <div class="mb-3">
                            <label for="total-venta-nueva" class="form-label">Total de la Venta</label>
                            <input type="text" class="form-control" id="total-venta-nueva" placeholder="Ingrese el total de la venta">
                        </div>
                        <div class="mb-3">
                            <label for="estado-venta-nueva" class="form-label">Estado</label>
                            <select class="form-select" id="estado-venta-nueva">
                                <option selected>Completada</option>
                                <option>Pendiente</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tipo-venta-nueva" class="form-label">Tipo de Venta</label>
                            <select class="form-select" id="tipo-venta-nueva">
                                <option selected>FÍSICA (Punto de Venta)</option>
                                <option>ONLINE (Pick & Go)</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" id="btn-agregar-venta">Agregar Venta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
