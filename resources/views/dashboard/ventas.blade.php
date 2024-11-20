@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="z-index: 2000; position: relative;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="z-index: 2000; position: relative;">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" style="z-index: 2000; position: relative;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="ventas-section">

    <h2 class="text-center mb-4">Sección de Ventas</h2>


    <div class="row mb-4">
        <div class="col-12">
            <form action="{{ route('dashboard.ventas') }}" method="GET" class="p-3 bg-light rounded shadow-sm">
                <div class="row g-3 align-items-center">
                    <!-- Filtrar por Comprador -->
                    <div class="col-md-2">
                        <input type="text" name="comprador" class="form-control form-control-sm" placeholder="Comprador" value="{{ request('comprador') }}" style="min-width: 100%;">
                    </div>

                    <!-- Filtrar por Rango de Fechas -->
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">Desde</span>
                            <input type="date" name="fecha_inicio" class="form-control form-control-sm" value="{{ request('fecha_inicio') }}">
                            <span class="input-group-text">Hasta</span>
                            <input type="date" name="fecha_fin" class="form-control form-control-sm" value="{{ request('fecha_fin') }}">
                        </div>
                    </div>

                    <!-- Filtrar por Estudiante -->
                    <div class="col-md-2">
                        <select name="es_estudiante" class="form-select form-select-sm" style="min-width: 100%;">
                            <option value="">Estudiante?</option>
                            <option value="si" {{ request('es_estudiante') == 'si' ? 'selected' : '' }}>Sí</option>
                            <option value="no" {{ request('es_estudiante') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- Filtrar por Vendedor -->
                    <div class="col-md-2">
                        <input type="text" name="vendedor" class="form-control form-control-sm" placeholder="Vendedor" value="{{ request('vendedor') }}" style="min-width: 100%;">
                    </div>

                    <!-- Botón de Filtrar -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success btn-sm w-100" style="font-weight: bold;">
                            Filtrar <i class="fas fa-filter ms-1"></i>
                        </button>
                    </div>

                    <!-- Botón de Limpiar -->
                    <div class="col-md-2">
                        <a href="{{ route('dashboard.ventas') }}" class="btn btn-secondary btn-sm w-100" style="font-weight: bold;">
                            Limpiar <i class="fas fa-times ms-1"></i>
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>




    <!-- Tabla de Ventas Recientes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-success h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i> Ventas Recientes
                    </h5>

                    <table class="table table-bordered table-sm text-center">
                        <thead>
                        <tr>
                            <th>Comprador</th>
                            <th>Fecha</th>
                            <th>Total</th>

                            <th>Estudiante?</th>
                            <th>Vendedor</th>
                            <th>Acc.</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ventas as $venta)
                            <tr>
                                <td>{{ $venta->nombre_comprador }}</td>
                                <td>{{ $venta->fecha_compra }}</td>
                                <td>${{ $venta->total }}</td>
                                <td>{{ $venta->es_estudiante === 'si' ? 'Sí' : 'No' }}</td>
                                <td>
                                    @if($venta->administrador && $venta->administrador->persona)
                                        {{ $venta->administrador->persona->nombre }} {{ $venta->administrador->persona->apellido_pa }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <!-- Botón para abrir modal de detalles de la venta específica -->
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-detalle-venta-{{ $venta->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <!-- Botón para eliminar venta específica -->
                                    <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <!-- Paginación -->
                    <div class="d-flex justify-content-center">
                        {{ $ventas->links('pagination::bootstrap-5') }}
                    </div>

                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-agregar-venta">Agregar Venta</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal ver Venta -->
    @foreach($ventas as $venta)
        <div class="modal fade" id="modal-detalle-venta-{{ $venta->id }}" tabindex="-1" aria-labelledby="modal-detalle-venta-label-{{ $venta->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content h-100">
                    <div class="modal-header d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column text-end">
                            <div class="d-flex flex-wrap mb-0">
                                <p class="mb-1 me-2"><strong>Cliente:</strong> {{ $venta->nombre_comprador }}</p>
                                <p class="mb-1 me-2"><strong>Fecha:</strong> {{ $venta->fecha_compra }}</p>
                                <p class="mb-1 me-2"><strong>Estudiante?:</strong> {{ $venta->es_estudiante === 'si' ? 'Sí' : 'No' }}</p>
                                <p class="mb-1 me-2"><strong>Vendedor:</strong>
                                    @if($venta->administrador && $venta->administrador->persona)
                                        {{ $venta->administrador->persona->nombre }} {{ $venta->administrador->persona->apellido_pa }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                                <p class="mb-1"><strong>Matricula:</strong> {{ $venta->estudiante ? $venta->estudiante->matricula : 'N/A' }}</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                        <div class="row row-cols-5 g-3 overflow-auto" style="max-height: 60vh;">
                            @foreach($venta->detalles as $detalle)
                                @php
                                    $total = $detalle->precio_aplicado * $detalle->cantidad; // Calcular el total por detalle
                                @endphp
                                <div class="col">
                                    <div class="card text-center border-0 shadow-sm" style="width: 150px; height: 250px;">
                                        <div class="image-container" style="width: 100%; height: 100px; overflow: hidden;">
                                            <img src="{{ $detalle->producto->main_photo ?? 'https://picsum.photos/100' }}"
                                                 class="card-img-top rounded"
                                                 alt="{{ $detalle->producto->nombre ?? 'Producto no disponible' }}"
                                                 style="width: 100%; height: 100%; object-fit: contain;">
                                        </div>
                                        <div class="card-body p-1 d-flex flex-column justify-content-between" style="height: 150px;">
                                            <h6 class="card-title fw-semibold text-truncate"
                                                style="font-size: 1rem;"
                                                title="{{ $detalle->producto->nombre ?? 'Producto no disponible' }}">
                                                {{ $detalle->producto->nombre ?? 'Producto no disponible' }}
                                            </h6>
                                            <p class="card-text mb-1" style="font-size: 0.75rem;">
                                                Cantidad: {{ $detalle->cantidad }}
                                            </p>
                                            <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">
                                                Total: ${{ number_format($total, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>



                    <div class="modal-footer justify-content-center">
                        <span class="fw-bold" style="font-size: 1.2rem;">Total: ${{ number_format($venta->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



    <!-- Modal Agregar Venta -->
<div class="modal fade" id="modal-agregar-venta" tabindex="-1" aria-labelledby="modalAgregarVentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarVentaLabel">Agregar Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <livewire:ventas-modal />
            </div>

        </div>
    </div>
</div>








