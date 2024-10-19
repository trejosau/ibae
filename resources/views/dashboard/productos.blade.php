@php
    // Simulación de datos que normalmente vendrían del controlador
    $productos = [
        (object)[
            'id' => 1,
            'nombre' => 'Producto 1',
            'cantidad_stock' => 50,
            'precio_venta' => 100,
            'estado' => 'activo',
            'imagen' => 'ruta/a/imagen1.jpg',
        ],
        (object)[
            'id' => 2,
            'nombre' => 'Producto 2',
            'cantidad_stock' => 30,
            'precio_venta' => 150,
            'estado' => 'inactivo',
            'imagen' => 'https://d1eipm3vz40hy0.cloudfront.net/images/SSAC-Blog/mercadotecnia-marketing-productos.jpg',
        ],
        (object)[
            'id' => 3,
            'nombre' => 'Producto 3',
            'cantidad_stock' => 20,
            'precio_venta' => 200,
            'estado' => 'activo',
            'imagen' => 'ruta/a/imagen3.jpg',
        ],
    ];
@endphp

<div class="productos-section">
    <h2 class="text-center mb-4">Gestión de Productos</h2>

    <!-- Card para Gráficas -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center border-success">
                <div class="card-header">Productos Más Vendidos</div>
                <div class="card-body">
                    <canvas id="productosMasVendidosChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-success">
                <div class="card-header">Mejor Valorados</div>
                <div class="card-body">
                    <canvas id="mejorValoradosChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-success">
                <div class="card-header">Menos Vendidos</div>
                <div class="card-body">
                    <canvas id="menosVendidosChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros y Barra de Búsqueda en la Misma Línea -->
    <div class="row mb-3 align-items-end">
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Buscar productos..." id="searchInput">
        </div>
        <div class="col-md-3">
            <select class="form-select" id="filterEstado">
                <option value="">Filtrar por Estado</option>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" class="form-control" id="minPrice" placeholder="Min Precio">
        </div>
        <div class="col-md-2">
            <input type="number" class="form-control" id="maxPrice" placeholder="Max Precio">
        </div>
    </div>

    <!-- Filtros de Cantidad en Stock -->
    <div class="row mb-3 align-items-end">
        <div class="col-md-2">
            <input type="number" class="form-control" id="minStock" placeholder="Min Stock">
        </div>
        <div class="col-md-2">
            <input type="number" class="form-control" id="maxStock" placeholder="Max Stock">
        </div>
        <div class="col-md-4">
            <h5>Seleccionar columnas a mostrar:</h5>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Seleccionar Columnas
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item"><input type="checkbox" id="toggleNombre" checked> Nombre</a></li>
                    <li><a class="dropdown-item"><input type="checkbox" id="toggleCantidad" checked> Cantidad en Stock</a></li>
                    <li><a class="dropdown-item"><input type="checkbox" id="togglePrecio" checked> Precio de Venta</a></li>
                    <li><a class="dropdown-item"><input type="checkbox" id="toggleEstado" checked> Estado</a></li>
                    <li><a class="dropdown-item"><input type="checkbox" id="toggleAcciones" checked> Acciones</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Tabla de Productos -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-success h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-box-open fa-2x text-success"></i> Lista de Productos
                    </h5>
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                        <tr>
                            <th data-sort="nombre">Nombre del Producto</th>
                            <th data-sort="cantidad">Cantidad en Stock</th>
                            <th data-sort="precio">Precio de Venta</th>
                            <th data-sort="estado">Estado</th>
                            <th data-sort="acciones">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td class="nombre">{{ $producto->nombre }}</td>
                                <td class="cantidad">{{ $producto->cantidad_stock }}</td>
                                <td class="precio">${{ $producto->precio_venta }}</td>
                                <td class="estado">{{ ucfirst($producto->estado) }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-producto-{{ $producto->id }}">
                                        <i class="fas fa-edit"></i> Modificar
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Paginación -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                        </ul>
                    </nav>

                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar-producto">
                        <i class="fas fa-plus-circle"></i> Agregar Producto
                    </button>
                    <button class="btn btn-success" id="exportExcelBtn">
                        <i class="fas fa-file-excel"></i> Exportar a Excel
                    </button>
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
                            <select class="form-select" id="estado-nuevo-producto">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Agregar Producto</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Producto -->
    @foreach($productos as $producto)
        <div class="modal fade" id="modal-editar-producto-{{ $producto->id }}" tabindex="-1" aria-labelledby="modal-editar-producto-{{ $producto->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-editar-producto-{{ $producto->id }}-label">Modificar Producto: {{ $producto->nombre }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="nombre-editar-producto-{{ $producto->id }}" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" id="nombre-editar-producto-{{ $producto->id }}" value="{{ $producto->nombre }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad-editar-producto-{{ $producto->id }}" class="form-label">Cantidad en Stock</label>
                                <input type="number" class="form-control" id="cantidad-editar-producto-{{ $producto->id }}" value="{{ $producto->cantidad_stock }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="precio-editar-producto-{{ $producto->id }}" class="form-label">Precio de Venta</label>
                                <input type="number" class="form-control" id="precio-editar-producto-{{ $producto->id }}" value="{{ $producto->precio_venta }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado-editar-producto-{{ $producto->id }}" class="form-label">Estado</label>
                                <select class="form-select" id="estado-editar-producto-{{ $producto->id }}">
                                    <option value="activo" {{ $producto->estado === 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ $producto->estado === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Modificar Producto</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('productosMasVendidosChart').getContext('2d');
    const ctx2 = document.getElementById('mejorValoradosChart').getContext('2d');
    const ctx3 = document.getElementById('menosVendidosChart').getContext('2d');

    const productosMasVendidosChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Producto 1', 'Producto 2', 'Producto 3'],
            datasets: [{
                label: 'Cantidad Vendida',
                data: [30, 20, 10],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const mejorValoradosChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Producto 1', 'Producto 2', 'Producto 3'],
            datasets: [{
                label: 'Calificación',
                data: [5, 4, 3],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const menosVendidosChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Producto 1', 'Producto 2', 'Producto 3'],
            datasets: [{
                label: 'Cantidad Vendida',
                data: [10, 5, 2],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
