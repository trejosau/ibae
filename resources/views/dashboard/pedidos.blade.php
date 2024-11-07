<div class="container my-4">
    <h2 class="mb-4" style="color: #d47a85;">Pedidos</h2>

    <!-- Filtro de Estado de Pedido -->
    <div class="mb-4">
        <label for="estado" class="form-label" style="color: #ab6680;">Filtrar por Estado de Pedido:</label>
        <select class="form-select" id="estado" style="border-color: #d47a85;">
            <option selected>Todos</option>
            <option>Entregado</option>
            <option>Listo para Entrega</option>
            <option>Preparando para Entrega</option>
        </select>
    </div>

    <!-- Lista de Pedidos -->
    <div class="list-group">
        <!-- Pedido - Preparando para Entrega -->
        <div class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #ffe3e9; border-color: #d47a85;">
            <div>
                <h5 class="mb-1" style="color: #7a3b47;">Pedido #1234</h5>
                <p class="mb-1">Estado: <span class="badge" style="background-color: #e7bdd3; color: #7a3b47;">Preparando para entrega</span></p>
                <p class="mb-1">Total: $120.00</p>
            </div>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pedidoModal1234" style="background-color: #ab6680; border: none;">Ver Más</button>
        </div>

        <!-- Pedido - Listo para Entrega -->
        <div class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #f7e6f2; border-color: #d47a85;">
            <div>
                <h5 class="mb-1" style="color: #7a3b47;">Pedido #1235</h5>
                <p class="mb-1">Estado: <span class="badge" style="background-color: #e7bdd3; color: #7a3b47;">Listo para entrega</span></p>
                <p class="mb-1">Total: $85.00</p>
            </div>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#pedidoModal1235" style="background-color: #66a89a; border: none;">Ver Más</button>
        </div>

        <!-- Pedido - Entregado -->
        <div class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #d8eff0; border-color: #d47a85;">
            <div>
                <h5 class="mb-1" style="color: #7a3b47;">Pedido #1236</h5>
                <p class="mb-1">Estado: <span class="badge" style="background-color: #e7bdd3; color: #7a3b47;">Entregado</span></p>
                <p class="mb-1">Total: $75.00</p>
            </div>
            <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#pedidoModal1236" style="background-color: #b8d9ce; border: none;">Ver Más</button>
        </div>
    </div>

    <!-- Modal - Pedido #1234 (Preparando para entrega) -->
    <div class="modal fade" id="pedidoModal1234" tabindex="-1" aria-labelledby="pedidoModalLabel1234" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #d8eff0; border-color: #d47a85;">
                    <h5 class="modal-title" id="pedidoModalLabel1237" style="color: #7a3b47;">Detalles del Pedido #1237</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pedido-info mb-3">
                        <p class="mb-1">Estado: <span class="badge" style="background-color: #e7bdd3; color: #7a3b47;">Preparando para entrega</span></p>
                        <p class="mb-1">Fecha Pedido: 2024-11-07</p>
                        <p class="mb-1">Clave de Entrega: <strong>XYZ1237</strong></p>
                    </div>
                    <h6 style="color: #ab6680;">Productos</h6>
                    <table class="table table-borderless">
                        <thead style="background-color: #f7e6f2; color: #7a3b47;">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Descuento</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Crema Facial</td>
                            <td>2</td>
                            <td>$25.00</td>
                            <td>$5.00</td>
                        </tr>
                        <tr>
                            <td>Perfume</td>
                            <td>1</td>
                            <td>$50.00</td>
                            <td>$0.00</td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- Botón para marcar como "Listo para Entregar" -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" style="background-color: #f5b300; border: none;">Marcar como Listo para Entregar</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - Pedido #1235 (Listo para entrega) -->
    <div class="modal fade" id="pedidoModal1235" tabindex="-1" aria-labelledby="pedidoModalLabel1235" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #f7e6f2; border-color: #d47a85;">
                    <h5 class="modal-title" id="pedidoModalLabel1235" style="color: #7a3b47;">Detalles del Pedido #1235</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pedido-info mb-3">
                        <p class="mb-1">Estado: <span class="badge" style="background-color: #e7bdd3; color: #7a3b47;">Listo para entrega</span></p>
                        <p class="mb-1">Fecha Pedido: 2024-11-07</p>
                        <p class="mb-1">Clave de Entrega: <strong>XYZ1235</strong></p>
                    </div>
                    <h6 style="color: #ab6680;">Productos</h6>
                    <table class="table table-borderless">
                        <thead style="background-color: #f7e6f2; color: #7a3b47;">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Descuento</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Gel de Baño</td>
                            <td>1</td>
                            <td>$8.00</td>
                            <td>$1.00</td>
                        </tr>
                        <tr>
                            <td>Crema Facial</td>
                            <td>2</td>
                            <td>$18.00</td>
                            <td>$0.00</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="recolector-info mt-3">
                        <label for="nombreRecolector1235" class="form-label" style="color: #66a89a;">Nombre del Recolector</label>
                        <input type="text" id="nombreRecolector1235" class="form-control" placeholder="Nombre de quien recoge el pedido" style="border-color: #b8d9ce;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" style="background-color: #ffd0a6; border: none;">Marcar como Entregado</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - Pedido #1236 (Entregado) -->
    <div class="modal fade" id="pedidoModal1236" tabindex="-1" aria-labelledby="pedidoModalLabel1236" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #d8eff0; border-color: #d47a85;">
                    <h5 class="modal-title" id="pedidoModalLabel1236" style="color: #7a3b47;">Detalles del Pedido #1236</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pedido-info mb-3">
                        <p class="mb-1">Estado: <span class="badge" style="background-color: #e7bdd3; color: #7a3b47;">Entregado</span></p>
                        <p class="mb-1">Fecha Pedido: 2024-11-06</p>
                        <p class="mb-1">Clave de Entrega: <strong>PQR1236</strong></p>
                    </div>
                    <h6 style="color: #ab6680;">Productos</h6>
                    <table class="table table-borderless">
                        <thead style="background-color: #f7e6f2; color: #7a3b47;">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Descuento</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Toalla</td>
                            <td>3</td>
                            <td>$5.00</td>
                            <td>$0.00</td>
                        </tr>
                        <tr>
                            <td>Creamos Hidratantes</td>
                            <td>2</td>
                            <td>$12.00</td>
                            <td>$1.00</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="recolector-info mt-3">
                        <label for="nombreRecolector1236" class="form-label" style="color: #66a89a;">Nombre del Recolector</label>
                        <!-- Campo deshabilitado -->
                        <input type="text" id="nombreRecolector1236" class="form-control" value="Juan Pérez" placeholder="Nombre de quien recoge el pedido" style="border-color: #b8d9ce;" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>

