
<div class="container">
<div class="row">
    

    @foreach($estudiantes as $alumno)
        <div class="col-md-4 mb-4 student-card" data-matricula="{{ $alumno['matricula'] }}">
            <div class="card student-card-content shadow-sm" style="border-color: #D5E8D4; background-color: #FFF3E6;">
                <div class="card-body text-center d-flex flex-column align-items-center">
                    <!-- Imagen del Alumno -->
                    <div class="image-container mb-3">
                        <img src="{{ $alumno['foto_url'] ?? 'https://via.placeholder.com/100?text=Alumno' }}" 
                             alt="Foto de {{ $alumno['persona']['nombre'] }}" 
                             class="rounded-circle" 
                             style="width: 100px; height: 100px; border: 3px solid #C8E6C9; object-fit: cover;">
                    </div>
    
                    <!-- Información del Alumno -->
                    <h5 class="card-title text-dark font-weight-bold">{{ $alumno['persona']['nombre'] }} {{ $alumno['persona']['ap_paterno'] }}</h5>
                    <p class="card-text text-secondary mb-1"><strong>Matrícula:</strong> {{ $alumno['matricula'] }}</p>
    
                    <!-- Botones de Gestión -->
                    <div class="mt-auto">
                        <button class="btn btn-outline-primary btn-sm mr-2" data-toggle="modal" data-target="#viewStudentModal_{{ $alumno['matricula'] }}">Ver Más</button>
                        <button class="btn btn-outline-danger btn-sm">Dar de Baja</button>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Modal para Ver/Modificar Detalles del Alumno -->
        <div class="modal fade" id="viewStudentModal_{{ $alumno['matricula'] }}" tabindex="-1" aria-labelledby="viewStudentModalLabel_{{ $alumno['matricula'] }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewStudentModalLabel_{{ $alumno['persona']['id'] }}">Detalles del Alumno</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Campos del Formulario de Detalles del Alumno -->
                            <div class="form-group">
                                <label for="correo_{{ $alumno['matricula'] }}">Correo:</label>
                                <input type="email" class="form-control" id="correo_{{ $alumno['persona']['id'] }}" value="{{ $alumno['correo'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="nombre_{{ $alumno['matricula'] }}">Nombre:</label>
                                <input type="text" class="form-control" id="nombre_{{ $alumno['persona']['id'] }}" value="{{ $alumno['persona']['nombre'] }}">
                            </div>
                            <div class="form-group">
                                <label for="apellido_paterno_{{ $alumno['matricula'] }}">Apellido Paterno:</label>
                                <input type="text" class="form-control" id="apellido_paterno_{{ $alumno['persona']['id'] }}" value="{{ $alumno['persona']['ap_paterno'] }}">
                            </div>
                            <div class="form-group">
                                <label for="grado_estudios_{{ $alumno['matricula'] }}">Grado de Estudios:</label>
                                <input type="text" class="form-control" id="grado_estudios_{{ $alumno['matricula'] }}" value="{{ ucfirst($alumno['grado_estudio']) }}">
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm mt-3">Reenviar Correo</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>

