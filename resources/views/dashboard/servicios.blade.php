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

                    <!-- Contenedor para hacer la tabla responsiva con scroll horizontal -->
                    <div class="table-responsive">
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
                                        <button
                                            class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditarServicio{{ $servicio->id }}">
                                            Modificar
                                        </button>
                                     <!-- Botón que abre el modal -->
                                    @if ($servicio->estado == 'activo')
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $servicio->id }}">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-start mt-3">
                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modal-agregar-servicio">
                            <i class="fas fa-plus-circle"></i>
                            <span class="d-none d-sm-inline"> Agregar Servicio</span> <!-- Mostrar texto solo en pantallas grandes -->
                        </button>

                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-agregar-categoria">
                            <i class="fas fa-plus-circle"></i>
                            <span class="d-none d-sm-inline"> Agregar Categoria</span> <!-- Mostrar texto solo en pantallas grandes -->
                        </button>
                    </div>

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
                            <input type="number" class="form-control" id="precio" name="precio" required maxlength="9999">
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
                            <input type="number" class="form-control" id="duracion_minima" name="duracion_minima" required min="1" maxlength="9999">
                        </div>

                        <div class="mb-3">
                            <label for="duracion_maxima" class="form-label">Duración máxima</label>
                            <input type="number" class="form-control" id="duracion_maxima" name="duracion_maxima" required min="1" maxlength="9999">
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

    <!-- Modal para Agregar Categoría -->
    <div class="modal fade" id="modal-agregar-categoria" tabindex="-1" aria-labelledby="modal-agregar-categoria-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-agregar-categoria-label">Agregar Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('servicios.agregarCategoria') }}">
                        @csrf  <!-- Token CSRF para protección -->

                        <div class="mb-3">
                            <label for="nombre-categoria" class="form-label">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="nombre-categoria" name="nombre" required>
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

    @foreach ($servicios as $servicio)
<div class="modal fade" id="modalEditarServicio{{ $servicio->id }}" tabindex="-1" aria-labelledby="modalEditarServicioLabel{{ $servicio->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('servicios.update', $servicio->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarServicioLabel{{ $servicio->id }}">Modificar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre{{ $servicio->id }}" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre{{ $servicio->id }}" name="nombre" value="{{ $servicio->nombre }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoria{{ $servicio->id }}" class="form-label">Categoría</label>
                        <select class="form-select" id="categoria{{ $servicio->id }}" name="categoria" required>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ $servicio->categoria == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="mb-3">
                        <label for="descripcion{{ $servicio->id }}" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion{{ $servicio->id }}" name="descripcion" required>{{ $servicio->descripcion }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="duracion_minima{{ $servicio->id }}" class="form-label">Duración mínima</label>
                        <input type="number" min="1" max="9999" class="form-control" id="duracion_minima{{ $servicio->id }}" name="duracion_minima" value="{{ $servicio->duracion_minima }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="duracion_maxima{{ $servicio->id }}" class="form-label">Duración máxima</label>
                        <input type="number" min="1" max="9999" class="form-control" id="duracion_maxima{{ $servicio->id }}" name="duracion_maxima" value="{{ $servicio->duracion_maxima }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio{{ $servicio->id }}" class="form-label">Precio</label>
                        <input type="number" min="1" max="9999" class="form-control" id="precio{{ $servicio->id }}" name="precio" value="{{ $servicio->precio }}" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado{{ $servicio->id }}" class="form-label">Estado</label>
                        <select class="form-select" id="estado{{ $servicio->id }}" name="estado" required>
                            <option value="activo" {{ $servicio->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ $servicio->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($servicios as $servicio)
    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmDeleteModal-{{ $servicio->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel-{{ $servicio->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $servicio->id }}">Confirmar Acción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas inactivar el servicio "{{ $servicio->nombre }}"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="{{ route('servicios.updateEstado', $servicio->id) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach



</div>
