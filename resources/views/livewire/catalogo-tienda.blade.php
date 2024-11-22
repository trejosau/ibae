<div class="container py-5">
    <!-- Enlace Volver a la tienda -->
    <div class="mb-3">
        <a href="/tienda" class="back-link">← Volver a la tienda</a>
    </div>

    <div class="row">
        <!-- Filtros -->
        <div class="col-md-3">
            <!-- Barra de búsqueda -->
            <div class="mb-4">
                <label for="busqueda" class="form-label">Buscar productos</label>
                <input id="busqueda" 
                       wire:model.live="busqueda" 
                       type="text" 
                       class="form-control" 
                       placeholder="Buscar por nombre o descripción">
            </div>

            <!-- Categorías -->
            <div class="mb-4">
                <label for="categoriaFiltro" class="form-label">Categorías</label>
                <select id="categoriaFiltro" wire:model.live="categoriaSeleccionada" class="form-select shadow">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Precio -->
            <div class="mb-4">
                <label for="precioMin" class="form-label">Precio mínimo</label>
                <input id="precioMin" wire:model.live.debounce="precioMin" type="number" class="form-control mb-2" placeholder="Mínimo" min="0">
                
                <label for="precioMax" class="form-label">Precio máximo</label>
                <input id="precioMax" wire:model.live.debounce="precioMax" type="number" class="form-control" placeholder="Máximo" min="0">
            </div>

            <!-- Disponibilidad -->
            <div class="mb-4">
                <label for="disponibilidad" class="form-label">Disponibilidad</label>
                <select id="disponibilidad" wire:model="disponibilidad" class="form-select">
                    <option value="">Todas</option>
                    <option value="1">En stock</option>
                    <option value="0">Agotado</option>
                </select>
            </div>

            <!-- Ordenar -->
            <div>
                <label for="ordenarPor" class="form-label">Ordenar por</label>
                <select id="ordenarPor" wire:model="ordenarPor" class="form-select">
                    <option value="">Selecciona</option>
                    <option value="mas_nuevo">Más nuevo</option>
                    <option value="mas_vendido">Más vendido</option>
                    <option value="precio_mas_alto">Precio más alto</option>
                    <option value="precio_mas_bajo">Precio más bajo</option>
                </select>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-9">
            <div class="row g-4">
                @forelse($productos as $producto)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow border-0" style="background-color: #f9f9f9; border-radius: 10px;">
                            <div class="ratio ratio-1x1" style="overflow: hidden; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <img src="{{ $producto->main_photo }}" alt="{{ $producto->nombre }}" class="card-img-top" style="object-fit: cover;">
                            </div>
                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="card-title text-truncate text-dark">{{ $producto->nombre }}</h5>
                                <p class="card-text text-muted text-truncate">{{ Str::limit($producto->descripcion, 80) }}</p>
                                <p class="fw-bold text-primary">${{ number_format($producto->precio_venta, 2) }}</p>
                                <p>En stock:
                                    <span class="badge {{ $producto->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $producto->stock }}
                                    </span>
                                </p>
                                <div class="mt-auto">
                                    <button type="button" class="btn btn-primary btn-lg fw-bold mt-3"
                                            aria-label="Agregar {{ $producto->nombre }} al carrito"
                                            wire:click="agregarAlCarrito({{ $producto->id }})">
                                        <i class="fas fa-shopping-cart"></i> Agregar al carrito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            No se encontraron productos para los filtros seleccionados.
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center mt-5">
                {{ $productos->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
