<div class="container my-4">
    <h4 class="text-primary titulo">Cursos</h4>
    
    <!-- Botón para agregar curso -->
    <div class="text-center my-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">
            Agregar Curso
        </button>
        <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#addCertificadoModal">
            Agregar Certificado
        </button>
    </div>
    
    <div class="row">
        @foreach($cursos as $curso)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-light">
                    <div class="card-body py-4">
                        <h5 class="card-title text-center text-primary">{{ $curso->nombre }}</h5>
                        <p class="card-text">{{ $curso->descripcion }}</p>
                        <p class="card-text"><strong>Duración:</strong> {{ $curso->duracion_semanas }} semanas</p>
                        @if($curso->certificado)
                            <p class="card-text"><strong>Certificado:</strong> {{ $curso->certificado->nombre }}</p>
                        @endif
                    </div>
                </div>
            </div>
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
                            <input type="text" class="form-control" id="nombre_certificado" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion_certificado" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion_certificado" name="descripcion" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="horas" class="form-label">Horas</label>
                            <input type="number" class="form-control" id="horas" name="horas" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="institucion" class="form-label">Institución</label>
                            <select class="form-select" id="institucion" name="institucion" required>
                                <option value="">Seleccione una institución</option>
                                @foreach($instituciones as $institucion)
                                    <option value="{{ $institucion }}">{{ $institucion }}</option>
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
</div>
