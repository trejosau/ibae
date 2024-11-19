<div class="d-flex" style="height: 100vh;">
    <!-- Sidebar -->
    <div class="p-3 bg-light border-end" style="width: 300px;">
        <h5>Detalles del Comprador</h5>

        <!-- Nombre del Comprador -->
        <div class="mb-3">
            <label for="nombreComprador" class="form-label">Nombre del Comprador</label>
            <input type="text" id="nombreComprador" class="form-control" wire:model="nombreComprador">
        </div>

        <!-- Checkbox: ¿Es estudiante? -->
        <div class="mb-3 form-check">
            <input type="checkbox" id="esEstudiante" class="form-check-input" wire:model="esEstudiante">
            <label for="esEstudiante" class="form-check-label">¿Es estudiante?</label>
        </div>

        <!-- Campo de Matrícula (oculto si no es estudiante) -->
        @if($esEstudiante)
            <div class="mb-3">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="text" id="matricula" class="form-control" wire:model="matricula">
            </div>
        @endif

        <hr>
        <h5>Resumen de Venta</h5>

        <!-- Resumen Dinámico de Productos -->
        <div>
            @forelse($items as $index => $item)
                <div class="border rounded mb-2 p-2">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $item['nombre'] }}</strong>
                        <button class="btn btn-sm btn-danger" wire:click="eliminarProducto({{ $index }})">Eliminar</button>
                    </div>
                    <p class="mb-1">
                        Precio Lista:
                        <span @class(['text-muted' => !$esEstudiante])>
                            ${{ number_format($item['precio_lista'], 2) }}
                        </span>
                        <br>
                        Precio Venta:
                        <span @class(['text-muted' => $esEstudiante])>
                            ${{ number_format($item['precio_venta'], 2) }}
                        </span>
                    </p>
                    <p class="mb-1">Cantidad: {{ $item['cantidad'] }}</p>
                </div>
            @empty
                <p class="text-muted">El carrito está vacío.</p>
            @endforelse
        </div>

        <hr>
        <!-- Total -->
        <div class="text-end">
            <h5>Total: ${{ number_format($total, 2) }}</h5>
        </div>

        <!-- Botones de Acción -->
        <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-secondary" wire:click="limpiarCarrito">Limpiar</button>
            <button class="btn btn-primary" wire:click="realizarVenta">Realizar Venta</button>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="flex-grow-1 p-4">
        <h4>Catálogo de Productos</h4>
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto['nombre'] }}</h5>
                            <p class="card-text">
                                Precio Lista: ${{ number_format($producto['precio_lista'], 2) }} <br>
                                Precio Venta: ${{ number_format($producto['precio_venta'], 2) }}
                            </p>
                            <button class="btn btn-success" wire:click="agregarProducto({{ $producto['id'] }})">
                                Agregar al Resumen
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
