<div class="container py-5">
    <!-- Filtro de categorías -->
    <div class="mb-4 text-center">
        <select wire:model="categoriaSeleccionada" wire:change="actualizarProductos" class="form-select w-50 d-inline-block shadow" style="max-width: 400px; border-color: #d4d4d4;">
            <option value="">Todas las categorías</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>

    <!-- Filtros adicionales -->
    <div class="row mb-4">
        <!-- Filtro por precio -->
        <div class="col-md-4">
            <input wire:model="precioMin" wire:change="actualizarProductos" type="number" class="form-control" placeholder="Precio mínimo" min="0">
        </div>
        <div class="col-md-4">
            <input wire:model="precioMax" wire:change="actualizarProductos" type="number" class="form-control" placeholder="Precio máximo" min="0">
        </div>
        <!-- Filtro por disponibilidad -->
        <div class="col-md-4">
            <select wire:model="disponibilidad" wire:change="actualizarProductos" class="form-select">
                <option value="">Disponibilidad</option>
                <option value="1">En stock</option>
                <option value="0">Agotado</option>
            </select>
        </div>
    </div>

    <!-- Listado de productos -->
    <div class="row g-4">
        @foreach($productos as $producto)
            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
                <div class="card h-100 w-100 shadow border-0" style="background-color: #f9f9f9; border-radius: 10px;">
                    <!-- Foto del producto -->
                    <div class="ratio ratio-1x1" style="border-top-left-radius: 10px; border-top-right-radius: 10px; overflow: hidden;">
                        <img src="{{ $producto->main_photo }}" alt="{{ $producto->nombre }}" class="card-img-top" style="object-fit: cover;">
                    </div>

                    <!-- Detalles del producto -->
                    <div class="card-body d-flex flex-column p-3">
                        <h5 class="card-title text-truncate text-dark" style="font-weight: 600;">{{ $producto->nombre }}</h5>
                        <p class="card-text text-muted text-truncate mb-2" style="font-size: 0.9rem;">
                            {{ Str::limit($producto->descripcion, 80) }}
                        </p>
                        <p class="fw-bold mb-1 text-primary" style="font-size: 1.1rem;">${{ number_format($producto->precio_venta, 2) }}</p>
                        <p class="mb-3" style="font-size: 0.9rem;">En stock:
                            <span class="badge {{ $producto->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $producto->stock ?? 'Sin stock' }}
                            </span>
                        </p>
                        <div class="mt-auto">
                            <button class="btn btn-primary btn-sm w-100 shadow-sm" style="border-radius: 20px;">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-5">
        {{ $productos->links('pagination::bootstrap-4') }}
    </div>
</div>
