<div class="d-flex" style="height: 100%;">
    <!-- Sidebar -->
    <div style="width: 300px; background-color: #f8f9fa; padding: 1rem; overflow-y: none; border-right: 1px solid #dee2e6;">
        <h5 class="mb-3">Resumen de Venta</h5>
        <div>
            <label for="comprador">Comprador:</label>
            <input type="text" id="comprador" class="form-control mb-3" placeholder="Ingrese el nombre del comprador" wire:model="comprador">
        </div>

        <div style="position: relative;" wire:ignore.self>
            <label for="esEstudiante">¿Es estudiante?:</label>
            <small class="form-text text-muted">Si estudiante, se le dará precio lista.</small>
            <input type="checkbox" id="esEstudiante" class="form-check-input mb-3" wire:model.live="esEstudiante">

            @if ($esEstudiante)
                <!-- Input para buscar matrícula -->
                <div>
                    <label for="matricula">Buscar matrícula:</label>
                    <input
                        type="text"
                        id="matricula"
                        class="form-control"
                        placeholder="Ingrese matrícula"
                        wire:model.live.debounce.200ms="matricula"
                        autocomplete="off"
                        wire:focus="abrirDropdown"
                    >
                </div>

                <!-- Dropdown con resultados -->
                @if ($mostrarDropdown)
                    <div
                        class="dropdown-menu show animate-dropdown"
                        style="position: absolute; top: 100%; left: 0; width: 100%; z-index: 1000; max-height: 250px; overflow-y: auto; list-style: none; padding: 0; margin: 0; border: 1px solid #dee2e6; border-radius: 0.25rem; background: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                    >
                        <!-- Header con el botón de cerrar -->
                        <div class="dropdown-header d-flex justify-content-between align-items-center"
                             style="padding: 0.5rem; font-weight: bold; background-color: #f1f1f1; border-bottom: 1px solid #dee2e6;">
                            <span>Resultados de búsqueda</span>
                            <button type="button" class="btn-close" aria-label="Cerrar" wire:click="cerrarDropdown"
                                    style="border: none; background: transparent; font-size: 1rem; cursor: pointer;">
                                ✖
                            </button>
                        </div>

                        <!-- Resultados -->
                        @if (!empty($resultados))
                            @foreach ($resultados as $resultado)
                                <div
                                    class="dropdown-item"
                                    style="padding: 0.5rem; cursor: pointer; transition: background-color 0.3s ease;"
                                    wire:click="selectMatricula('{{ $resultado['matricula'] }}')"
                                    onmouseover="this.style.backgroundColor='#f8f9fa';"
                                    onmouseout="this.style.backgroundColor='';"
                                >
                                    <strong>{{ $resultado['persona']['nombre'] }} {{ $resultado['persona']['ap_paterno'] }}</strong>
                                    - {{ $resultado['matricula'] }}
                                </div>
                            @endforeach
                        @else
                            <!-- Dropdown vacío -->
                            <p style="padding: 0.5rem; margin: 0;">No se encontraron estudiantes con esa matrícula.</p>
                        @endif
                    </div>
                @endif
            @endif
        </div>


        <div style="max-height: 150px; overflow-y: auto;">
            <ul class="list-group mt-3">
                @forelse ($productosAgregados as $index => $producto)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column" style="flex: 1; min-width: 0;">
                            <!-- Primera línea: Nombre del producto (truncado con ellipsis) -->
                            <span
                                class="text-truncate"
                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                title="{{ $producto['nombre'] }}">
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
                    <span class="badge
                        @if ($esEstudiante) bg-success @else bg-primary @endif
                        rounded-pill me-3">
                        ${{ number_format($producto['cantidad'] * ($esEstudiante ? $producto['precio_lista'] : $producto['precio_venta']), 2) }}
                    </span>
                            <!-- Botón para eliminar el producto -->
                            <button class="btn btn-sm btn-danger" wire:click="eliminarProducto({{ $index }})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No hay productos agregados.</li>
                @endforelse
            </ul>
        </div>


        <div class="row mt-3">
            <!-- Botón Limpiar Venta -->
            <div class="col-6">
                <button class="btn btn-outline-danger w-100" wire:click="limpiarVenta">Limpiar Venta</button>
            </div>

            <!-- Total -->
            <div class="col-6 text-end">
        <span class="badge
            @if ($esEstudiante)
                bg-success
            @else
                bg-primary
            @endif
            rounded-pill" style="font-size: 1rem;">
            Total: ${{ number_format($this->calcularTotal(), 2) }}
        </span>
            </div>
        </div>

        <!-- Descuento -->


        <!-- Botón Confirmar Venta -->
        <button class="btn btn-success mt-3 w-100" wire:click="confirmarVenta">Confirmar Venta</button>

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
        <h5 class="mb-3">Catálogo de Productos</h5>
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
