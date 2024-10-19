<div class="compras-section">
    <h2 class="text-center mb-4">Sección de Compras</h2>

    <!-- Proveedores y Notificaciones -->
    <div class="row mb-4">
        <!-- Proveedores (col-md-7) -->
        <div class="col-md-7">
            <div class="card border-secondary h-100">
                <div class="card-body">
                    <h5 class="card-title text-center">Proveedores</h5>
                    <table class="table table-bordered text-center" id="tabla-proveedores">
                        <thead>
                        <tr>
                            <th>Nombre del Proveedor</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Distribuidora XYZ</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-proveedor">Modificar</button>
                                <button class="btn btn-danger btn-sm" onclick="eliminarProveedor(this)">Eliminar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal-agregar-proveedor">Agregar Proveedor</button>

                    <!-- Botón para ver gráfica de stock dentro de Proveedores -->
                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modal-grafica">Ver Gráfica de Stock</button>
                </div>
            </div>
        </div>

        <!-- Notificaciones (col-md-5) -->
        <div class="col-md-5">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-bell fa-2x text-primary"></i> Notificaciones
                    </h5>
                    <ul class="list-group">
                        <li class="list-group-item">Nueva compra pendiente de aprobación</li>
                        <li class="list-group-item">Stock bajo en productos XYZ</li>
                        <!-- Añade más notificaciones aquí -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Compras Recientes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-primary mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-shopping-cart fa-2x text-primary"></i> Compras Recientes
                    </h5>
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th>Proveedor</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Distribuidora XYZ</td>
                            <td>2024-10-15</td>
                            <td>$4,500.00</td>
                            <td>Pendiente</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-detallar-productos">Detallar</button>
                                <button class="btn btn-danger btn-sm">Cancelar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar-compra">Agregar Compra</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Compra -->
    <div class="modal fade" id="modal-agregar-compra" tabindex="-1" aria-labelledby="modal-agregar-compra-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-agregar-compra-label">Agregar Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="proveedor-compra" class="form-label">Seleccionar Proveedor</label>
                            <select class="form-select" id="proveedor-compra">
                                <option value="" selected disabled>Seleccione un Proveedor</option>
                                <option value="1">Distribuidora XYZ</option>
                                <option value="2">Proveedores ABC</option>
                                <!-- Agrega más proveedores aquí -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha-compra" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha-compra">
                        </div>
                        <button type="button" class="btn btn-primary">Agregar Compra</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Proveedor -->
    <div class="modal fade" id="modal-agregar-proveedor" tabindex="-1" aria-labelledby="modal-agregar-proveedor-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-agregar-proveedor-label">Agregar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-agregar-proveedor">
                        <div class="mb-3">
                            <label for="nuevo-proveedor" class="form-label">Nombre del Proveedor</label>
                            <input type="text" class="form-control" id="nuevo-proveedor" placeholder="Nombre del Proveedor" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="agregarProveedor()">Agregar Proveedor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Proveedor -->
    <div class="modal fade" id="modal-editar-proveedor" tabindex="-1" aria-labelledby="modal-editar-proveedor-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editar-proveedor-label">Modificar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-editar-proveedor">
                        <div class="mb-3">
                            <label for="proveedor-modificar" class="form-label">Nombre del Proveedor</label>
                            <input type="text" class="form-control" id="proveedor-modificar" required>
                        </div>
                        <button type="button" class="btn btn-warning" onclick="modificarProveedor()">Modificar Proveedor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Detallar Productos -->
    <div class="modal fade" id="modal-detallar-productos" tabindex="-1" aria-labelledby="modal-detallar-productos-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-detallar-productos-label">Catálogo de Productos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Filtros de búsqueda -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="busqueda-productos" placeholder="Buscar productos...">
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" id="filtro-stock">
                                <option value="">Filtrar por Stock</option>
                                <option value="con-stock">Con Stock</option>
                                <option value="sin-stock">Sin Stock</option>
                            </select>
                        </div>
                    </div>

                    <!-- Catálogo de productos -->
                    <div class="row" id="catalogo-productos">
                        <!-- Suponiendo que este catálogo se llena dinámicamente con productos del proveedor seleccionado -->
                        <!-- Producto 1 -->
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="https://assets.unileversolutions.com/v1/61844691.png" class="card-img-top" alt="Shampoo">
                                <div class="card-body">
                                    <h5 class="card-title">Shampoo</h5>
                                    <p class="card-text">Precio: $150.00</p>
                                    <p class="text-muted">Stock: 20 unidades</p>
                                    <input type="number" class="form-control mb-2" min="1" value="1">
                                    <button class="btn btn-success w-100">Agregar</button>
                                </div>
                            </div>
                        </div>

                        <!-- Producto 2 -->
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvOPtNV3kYNDc-awdzYYXc07qBvLij-ug1D03Pj_d60g&s" class="card-img-top" alt="Acondicionador">
                                <div class="card-body">
                                    <h5 class="card-title">Acondicionador</h5>
                                    <p class="card-text">Precio: $130.00</p>
                                    <p class="text-muted">Stock: 15 unidades</p>
                                    <input type="number" class="form-control mb-2" min="1" value="1">
                                    <button class="btn btn-success w-100">Agregar</button>
                                </div>
                            </div>
                        </div>

                        <!-- Agrega más productos aquí -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Ver Gráfica -->
    <div class="modal fade" id="modal-grafica" tabindex="-1" aria-labelledby="modal-grafica-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-detallar-productos-label">Catálogo de Productos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center">
                    <!-- Filtros y Búsqueda -->
                    <div class="mb-3">
                        <label for="filtro-select" class="form-label">Ordenar por:</label>
                        <select id="filtro-select" class="form-select" aria-label="Filtro de productos" onchange="ordenarDatos()">
                            <option value="">Seleccione un criterio</option>
                            <option value="stock-mayor">Stock Mayor a Menor</option>
                            <option value="stock-menor">Stock Menor a Mayor</option>
                            <option value="calificacion-alta">Calificación Alta a Baja</option>
                            <option value="calificacion-baja">Calificación Baja a Alta</option>
                            <option value="alfabetico-asc">Orden Alfabético (A-Z)</option>
                            <option value="alfabetico-desc">Orden Alfabético (Z-A)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="busqueda-input" class="form-label">Buscar:</label>
                        <input type="text" id="busqueda-input" class="form-control" placeholder="Ingrese su búsqueda" oninput="filtrarDatos()">
                    </div>

                    <div>GRAFICA STOCK DE PRODUCTOS</div>
                    <div id="chart"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>
