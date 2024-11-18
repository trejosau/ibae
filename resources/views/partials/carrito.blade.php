@if (count($carrito) > 0)
    @foreach ($carrito as $productoId => $producto)
        <li class="list-group-item d-flex justify-content-between align-items-center p-1" id="producto-{{ $productoId }}">
            <span>{{ $producto['nombre'] }}: {{ $producto['cantidad'] }}</span>
            <span class="badge bg-primary rounded-pill">${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</span>
            <button type="button" class="btn btn-outline-danger btn-sm ms-2 btn-quitar-producto" data-producto-id="{{ $productoId }}">Eliminar</button>
        </li>
    @endforeach
@else
    <li class="list-group-item text-center">No hay productos</li>
@endif
