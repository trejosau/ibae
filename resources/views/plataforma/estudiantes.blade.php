<div class="container mt-4"> 
    <h2 class="text-center mb-4">Gestión de Estudiantes</h2>

    <!-- Botón para abrir el modal de asignación de rol -->
    <div class="text-center mb-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAsignarRol">
            Asignar Rol de Estudiante
        </button>
    </div>

    <div class="row">
        @foreach($estudiantes as $estudiante)
            @if($estudiante->estado == 'activo')
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm" style="background-color: #f9f4f2; border: none; border-radius: 10px;">
                        <div class="card-body text-center">
                            <!-- Foto de perfil -->
                            <div style="width: 120px; height: 120px; margin: 0 auto; overflow: hidden; border-radius: 50%; background-color: #ddd;">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzceK1AIQtiWPaIfjbcbN1rvQ0a8dUbbJ8IA&s" 
                                     alt="Foto de {{ $estudiante->persona->nombre }}" 
                                     style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            </div>
                            
                            <!-- Información del estudiante -->
                            <h5 class="card-title" style="color: #6a5a4e;">
                                {{ $estudiante->persona->nombre }} {{ $estudiante->persona->ap_paterno }} {{ $estudiante->persona->ap_materno }}
                            </h5>
                            <p class="card-text" style="color: #8c7a71; margin-block-end: 10px;">Matrícula: {{ $estudiante->matricula }}</p>

                            <!-- Mostrar el correo del usuario relacionado -->
                            <p class="card-text" style="color: #8c7a71;">
                                Correo: {{ $estudiante->persona->Usuario->email }}
                            </p>

                            <!-- Botones de acción -->
                            <button class="btn btn-info" style="background-color: #b5a8a1; border: none;" data-toggle="modal" data-target="#modalEstudiante{{ $estudiante->matricula }}">Ver más</button>

                            <!-- Formulario para dar de baja -->
                            <form action="{{ route('plataforma.baja', ['matricula' => $estudiante->matricula]) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger" style="background-color: #e6b0aa; border: none;" onclick="return confirm('¿Estás seguro de que deseas dar de baja a este estudiante?');">
                                    Dar de baja
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para ver más información del estudiante -->
                <div class="modal fade" id="modalEstudiante{{ $estudiante->matricula }}" tabindex="-1" role="dialog" aria-labelledby="modalEstudianteLabel{{ $estudiante->matricula }}" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="max-width: 400px;">
                        <div class="modal-content" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                            <div class="modal-header" style="background-color: #F2C6D1; color: #4B4A5A; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                                <h5 class="modal-title" id="modalEstudianteLabel{{ $estudiante->matricula }}" style="font-weight: bold; font-size: 1.15rem;">Información del Estudiante</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" style="color: #4B4A5A;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="background-color: #FFF1F3; color: #4B4A5A; padding: 1rem;">
                                <!-- Información detallada del estudiante -->
                                <div class="text-center mb-3">
                                    <div style="width: 100px; height: 100px; margin: 0 auto; overflow: hidden; border-radius: 50%; background-color: #ddd;">
                                        <img src="{{ $estudiante->persona->usuario->profile_photo_url ?? 'ruta_default_imagen.jpg' }}" alt="Foto de {{ $estudiante->persona->nombre }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </div>
                                <div style="font-size: 0.95rem;">
                                    <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid #F2C6D1; padding-bottom: 5px;">
                                        <strong>Nombre Completo:</strong> {{ $estudiante->persona->nombre }} {{ $estudiante->persona->ap_paterno }} {{ $estudiante->persona->ap_materno }}
                                    </div>
                                    <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid #F2C6D1; padding-bottom: 5px;">
                                        <strong>Correo:</strong> {{ $estudiante->persona->Usuario->email ?? 'No disponible' }}
                                    </div>
                                    <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid #F2C6D1; padding-bottom: 5px;">
                                        <strong>Grado de Estudios:</strong> {{ $estudiante->grado_estudio }}
                                    </div>
                                    <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid #F2C6D1; padding-bottom: 5px;">
                                        <strong>Inscripción:</strong> {{ $estudiante->inscripcion->nombre }}
                                    </div>
                                    <div class="d-flex align-items-center" style="padding-bottom: 5px;">
                                        <strong>Matrícula:</strong> {{ $estudiante->matricula }}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="border-top: 1px solid #F2C6D1;">
                                <button type="button" class="btn" style="background-color: #F2C6D1; color: #4B4A5A; font-weight: bold;" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Modal para asignar el rol de estudiante a usuarios sin ese rol -->
    <div class="modal fade" id="modalAsignarRol" tabindex="-1" role="dialog" aria-labelledby="modalAsignarRolLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAsignarRolLabel">Asignar Rol de Estudiante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('plataforma.asignarRol') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usuario">Seleccionar Usuario</label>
                            <select class="form-control" id="usuario" name="usuario_id" required>
                                <option value="">Seleccione un usuario</option>
                                @foreach($usuariosSinRolEstudiante as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->persona->nombre }} {{ $usuario->persona->ap_paterno }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
