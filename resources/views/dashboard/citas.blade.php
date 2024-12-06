<div class="citas-section">
    <h2 class="text-center mb-4">Sección de Citas</h2>

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-6">
            <div class="input-group">
                <label class="input-group-text" for="filtro-fecha">Filtrar por Fecha</label>
                <input type="date" class="form-control" id="filtro-fecha">
            </div>
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
                                    <td>{{ \Carbon\Carbon::parse($cita->fecha_hora_inicio_cita)->format('Y-m-d') }}</td> 
                                    <td>{{ \Carbon\Carbon::parse($cita->fecha_hora_inicio_cita)->format('H:i:s') }}</td> 
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
    </div>
    

    <!-- Modal para Ver Detalle de Cita -->
    @foreach ($citas as $cita)
    <div class="modal fade" id="modal-ver-detalle-{{ $cita->id }}" tabindex="-1" aria-labelledby="modal-ver-detalle-label-{{ $cita->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-ver-detalle-label-{{ $cita->id }}">Detalle de la Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Cliente:</strong>   {{ $cita->comprador->persona->nombre ?? $cita->cliente ?? 'No asignado' }}</li>
                        <li class="list-group-item"><strong>Fecha:</strong> {{ $cita->fecha }}</li>
                        <li class="list-group-item"><strong>Hora:</strong> {{ $cita->hora }}</li>
                        <li class="list-group-item"><strong>Estado:</strong> {{ $cita->estado ?? 'Pendiente' }}</li>
                    </ul>
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

                    <div class="mb-3">
                        <label for="estilista_id" class="form-label">Estilista</label>
                        <select class="form-control" id="estilista_id" name="estilista_id" required>
                            <option value="">Seleccione un Estilista</option>
                            @foreach ($estilistas as $estilista)
                                <option value="{{ $estilista->id }}">{{ $estilista->persona->nombre ?? 'No asignado' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_hora_inicio_cita" class="form-label">Fecha y Hora de Inicio</label>
                        <input type="datetime-local" class="form-control" id="fecha_hora_inicio_cita" name="fecha_hora_inicio_cita" required>
                    </div>

                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control" id="total" name="total" step="0.01" required>
                    </div>

                    <div class="mb-3" id="servicios-container">
                        <label for="servicios" class="form-label">Servicios</label>
                        <div class="input-group mb-2">
                            <select class="form-control" name="servicios[]" required>
                                <option value="">Seleccione un servicio</option>
                                @foreach ($servicios as $servicio)
                                    <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-secondary" onclick="agregarServicio()">+</button>
                        </div>
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
    function agregarServicio() {
        const container = document.getElementById('servicios-container');
        const newSelect = `
            <div class="input-group mb-2">
                <select class="form-control" name="servicios[]" required>
                    <option value="">Seleccione un servicio</option>
                    @foreach ($servicios as $servicio)
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-danger" onclick="eliminarServicio(this)">-</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newSelect);
    }

    function eliminarServicio(button) {
        button.parentElement.remove();
    }
</script>


</div>
