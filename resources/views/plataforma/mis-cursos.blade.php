<div class="container my-4">
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

 
    

    
    <h2 class="text-center mb-4">Gestión de Cursos</h2>

    <!-- Botón para agregar curso -->
    <div class="text-center my-4">
        <div class="text-center my-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                Agregar Curso
            </button>
            <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#addCertificadoModal">
                Agregar Certificado
            </button>
            <button type="button" class="btn btn-warning ms-2" data-bs-toggle="modal" data-bs-target="#changeStatusModal">
                Cambiar Estado de Curso
            </button>
    </div>


        <div class="row">
            @foreach($cursos as $curso)
                @if($curso->estado === 'activo' || $curso->estado === 'inactivo')
                    <div class="col-12 mb-4">
                        <div class="card h-100 border-light position-relative">
                            <div class="card-body p-0">
                                <div class="row g-0 align-items-stretch" data-bs-toggle="collapse" data-bs-target="#curso-{{ $curso->id }}" aria-expanded="false" aria-controls="curso-{{ $curso->id }}">
                                    <!-- Icono de curso -->
                                    <div class="col-2 p-0">
                                        <div class="bg-primary h-100 d-flex justify-content-center align-items-center">
                                            <i class="fas fa-book-open fa-lg text-white"></i>
                                        </div>
                                    </div>
                                    <!-- Nombre y duración -->
                                    <div class="col-8 p-3">
                                        <h5 class="card-title text-primary m-0">{{ $curso->nombre }}</h5>
                                        <p class="card-text m-0"><strong>Duración:</strong> {{ $curso->duracion_semanas }} semanas</p>
                                    </div>
                                    <!-- Estado -->
                                    <div class="col-2 p-0 position-relative">
                                <span class="badge {{ $curso->estado === 'activo' ? 'bg-success' : 'bg-danger' }} position-absolute top-0 end-0" style="transform: translate(50%, -50%);">
                                    {{ $curso->estado === 'activo' ? 'Activo' : 'Inactivo' }}
                                </span>
                                    </div>
                                </div>
                                <!-- Contenido del dropdown -->
                                <div class="collapse" id="curso-{{ $curso->id }}">
                                    <!-- Header con la descripción -->
                                    <div class="card-header bg-light">
                                        <h6 class="m-0">Descripción:</h6>
                                        <p>{{ $curso->descripcion }}</p>
                                    </div>
                                    <!-- Sección para el certificado y cantidades -->
                                    <div class="card-body bg-light">
                                       <h6 class="m-0">Certificado: <strong>{{ $curso->certificado->nombre }}</strong></h6>



                                        <div class="d-flex justify-content-between">
                                            <small><strong>Cursos pendientes:</strong> 3</small>
                                            <small><strong>Cursos aperturados:</strong> 1</small>
                                            <small><strong>Cursos finalizados:</strong> 1</small>
                                        </div>
                                    </div>
                                    <!-- Footer con el botón de eliminar -->
                                    <div class="card-footer">
                                        <form action="{{ route('plataforma.cursoDestroy', $curso->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este curso?');">Eliminar curso</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>




        <!-- Modal para agregar curso -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Agregar Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cursos.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Curso</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="duracion_semanas" class="form-label">Duración (semanas)</label>
                            <input type="number" class="form-control" id="duracion_semanas" name="duracion_semanas" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_certificacion" class="form-label">Certificado</label>
                            <select class="form-select" id="id_certificacion" name="id_certificacion">
                                <option value="">Seleccione un certificado (opcional)</option>
                                @foreach($certificados as $certificado)
                                    <option value="{{ $certificado->id }}">{{ $certificado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para agregar certificado -->
    <div class="modal fade" id="addCertificadoModal" tabindex="-1" aria-labelledby="addCertificadoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCertificadoModalLabel">Agregar Certificado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('certificados.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre_certificado" class="form-label">Nombre del Certificado</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="nombre_certificado" 
                                name="nombre" 
                                value="{{ old('nombre') }}" 
                                required
                            >
                        </div>
                        <div class="mb-3">
                            <label for="descripcion_certificado" class="form-label">Descripción</label>
                            <textarea 
                                class="form-control" 
                                id="descripcion_certificado" 
                                name="descripcion" 
                                required>{{ old('descripcion') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="horas" class="form-label">Horas</label>
                            <input 
                                type="number" 
                                class="form-control" 
                                id="horas" 
                                name="horas" 
                                value="{{ old('horas') }}" 
                                min="1" 
                                max="120" 
                                required
                            >
                        </div>
                        <div class="mb-3">
                            <label for="institucion" class="form-label">Institución</label>
                            <select class="form-select" id="institucion" name="institucion" required>
                                <option value="" {{ old('institucion') == '' ? 'selected' : '' }}>Seleccione una institución</option>
                                @foreach($instituciones as $institucion)
                                    <option value="{{ $institucion }}" {{ old('institucion') == $institucion ? 'selected' : '' }}>
                                        {{ $institucion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar Certificado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeStatusModalLabel">Cambiar Estado del Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cursos.cambiarEstado') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="curso_id" class="form-label">Seleccionar Curso</label>
                            <select class="form-select" id="curso_id" name="curso_id" required>
                                <option value="">Seleccione un curso</option>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="" selected disabled>Selecciona una opción</option>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>



