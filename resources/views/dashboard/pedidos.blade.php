<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <h2 class="mb-4">Pedidos</h2>

    <form action="{{ route('dashboard.pedidos') }}" method="GET">
        <div class="row mb-4">
            <div class="col-md-3">
                <input type="text" name="search" id="searchInput" class="form-control" placeholder="Buscar Pedido..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="estado" id="statusFilter" class="form-select">
                    <option value="">Filtrar por Estado</option>
                    <option value="entregado" {{ request('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
                    <option value="listo para entrega" {{ request('estado') == 'listo para entrega' ? 'selected' : '' }}>Listo para Entrega</option>
                    <option value="preparando para entrega" {{ request('estado') == 'preparando para entrega' ? 'selected' : '' }}>Preparando para Entrega</option>
                </select>
            </div>
            <div class="col-md-6 d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('dashboard.pedidos') }}" class="btn btn-secondary ms-2">Limpiar Filtro</a>
            </div>
        </div>
    </form>




        <!-- Card Layout for Pedidos -->
        <div class="row" id="pedidosContainer">
            @foreach ($pedidos as $pedido)
                <div class="col-12 col-md-3 mb-4 pedido-card" style="height: 220px; display: flex; flex-direction: column; border: 1px solid #e0e0e0; border-radius: 8px; background-color: #f9f9f9; position: relative; padding: 10px;">
                    <!-- Card Header: Pedido Info -->
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #6c5ce7; color: #fff; padding: 10px;">
                        <span>Pedido #{{ $pedido->id }}</span>
                    </div>

                    <!-- Floating Badge for Estado -->
                    <span class="badge" style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); padding: 7px 15px; font-size: 0.8rem;
    @if ($pedido->estado == 'entregado')
        background-color: #2ecc71; color: white;
    @elseif ($pedido->estado == 'listo para entrega')
        background-color: #3498db; color: white;
    @elseif ($pedido->estado == 'preparando para entrega')
        background-color: #f39c12; color: white;
    @else
        background-color: #95a5a6; color: white;
    @endif">
    {{ ucfirst($pedido->estado) }}
</span>


                    <!-- Card Body: Basic Info -->
                    <div class="card-body d-flex flex-column" style="padding: 10px;">
                        <h5 class="card-title" style="font-size: 1rem;">Total: ${{ number_format($pedido->total, 2) }}</h5>
                        <p><strong>Fecha de Pedido:</strong> {{ $pedido->fecha_pedido }}</p>
                        <button class="btn btn-outline-primary mt-auto" data-bs-toggle="modal" data-bs-target="#detalleModal{{ $pedido->id }}">
                            Ver Detalles
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $pedidos->links('pagination::bootstrap-5')}}
        </div>

        @foreach ($pedidos as $pedido)
            <div class="modal fade" id="detalleModal{{ $pedido->id }}" tabindex="-1" aria-labelledby="detalleModalLabel{{ $pedido->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detalleModalLabel{{ $pedido->id }}">Detalle del Pedido #{{ $pedido->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
                                </div>
                                <div class="col-12">
                                    <p><strong>Fecha de Pedido:</strong> {{ $pedido->fecha_pedido }}</p>
                                </div>
                                <div class="col-12">
                                    <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
                                </div>
                                <div class="col-12">
                                    <p><strong>Clave de Entrega:</strong> {{ $pedido->clave_entrega }}</p>
                                </div>
                            </div>

                            <!-- Estudiante Details -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h6>Estudiante:</h6>
                                    @if ($pedido->estudiante)
                                        <div class="row">
                                            <div class="col-6">
                                                <p><strong>Matricula:</strong> {{ $pedido->estudiante->matricula }}</p>
                                                <p><strong>Estado:</strong> {{ $pedido->estudiante->estado }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p><strong>Grado de Estudio:</strong> {{ $pedido->estudiante->grado_estudio }}</p>
                                                <p><strong>Dirección:</strong> {{ $pedido->estudiante->calle }}, {{ $pedido->estudiante->num_ext }} {{ $pedido->estudiante->colonia }}, {{ $pedido->estudiante->zipcode }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <p>No hay estudiante asociado a este pedido.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Pedido Details with Scroll -->
                            <h6 class="mb-3">Detalles del Pedido:</h6>
                            <div style="max-height: 300px; overflow-y: auto;">
                                <ul class="list-group">
                                    @foreach ($pedido->detalles as $detalle)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-8">
                                                    <strong>{{ $detalle->producto->nombre }}</strong>
                                                    <br>Cantidad: {{ $detalle->cantidad }}
                                                </div>
                                                <div class="col-4 text-end">
                                                    <p>Precio Aplicado: ${{ number_format($detalle->precio_aplicado, 2) }}</p>
                                                    <p>Descuento: ${{ number_format($detalle->descuento, 2) }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <!-- Form for marking as ready for delivery -->
                            @if ($pedido->estado == 'preparando para entrega')
                                <form action="{{ route('pedido.marcarListo', $pedido->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Marcar como Listo para Entrega</button>
                                </form>
                            @endif

                            <!-- Form for marking as delivered -->
                            @if ($pedido->estado == 'listo para entrega')
                                <form action="{{ route('pedido.marcarEntregado', $pedido->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <!-- Input for the name of the person collecting the order -->
                                    <div class="mt-3 d-flex align-items-center">
                                        <label for="nombreRecogido{{ $pedido->id }}" class="form-label me-2"><strong>Nombre de quien recoge:</strong></label>
                                        <input type="text" id="nombreRecogido{{ $pedido->id }}" name="nombreRecogido" class="form-control me-2" placeholder="Ingrese el nombre">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                                    </div>
                                </form>
                            @endif

                            <!-- Show collector name when delivered -->
                            @if ($pedido->estado == 'entregado')
                                <div class="mt-3">
                                    <label for="nombreRecogido{{ $pedido->id }}" class="form-label"><strong>Nombre de quien entregó:</strong></label>
                                    <input type="text" id="nombreRecogido{{ $pedido->id }}" class="form-control" value="{{ $pedido->entrega->nombre_recolector }}" readonly>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
@endforeach
