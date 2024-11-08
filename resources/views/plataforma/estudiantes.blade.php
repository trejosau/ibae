<div class="container mt-4">
    <h2 class="text-center mb-4">Gestión de Estudiantes</h2>
    
    <div class="row">
        @foreach($estudiantes as $estudiante)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm" style="background-color: #f9f4f2; border: none; border-radius: 10px;">
                <div class="card-body text-center">
                    <!-- Foto de perfil -->
                    <div style="width: 120px; height: 120px; margin: 0 auto; overflow: hidden; border-radius: 50%; background-color: #ddd;">
                        <img src="{{ $estudiante->persona->usuario->profile_photo_url ?? 'ruta_default_imagen.jpg' }}" alt="Foto de {{ $estudiante->persona->nombre }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <!-- Información del estudiante -->
                    <h5 class="card-title" style="color: #6a5a4e;">
                        {{ $estudiante->persona->nombre }} {{ $estudiante->persona->ap_paterno }} {{ $estudiante->persona->ap_materno }}
                    </h5>
                    <p class="card-text" style="color: #8c7a71; margin-block-end: 10px;">Matrícula: {{ $estudiante->matricula }}</p>
                    
                    <!-- Mostrar el correo del usuario relacionado -->
                    <p class="card-text" style="color: #8c7a71;">
                        Correo: {{ $estudiante->persona->usuario->email ?? 'No disponible' }}
                    </p>
                    
                    <!-- Botones de acción -->
                    <button class="btn btn-info" style="background-color: #b5a8a1; border: none;" data-toggle="modal" data-target="#modalEstudiante{{ $estudiante->matricula }}">Ver más</button>
                    <button class="btn btn-danger" style="background-color: #e6b0aa; border: none;" onclick="darDeBaja({{ $estudiante->matricula }})">Dar de baja</button>
                </div>
            </div>
        </div>

        <!-- Modal de información del estudiante -->
        <div class="modal fade" id="modalEstudiante{{ $estudiante->matricula }}" tabindex="-1" role="dialog" aria-labelledby="modalEstudianteLabel{{ $estudiante->matricula }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEstudianteLabel{{ $estudiante->matricula }}">Información del Estudiante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <img src="{{ $estudiante->persona->usuario->profile_photo_url ?? 'ruta_default_imagen.jpg' }}" class="rounded-circle" alt="Foto de {{ $estudiante->persona->nombre }}" style="width: 120px; height: 120px; object-fit: cover;">
                        </div>
                        <p><strong>Nombre Completo:</strong> {{ $estudiante->persona->nombre }} {{ $estudiante->persona->ap_paterno }} {{ $estudiante->persona->ap_materno }}</p>
                        <p><strong>Correo:</strong> {{ $estudiante->persona->usuario->email ?? 'No disponible' }}</p>
                        <p><strong>Grado de Estudios:</strong> {{ $estudiante->grado_estudio }}</p>
                        <p><strong>Inscripción:</strong> {{ $estudiante->inscripcion->nombre }} - ${{ $estudiante->inscripcion->precio }}</p>
                        <p><strong>Matrícula:</strong> {{ $estudiante->matricula }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>