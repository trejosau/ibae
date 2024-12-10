<div class="citas-section">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

    <h2 class="text-center mb-4">Sección de Citas</h2>

   <!-- Formulario de búsqueda con filtros -->
<form method="GET" action="{{ route('dashboard.citas') }}" class="d-flex mb-4">
    <!-- Filtro por nombre del cliente -->
    <input
        type="text"
        class="form-control me-2"
        name="nombre"
        placeholder="Buscar por nombre"
        value="{{ request()->get('nombre') }}"
    >

    <!-- Filtro por fecha -->
    <input
        type="date"
        class="form-control me-2"
        name="fecha"
        value="{{ request()->get('fecha') }}"
    >

    <!-- Filtro por estado -->
    <select class="form-control me-2" name="estado">
        <option value="">Todos</option>
        <option value="programada" {{ request()->get('estado') == 'programada' ? 'selected' : '' }}>Programada</option>
        <option value="reprogramada" {{ request()->get('estado') == 'reprogramada' ? 'selected' : '' }}>Reprogramada</option>
        <option value="cancelada" {{ request()->get('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
        <option value="completada" {{ request()->get('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
    </select>

    <!-- Botón de búsqueda -->
    <button class="btn btn-outline-success" type="submit">Buscar</button>
</form>


    <!-- Botones para aplicar y limpiar filtros -->
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <a href="{{ route('dashboard.citas') }}" class="btn btn-secondary">Limpiar Filtros</a>
        </div>
    </div>



    <!-- Citas Recientes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-primary h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-list-alt fa-2x text-primary"></i> Citas Recientes
                    </h5>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Estilista</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th>Pago</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($citas as $cita)
                                <tr>
                                    <td>
                                        {{ $cita->comprador->persona->nombre ?? $cita->cliente ?? 'No asignado' }}
                                    </td>

                                    <td>{{ $cita->estilista->persona->nombre ?? 'No asignado' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($cita->fecha_hora_creacion)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($cita->fecha_hora_creacion)->format('H:i:s') }}</td>
                                    <td>
                                        <span class="badge" style="
                                            @if($cita->estado_cita == 'programada')
                                                background-color: blue; color: white;
                                            @elseif($cita->estado_cita == 'reprogramada')
                                                background-color: orange; color: white;
                                            @elseif($cita->estado_cita == 'cancelada')
                                                background-color: red; color: white;
                                            @elseif($cita->estado_cita == 'completada')
                                                background-color: green; color: white;
                                            @else
                                                background-color: gray; color: white;
                                            @endif">
                                            {{ ucfirst($cita->estado_cita) }}
                                        </span>
                                    </td>
                                    <td>{{ $cita->estado_pago }}</td>
                                    <td>
                                        <button
                                            class="btn btn-info btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal-ver-detalle-{{ $cita->id }}">
                                            Ver
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No hay citas disponibles.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar-cita">Agregar Cita</button>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $citas->links('pagination::bootstrap-5') }}
        </div>

    </div>

    @foreach ($citas as $cita)
    <div class="modal fade" id="modal-ver-detalle-{{ $cita->id }}" tabindex="-1" aria-labelledby="modalVerDetalleLabel-{{ $cita->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalVerDetalleLabel-{{ $cita->id }}">
                        Detalle de la Cita
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Información de Pago -->
                    <div class="mb-4 p-3 bg-light rounded border">
                        <h6 class="fw-bold text-primary">Información de Pago</h6>
                        <div class="row">
                            <div class="col-4">
                                <p><strong>Total:</strong> ${{ number_format($cita->total, 2) }}</p>
                            </div>
                            <div class="col-4">
                                <p><strong>Anticipo:</strong> ${{ number_format($cita->anticipo, 2) }}</p>
                            </div>
                            <div class="col-4">
                                <p><strong>Pago Restante:</strong> ${{ number_format($cita->pago_restante, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Servicios -->
                    <h6 class="fw-bold text-primary mb-3">Servicios</h6>
                    <div class="row">
                        @php
                            $totalServicios = 0;
                            $detalles = $detalleCitas->where('id_cita', $cita->id);
                        @endphp
                        @foreach ($detalles as $detalle)
                            @php
                                $servicio = $servicios->where('id', $detalle->id_servicio)->first();
                                $totalServicios += $servicio->precio;
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <div class="card mb-4 border-0 shadow">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary fw-bold">{{ $servicio->nombre }}</h5>
                                        <p class="card-text text-muted small">{{ $servicio->descripcion }}</p>
                                        <p class="card-text fw-bold text-success">Precio: ${{ number_format($servicio->precio, 2) }}</p>
                                    </div>
                                    <div class="card-footer bg-light">
                                        <small class="text-muted">Duración: {{ $servicio->duracion_minima }} - {{ $servicio->duracion_maxima }} mins</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <div class="w-100 text-end">
                        <h5 class="fw-bold text-primary">Total de Servicios: <span class="text-success">${{ number_format($totalServicios, 2) }}</span></h5>
                    </div>
                    @if($cita->estado_pago == 'anticipo')
                    <form action="{{ route('citas.concluirPago', $cita->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT') <!-- Usa PUT para actualizar el estado del pago -->
                        <button type="submit" class="btn btn-success">
                            Concluir Pago
                        </button>
                    </form>
                    @endif
                    @if($cita->estado_cita != 'completada' && $cita->estado_cita != 'cancelada')
                        <form action="{{ route('citas.completar', $cita->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary">
                                Completar Cita
                            </button>
                        </form>
                @endif
                    @if($cita->estado_cita != 'completada' && $cita->estado_cita != 'cancelada')
                        <form action="{{ route('citas.cancelar', $cita->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">
                                Cancelar Cita
                            </button>
                        </form>
                    @endif
                    @if($cita->estado_cita == 'cancelada')
                        <form action="{{ route('citas.revCancelar', $cita->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">
                                Revertor Cancelación
                            </button>
                        </form>
                    @endif
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach



    @foreach($citas as $cita)
    <!-- Modal Reprogramar -->
    <div class="modal fade" id="modal-reprogramar-{{ $cita->id }}" tabindex="-1" aria-labelledby="reprogramarModalLabel-{{ $cita->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reprogramarModalLabel-{{ $cita->id }}">Reprogramar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('citas.reprogramar', $cita->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Especifica el método PUT -->
                        <div class="mb-3">
                            <label for="fecha-{{ $cita->id }}" class="form-label">Nueva Fecha</label>
                            <input type="date" id="fecha-{{ $cita->id }}" name="fecha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora-{{ $cita->id }}" class="form-label">Nueva Hora</label>
                            <input type="time" id="hora-{{ $cita->id }}" name="hora" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach



<!-- Modal para registrar cita -->
<div class="modal fade" id="modal-agregar-cita" tabindex="-1" aria-labelledby="modalRegistrarCitaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistrarCitaLabel">Registrar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('salon.registrarCita') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cliente" class="form-label">Nombre del Cliente</label>
                        <input type="text" class="form-control" id="cliente" name="cliente" required>
                    </div>

                    <!-- Estilista -->
                    <div class="mb-3">
                        <label for="estilista_id" class="form-label">Estilista</label>
                        <select class="form-control" id="estilista_id" name="estilista_id" required>
                            <option value="">Seleccione un Estilista</option>
                            @foreach ($estilistas as $estilista)
                                <option value="{{ $estilista->id }}">{{ $estilista->persona->nombre ?? 'No asignado' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Fecha y hora de inicio de la cita -->
                    <div class="mb-3">
                        <label for="fecha_hora_inicio_cita" class="form-label">Fecha y Hora de Inicio</label>
                        <input type="datetime-local" class="form-control" id="fecha_hora_inicio_cita" name="fecha_hora_inicio_cita" required step="3600">
                    </div>


                    <!-- Servicios -->
                    <div class="mb-3">
                        <label class="form-label">Servicios</label>
                        <div id="servicios-container">
                            <!-- Aquí se agregarán dinámicamente los selects de servicios -->
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="agregar-servicio">Agregar Servicio</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cita</button>
                </div>
            </form>
        </div>
    </div>




</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serviciosContainer = document.getElementById('servicios-container');
        const agregarServicioBtn = document.getElementById('agregar-servicio');
        const totalCalculado = document.getElementById('total_calculado');

        const actualizarTotal = () => {
            let total = 0;
            serviciosContainer.querySelectorAll('select[name="servicios[]"]').forEach(select => {
                const option = select.selectedOptions[0];
                if (option && option.dataset.precio) {
                    total += parseFloat(option.dataset.precio);
                }
            });
            totalCalculado.value = `$${total.toFixed(2)}`;
        };

        agregarServicioBtn.addEventListener('click', () => {
            const servicioSelect = `
                <div class="mb-2 d-flex align-items-center">
                    <select class="form-control me-2" name="servicios[]" required onchange="actualizarTotal()">
                        <option value="" data-precio="0">Seleccione un Servicio</option>
                        @foreach ($servicios as $servicio)
                            <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}">{{ $servicio->nombre }} (${{ number_format($servicio->precio, 2) }})</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger btn-sm remove-servicio">X</button>
                </div>`;
            serviciosContainer.insertAdjacentHTML('beforeend', servicioSelect);
            actualizarTotal();
        });

        serviciosContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-servicio')) {
                e.target.parentElement.remove();
                actualizarTotal();
            }
        });
    });
</script>


</div>
