<div class="servicios-section">
    <!-- Filtro de Búsqueda y Estado -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Buscar servicio...">
        </div>
        <div class="col-md-6">
            <select class="form-select">
                <option value="todos">Todos</option>
                <option value="activo">Activos</option>
                <option value="inactivo">Inactivos</option>
            </select>
        </div>
    </div>

    <!-- Servicios Activos -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-success h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-cut fa-2x text-success"></i> Servicios Disponibles
                    </h5>
                    <table class="table table-bordered text-center table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Categoria</th>
                            <th>Descripción</th>
                            <th>Duración minima</th>
                            <th>Duración máxima</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($servicios as $servicio)
                            <tr>
                                <td>{{ $servicio->nombre }}</td>
                                <td>{{ $servicio->Categoria->nombre }}</td>
                                <td>{{ $servicio->descripcion }}</td>
                                <td>{{ $servicio->duracion_minima }} minutos</td>
                                <td>{{ $servicio->duracion_maxima }} minutos</td>
                                <td>{{ $servicio->precio }}</td>
                                <td>
                                    @if($servicio->estado == 'activo')
                                        <span class="badge" style="background-color: #a8e6cf; color: #2d6a4f;">Activo</span>
                                    @elseif($servicio->estado == 'inactivo')
                                        <span class="badge" style="background-color: #ffe156; color: #d3a300;">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-servicio-{{ $servicio->id }}">
                                        <i class="fas fa-edit"></i> Modificar
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar-servicio">
                        <i class="fas fa-plus-circle"></i> Agregar Servicio
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Servicio -->
    <div class="modal fade" id="modal-agregar-servicio" tabindex="-1" aria-labelledby="modal-agregar-servicio-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-agregar-servicio-label">Agregar Nuevo Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('servicios.agregar') }}">
                        @csrf  <!-- Token CSRF para protección -->

                        <div class="mb-3">
                            <label for="nombre-servicio" class="form-label">Nombre del Servicio</label>
                            <input type="text" class="form-control" id="nombre-servicio" name="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" required>
                        </div>

                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value="">Selecciona una categoría...</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea maxlength="99" class="form-control" id="descripcion" name="descripcion" required style="overflow:hidden;" oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'; document.getElementById('descripcion-counter').textContent = this.value.length + '/99';"></textarea>
                            <small id="descripcion-counter" class="form-text text-muted">0/99</small>
                        </div>

                        <div class="mb-3">
                            <label for="duracion_minima" class="form-label">Duración mínima</label>
                            <input type="number" class="form-control" id="duracion_minima" name="duracion_minima" required min="1">
                        </div>

                        <div class="mb-3">
                            <label for="duracion_maxima" class="form-label">Duración máxima</label>
                            <input type="number" class="form-control" id="duracion_maxima" name="duracion_maxima" required min="1">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


</div>
