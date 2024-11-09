<div class="container mt-4">
    <h2 class="text-center mb-4">Gestión de Profesores</h2>

    <div class="row">
        @foreach($profesores as $profesor)
        @if($profesor->estado == 'activo')
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm" style="background-color: #f9f4f2; border: none; border-radius: 10px;">
                <div class="card-body text-center">
                    <!-- Foto de perfil -->
                    <div style="width: 120px; height: 120px; margin: 0 auto; overflow: hidden; border-radius: 50%; background-color: #ddd;">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzceK1AIQtiWPaIfjbcbN1rvQ0a8dUbbJ8IA&s" 
                             alt="Foto de {{ $profesor->persona->nombre }}" 
                             style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    </div>
                    
                    <!-- Información del profesor -->
                    <h5 class="card-title" style="color: #6a5a4e;">
                        {{ $profesor->persona->nombre }} {{ $profesor->persona->ap_paterno }} {{ $profesor->persona->ap_materno }}
                    </h5>
                    <p class="card-text" style="color: #8c7a71; margin-block-end: 10px;">Especialidad: {{ $profesor->especialidad }}</p>

                    <!-- Mostrar el correo del usuario relacionado -->
                    <p class="card-text" style="color: #8c7a71;">
                        Correo: {{ $profesor->persona->Usuario->email }}
                    </p>

                    <!-- Botones de acción -->
                    <button class="btn btn-info" style="background-color: #b5a8a1; border: none;" data-toggle="modal" data-target="#modalProfesor{{ $profesor->id }}">Ver más</button>

                    <!-- Formulario para dar de baja -->
                    <form action="{{ route('plataforma.bajaProfesor', ['id' => $profesor->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger" style="background-color: #e6b0aa; border: none;" onclick="return confirm('¿Estás seguro de que deseas dar de baja a este profesor?');">
                            Dar de baja
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para ver más información del profesor -->
        <div class="modal fade" id="modalProfesor{{ $profesor->id }}" tabindex="-1" role="dialog" aria-labelledby="modalProfesorLabel{{ $profesor->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 400px;"> <!-- Tamaño reducido del modal -->
                <div class="modal-content" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    <div class="modal-header" style="background-color: #F2C6D1; color: #4B4A5A; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                        <h5 class="modal-title" id="modalProfesorLabel{{ $profesor->id }}" style="font-weight: bold; font-size: 1.15rem;">Información del Profesor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" style="color: #4B4A5A;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="background-color: #FFF1F3; color: #4B4A5A; padding: 1rem;">
                        <div class="text-center mb-3">
                            <div style="width: 100px; height: 100px; margin: 0 auto; overflow: hidden; border-radius: 50%; background-color: #ddd;">
                                <img src="{{ $profesor->persona->usuario->profile_photo_url ?? 'ruta_default_imagen.jpg' }}" alt="Foto de {{ $profesor->persona->nombre }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        
                        <!-- Información del profesor con diseño mejorado -->
                        <div style="font-size: 0.95rem;">
                            <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid #F2C6D1; padding-bottom: 5px;">
                                <i class="fas fa-user-circle" style="color: #F2C6D1; font-size: 1.1rem; margin-right: 6px;"></i>
                                <p style="margin: 0;"><strong>Nombre Completo:</strong> {{ $profesor->persona->nombre }} {{ $profesor->persona->ap_paterno }} {{ $profesor->persona->ap_materno }}</p>
                            </div>

                            <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid #F2C6D1; padding-bottom: 5px;">
                                <i class="fas fa-envelope" style="color: #F2C6D1; font-size: 1.1rem; margin-right: 6px;"></i>
                                <p style="margin: 0;"><strong>Correo:</strong> {{ $profesor->persona->Usuario->email ?? 'No disponible' }}</p>
                            </div>

                            <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid #F2C6D1; padding-bottom: 5px;">
                                <i class="fas fa-chalkboard-teacher" style="color: #F2C6D1; font-size: 1.1rem; margin-right: 6px;"></i>
                                <p style="margin: 0;"><strong>Especialidad:</strong> {{ $profesor->especialidad }}</p>
                            </div>

                            <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid #F2C6D1; padding-bottom: 5px;">
                                <i class="fas fa-calendar-alt" style="color: #F2C6D1; font-size: 1.1rem; margin-right: 6px;"></i>
                                <p style="margin: 0;"><strong>Fecha de Contratación:</strong> {{ \Carbon\Carbon::parse($profesor->fecha_contratacion)->format('Y-m-d') }}</p>
                            </div>

                            <div class="d-flex align-items-center" style="padding-bottom: 5px;">
                                <i class="fas fa-id-badge" style="color: #F2C6D1; font-size: 1.1rem; margin-right: 6px;"></i>
                                <p style="margin: 0;"><strong>ID Profesor:</strong> {{ $profesor->id }}</p>
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
</div>
