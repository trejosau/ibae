<div class="d-flex" style="height: 100%;">
    <div
        style="
        width: 300px;
        height: 100vh;
        display: flex;
        flex-direction: column;
        background-color: #f8f9fa;
        padding: 1rem;
        border-right: 1px solid #dee2e6;"
    >
        <h5 class="mb-3">Resumen de Venta</h5>

        <!-- Otros elementos del sidebar -->
        <div>
            <label for="comprador">Comprador:</label>
            <input
                type="text"
                id="comprador"
                class="form-control mb-3"
                placeholder="Ingrese el nombre del comprador"
                wire:model="comprador"
            />
        </div>

        <div>
            <label for="esEstudiante">¿Es estudiante?:</label>
            <small class="form-text text-muted">Si estudiante, se le dará precio lista.</small>
            <input
                type="checkbox"
                id="esEstudiante"
                class="form-check-input mb-3"
                wire:model.live="esEstudiante"
            />

            @if ($esEstudiante)
                <div>
                    <label for="matricula">Buscar matrícula:</label>
                    <input
                        type="text"
                        id="matricula"
                        class="form-control"
                        placeholder="Ingrese matrícula"
                        wire:model.live="query"
                    />
                </div>
            @endif

            @if (!empty($resultados))
                <div class="mt-3">
                    <label for="resultados">Resultados:</label>
                    <select id="resultados" class="form-control" wire:model="matricula">
                        <option disabled selected>Seleccione una matrícula</option>
                        @foreach ($resultados as $resultado)
                            <option value="{{ $resultado['matricula'] }}">
                                {{ $resultado['persona']['nombre'] }}
                                {{ $resultado['persona']['ap_paterno'] }}
                                - {{ $resultado['matricula'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @else
                <p class="text-muted mt-3">No se encontraron resultados.</p>
            @endif
        </div>

        <!-- Contenedor para la lista con scroll -->
        <div style="flex: 1; overflow-y: auto; margin-top: 1rem;">
            <ul class="list-group">
                @forelse ($productosAgregados as $index => $producto)
                    <li
                        class="list-group-item d-flex justify-content-between align-items-center"
                        style="overflow: hidden; text-overflow: ellipsis;"
                    >
                        <div
                            class="d-flex flex-column"
                            style="flex: 1; min-width: 0;"
                        >
                            <!-- Primera línea: Nombre del producto (truncado con ellipsis) -->
                            <span
                                class="text-truncate"
                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                            >
                            {{ $producto['nombre'] }}
                        </span>
                            <!-- Segunda línea: Detalles (cantidad x precio) -->
                            <small class="text-muted">
                                {{ $producto['cantidad'] }} x
                                @if ($esEstudiante)
                                    ${{ number_format($producto['precio_lista'], 2) }}
                                @else
                                    ${{ number_format($producto['precio_venta'], 2) }}
                                @endif
                            </small>
                        </div>
                        <!-- Badge para el total -->
                        <div class="d-flex align-items-center">
                        <span
                            class="badge @if ($esEstudiante) bg-success @else bg-primary @endif rounded-pill me-3"
                        >
                            ${{ number_format($producto['cantidad'] * ($esEstudiante ? $producto['precio_lista'] : $producto['precio_venta']), 2) }}
                        </span>
                            <!-- Botón para eliminar el producto -->
                            <button
                                class="btn btn-sm btn-danger"
                                wire:click="eliminarProducto({{ $index }})"
                            >
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">
                        No hay productos agregados.
                    </li>
                @endforelse
            </ul>
        </div>

        <!-- Total y botones de acción -->
        <div class="row mt-3">
            <div class="col-6">
                <button class="btn btn-outline-danger w-100" wire:click="limpiarVenta">
                    Limpiar Venta
                </button>
            </div>
            <div class="col-6 text-end">
            <span
                class="badge @if ($esEstudiante) bg-success @else bg-primary @endif rounded-pill"
                style="font-size: 1rem;"
            >
                Total: ${{ number_format($this->calcularTotal(), 2) }}
            </span>
            </div>
        </div>

        <button class="btn btn-success mt-3 w-100" wire:click="confirmarVenta">
            Confirmar Venta
        </button>

        <div class="text-end mt-2">
            <small class="text-muted">
                Descuento:
                <span class="fw-bold">
                ${{ number_format($this->calcularTotalDescuento(), 2) }}
            </span>
            </small>
        </div>
    </div>


    <!-- Main content -->
    <div style="flex: 1; padding: 1rem; overflow-y: auto;">
        <h5 class="mb-3">Catálogo de Productos <small class="text-muted">Filtrado por: {{ $query }}</small></h5>
        <div class="mb-3">
            <label for="queryProductos" class="form-label">Filtros de búsqueda</label>
            <div class="row g-3 align-items-end">
                <!-- Input para buscar por nombre -->
                <div class="col-md-4">
                    <div>
                        <input
                            type="text"
                            id="queryProductos"
                            class="form-control"
                            placeholder="Buscar por nombre..."
                            wire:model.live.debounce.200ms="queryProductos"
                        >
                        <small class="form-text text-muted">Escribe el nombre del producto que deseas buscar.</small>
                    </div>
                </div>

                <!-- Select para filtrar por proveedor -->
                <div class="col-md-4">
                    <div>
                        <select
                            id="proveedorSeleccionado"
                            class="form-select"
                            wire:model.live="proveedorSeleccionado"
                        >
                            <option value="">Todos los proveedores</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_empresa }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Selecciona un proveedor para filtrar los productos.</small>
                    </div>
                </div>

                <!-- Select para filtrar por categoría -->
                <div class="col-md-4">
                    <div>
                        <select
                            id="categoriaSeleccionada"
                            class="form-select"
                            wire:model.live="categoriaSeleccionada"
                        >
                            <option value="">Todas las categorías</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Selecciona una categoría para filtrar los productos.</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach ($productos as $producto)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $producto->main_photo }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text text-muted">Precio Lista: ${{ number_format($producto->precio_lista, 2) }}</p>
                            <p class="card-text text-muted">Precio Proveedor: ${{ number_format($producto->precio_proveedor, 2) }}</p>
                            <p class="card-text text-muted">Precio Venta: ${{ number_format($producto->precio_venta, 2) }}</p>

                            <p class="card-text text-muted">Stock: {{ $producto->stock }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <input
                                    type="number"
                                    class="form-control form-control-sm me-2"
                                    style="width: 70px;"
                                    min="1"
                                    max="{{ $producto->stock }}"
                                    wire:model="cantidades.{{ $producto->id }}"
                                    wire:change="validarCantidad({{ $producto->id }})">
                                <button
                                    id="agregar-btn-{{ $producto->id }}"
                                    class="btn btn-primary btn-sm position-relative"
                                    wire:click="agregarProducto({{ $producto->id }})">
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Livewire.on('alerta-stock', event => {
            Swal.fire({
                icon: 'warning',
                title: 'Has alcanzado el limite de stock en este producto',
                text: event.mensaje,
                confirmButtonText: 'Entendido'
            });
        });
    });
</script>
