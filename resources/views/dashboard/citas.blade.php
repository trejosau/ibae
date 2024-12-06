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
                                    <td>{{ $cita->comprador->persona->nombre ?? 'No asignado' }}</td>
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
                        <li class="list-group-item"><strong>Cliente:</strong> {{ $cita->cliente->nombre ?? 'Sin asignar' }}</li>
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
                    <!-- Comprador -->
                    <div class="mb-3">
                        <label for="comprador_id" class="form-label">ID Comprador</label>
                        <input type="number" class="form-control" id="comprador_id" name="comprador_id" required>
                    </div>
                    
                    <!-- Estilista -->
                    <div class="mb-3">
                        <label for="estilista_id" class="form-label">ID Estilista</label>
                        <input type="number" class="form-control" id="estilista_id" name="estilista_id" required>
                    </div>

                    <!-- Fecha y hora de inicio de la cita -->
                    <div class="mb-3">
                        <label for="fecha_hora_inicio_cita" class="form-label">Fecha y Hora de Inicio</label>
                        <input type="datetime-local" class="form-control" id="fecha_hora_inicio_cita" name="fecha_hora_inicio_cita" required>
                    </div>

                    <!-- Fecha y hora de fin de la cita -->
                    <div class="mb-3">
                        <label for="fecha_hora_fin_cita" class="form-label">Fecha y Hora de Fin</label>
                        <input type="datetime-local" class="form-control" id="fecha_hora_fin_cita" name="fecha_hora_fin_cita" required>
                    </div>

                    <!-- Total -->
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control" id="total" name="total" step="0.01" required>
                    </div>

                    <!-- Anticipo -->
                    <div class="mb-3">
                        <label for="anticipo" class="form-label">Anticipo</label>
                        <input type="number" class="form-control" id="anticipo" name="anticipo" step="0.01" required>
                    </div>

                    <!-- Pago restante -->
                    <div class="mb-3">
                        <label for="pago_restante" class="form-label">Pago Restante</label>
                        <input type="number" class="form-control" id="pago_restante" name="pago_restante" required>
                    </div>

                    <!-- Estado de pago -->
                    <div class="mb-3">
                        <label for="estado_pago" class="form-label">Estado de Pago</label>
                        <select class="form-control" id="estado_pago" name="estado_pago" required>
                            <option value="pendiente">concluido</option>
                            <option value="pagado">anticipo</option>
                        </select>
                    </div>

                    <!-- Estado de la cita -->
                    <div class="mb-3">
                        <label for="estado_cita" class="form-label">Estado de la Cita</label>
                        <select class="form-control" id="estado_cita" name="estado_cita" required>
                            <option value="programada">Programada</option>
                            <option value="cancelada">Cancelada</option>
                            <option value="completada">Completada</option>
                        </select>
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


    
</div>
