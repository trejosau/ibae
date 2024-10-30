<div class="container">
    <h4 class="text-primary titulo">Cursos</h4>

    <!-- Botón para abrir la modal de creación -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Agregar Curso
    </button>

    <!-- Modal de Creación -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Agregar Nuevo Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('cursos.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Curso</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                            @error('descripcion')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="duracion_semanas" class="form-label">Duración (semanas)</label>
                            <input type="number" class="form-control" id="duracion_semanas" name="duracion_semanas" required>
                            @error('duracion_semanas')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Agregar Curso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($cursos as $curso)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $curso->nombre }}</h5>
                        <p class="card-text">{{ $curso->descripcion }}</p>
                        <p class="card-text">Duración: {{ $curso->duracion_semanas }} semanas</p>

                        <!-- Botón para abrir la modal de edición -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $curso->id }}">
                            Editar
                        </button>

                        <!-- Modal de Edición -->
                        <div class="modal fade" id="editModal{{ $curso->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $curso->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $curso->id }}">Editar Curso</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('cursos.update', $curso->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre del Curso</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $curso->nombre }}" required>
                                                @error('nombre')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" required>{{ $curso->descripcion }}</textarea>
                                                @error('descripcion')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="duracion_semanas" class="form-label">Duración (semanas)</label>
                                                <input type="number" class="form-control" id="duracion_semanas" name="duracion_semanas" value="{{ $curso->duracion_semanas }}" required>
                                                @error('duracion_semanas')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary">Actualizar Curso</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('cursos.destroy', $curso->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este curso?');">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
</div>
