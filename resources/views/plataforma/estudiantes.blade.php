<div class="container mt-4">
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
    <!-- Muestra los errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2 class="text-center mb-4">Gestión de Estudiantes</h2>

    <div class="row">
        <div class="text-center mb-4">
            <button type="button" class="btn" data-toggle="modal" data-target="#modalAsignarRol"
                    style="background-color: #ffdab9; color: #4a4e69; font-weight: bold; padding: 12px 24px; border-radius: 8px; border: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s, color 0.3s;"
                    onmouseover="this.style.backgroundColor='#ffb48a'; this.style.color='#ffffff';"
                    onmouseout="this.style.backgroundColor='#ffdab9'; this.style.color='#4a4e69';">
                Asignar Rol de Estudiante
            </button>
            <button type="button" class="btn" data-toggle="modal" data-target="#modalRegistrarEstudiante"
                    style="background-color: #ffdab9; color: #4a4e69; font-weight: bold; padding: 12px 24px; border-radius: 8px; border: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s, color 0.3s;"
                    onmouseover="this.style.backgroundColor='#ffb48a'; this.style.color='#ffffff';"
                    onmouseout="this.style.backgroundColor='#ffdab9'; this.style.color='#4a4e69';">
                Registrar Estudiante
            </button>
        </div>
    </div>




    <div class="row">
        @foreach($estudiantes as $estudiante)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm position-relative" style="background-color: #f9f4f2; border: none; border-radius: 10px;">
                    <!-- Badge de estado activo/dado de baja -->
                    @if($estudiante->estado == 'activo')
                        <span class="badge badge-success position-absolute" style="top: 10px; right: 10px; font-size: 14px; padding: 8px 12px;">Activo</span>
                    @else
                        <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px; font-size: 14px; padding: 8px 12px;">Baja</span>
                    @endif

                    <div class="card-body text-center">
                        <!-- Foto de perfil -->
                        <div style="width: 120px; height: 120px; margin: 0 auto; overflow: hidden; border-radius: 50%; background-color: #ddd;">
                            <img src="{{ $estudiante->Persona->Usuario->profile_photo_url }}"
                                 style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        </div>



                        <!-- Información del estudiante -->
                        <h5 class="card-title" style="color: #6a5a4e; font-weight: bold;">
                            {{ $estudiante->persona->nombre }} {{ $estudiante->persona->ap_paterno }} {{ $estudiante->persona->ap_materno }}
                        </h5>
                        <p class="card-text" style="color: #8c7a71; margin-block-end: 10px; font-size: 14px;">Matrícula: {{ $estudiante->matricula }}</p>
                        <p class="card-text" style="color: #8c7a71; margin-block-end: 10px; font-size: 14px;">Username: {{ $estudiante->Persona->Usuario->username }}</p>

                        <!-- Mostrar el correo del usuario relacionado -->
                        <p class="card-text" style="color: #8c7a71; font-size: 14px;">
                            Correo: {{ $estudiante->persona->Usuario->email }}
                        </p>

                        <!-- Botones de acción -->
                        <button class="btn btn-info" style="background-color: #b5a8a1; border: none;" data-toggle="modal" data-target="#modalEstudiante{{ $estudiante->matricula }}">Ver más</button>

                        @if($estudiante->estado == 'activo')
                            <!-- Formulario para dar de baja -->
                            <form action="{{ route('plataforma.baja', ['matricula' => $estudiante->matricula]) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger" style="background-color: #e6b0aa; border: none;" onclick="return confirm('¿Estás seguro de que deseas dar de baja a este estudiante?');">
                                    Dar de baja
                                </button>
                            </form>
                        @endif
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

                                </div>
                            </div>
                            <div style="font-size: 0.95rem;">
                                <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid #F2C6D1; padding-bottom: 5px;">
                                    <strong>Nombre Completo:</strong> {{ $estudiante->persona->nombre }} {{ $estudiante->persona->ap_paterno }} {{ $estudiante->persona->ap_materno }}
                                </div>
                                <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid #F2C6D1; padding-bottom: 5px;">
                                    <strong>Correo:</strong> {{ $estudiante->persona->usuario->email ?? 'No disponible' }}
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
        @endforeach
    </div>
    <div class="modal fade" id="modalAsignarRol" tabindex="-1" role="dialog" aria-labelledby="modalAsignarRolLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> <!-- modal-lg aumenta el ancho del modal -->
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
                        <div class="row">
                            <!-- Sección 1: Información de Usuario y Datos Personales -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="usuario">Seleccionar Usuario</label>
                                    <select class="form-control" id="usuario" name="usuario_id" required>
                                        <option value="">Seleccione un usuario</option>
                                        @foreach($usuariosSinRolEstudiante as $usuario)
                                            <option value="{{ $usuario->id }}">{{ optional($usuario->persona)->nombre }} {{ optional($usuario->persona)->ap_paterno }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <h6>Datos de Persona</h6>
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="ap_paterno">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="ap_paterno" name="ap_paterno" required>
                                </div>
                                <div class="form-group">
                                    <label for="ap_materno">Apellido Materno</label>
                                    <input type="text" class="form-control" id="ap_materno" name="ap_materno" required>
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                                </div>
                            </div>

                            <!-- Sección 2: Datos de Inscripción y Ubicación -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inscripcion">Seleccionar Inscripción</label>
                                    <select class="form-control" id="inscripcion" name="inscripcion_id" required>
                                        <option value="">Seleccione una inscripción</option>
                                        @foreach($inscripciones as $inscripcion)
                                            <option value="{{ $inscripcion->id }}">{{ $inscripcion->nombre }} - {{ $inscripcion->precio }} {{ $inscripcion->material_incluido ? '(Material incluido)' : '' }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Selecciona la inscripción con la que se está inscribiendo el estudiante.</small>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_inscripcion">Fecha de Inscripción</label>
                                    <input type="date" class="form-control" id="fecha_inscripcion" name="fecha_inscripcion" required>
                                </div>
                                <div class="form-group">
                                    <label for="grado_estudio">Grado de Estudio</label>
                                    <input type="text" class="form-control" id="grado_estudio" name="grado_estudio" required>
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const fechaInscripcion = document.getElementById("fecha_inscripcion");

                                        // Función para establecer la fecha mínima (14 días antes de hoy) y la fecha máxima (hoy)
                                        function setFechaLimites() {
                                            const today = new Date();
                                            const maxDate = today.toISOString().split("T")[0]; // Fecha máxima = hoy (YYYY-MM-DD)

                                            today.setDate(today.getDate() - 14); // Restar 14 días
                                            const minDate = today.toISOString().split("T")[0]; // Fecha mínima = 14 días atrás (YYYY-MM-DD)

                                            fechaInscripcion.setAttribute("max", maxDate); // Establecer fecha máxima (hoy)
                                            fechaInscripcion.setAttribute("min", minDate); // Establecer fecha mínima (14 días atrás)
                                        }

                                        // Establecer las fechas límite al cargar la página
                                        setFechaLimites();
                                    });
                                </script>



                            </div>

                            <!-- Sección 3: Grado de Estudio y Dirección -->
                            <div class="col-md-4">
                                <h6>Ubicación</h6>
                                <div class="form-group">
                                    <label for="ciudad">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode">Código Postal</label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode" required>
                                </div>
                                <div class="form-group">
                                    <label for="calle">Calle</label>
                                    <input type="text" class="form-control" id="calle" name="calle" required>
                                </div>
                                <div class="form-group">
                                    <label for="colonia">Colonia</label>
                                    <input type="text" class="form-control" id="colonia" name="colonia" required>
                                </div>
                                <div class="form-group">
                                    <label for="num_ext">Número Exterior</label>
                                    <input type="text" class="form-control" id="num_ext" name="num_ext" required>
                                </div>
                                <div class="form-group">
                                    <label for="num_int">Número Interior</label>
                                    <input type="text" class="form-control" id="num_int" name="num_int">
                                </div>
                            </div>
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

<!-- Modal para registrar usuario y estudiante -->
<div class="modal fade" id="modalRegistrarEstudiante" tabindex="-1" role="dialog" aria-labelledby="modalRegistrarEstudianteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistrarEstudianteLabel">Registrar Estudiante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('plataforma.registrarEstudiante') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Dividir el formulario en tres columnas -->
                    <div class="row">
                        <!-- Columna 1: Datos de Persona -->
                        <div class="col-4">
                            <h6>Datos de Persona</h6>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="ap_paterno">Apellido Paterno</label>
                                <input type="text" class="form-control" id="ap_paterno" name="ap_paterno" required>
                            </div>
                            <div class="form-group">
                                <label for="ap_materno">Apellido Materno</label>
                                <input type="text" class="form-control" id="ap_materno" name="ap_materno">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" required>
                            </div>
                        </div>

                        <!-- Columna 2: Datos de Usuario y Estudiante -->
                        <div class="col-4">
                            <h6>Datos de Usuario</h6>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <h6>Datos de Estudiante</h6>
                            <div class="form-group">
                                <label for="id_inscripcion">Inscripción</label>
                                <select class="form-control" id="id_inscripcion" name="id_inscripcion" required>
                                    @foreach($inscripciones as $inscripcion)
                                        <option value="{{ $inscripcion->id }}">{{ $inscripcion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha_inscripcion_estudiante">Fecha de Inscripción</label>
                                <input type="date" class="form-control" id="fecha_inscripcion_estudiante" name="fecha_inscripcion_estudiante" required>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const fechaInscripcion = document.getElementById("fecha_inscripcion_estudiante");

                                    // Función para establecer la fecha mínima (14 días antes de hoy) y la fecha máxima (hoy)
                                    function setFechaLimites() {
                                        const today = new Date();
                                        const maxDate = today.toISOString().split("T")[0]; // Fecha máxima = hoy (YYYY-MM-DD)

                                        today.setDate(today.getDate() - 14); // Restar 14 días
                                        const minDate = today.toISOString().split("T")[0]; // Fecha mínima = 14 días atrás (YYYY-MM-DD)

                                        fechaInscripcion.setAttribute("max", maxDate); // Establecer fecha máxima (hoy)
                                        fechaInscripcion.setAttribute("min", minDate); // Establecer fecha mínima (14 días atrás)
                                    }

                                    // Establecer las fechas límite al cargar la página
                                    setFechaLimites();
                                });
                            </script>

                        </div>

                        <!-- Columna 3: Datos de Dirección -->
                        <div class="col-4">
                            <h6>Dirección</h6>
                            <div class="form-group">
                                <label for="grado_estudio">Grado de Estudio</label>
                                <input type="text" class="form-control" id="grado_estudio" name="grado_estudio" required>
                            </div>
                            <div class="form-group">
                                <label for="zipcode">Código Postal</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" required>
                            </div>
                            <div class="form-group">
                                <label for="ciudad">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                            </div>
                            <div class="form-group">
                                <label for="colonia">Colonia</label>
                                <input type="text" class="form-control" id="colonia" name="colonia" required>
                            </div>
                            <div class="form-group">
                                <label for="calle">Calle</label>
                                <input type="text" class="form-control" id="calle" name="calle" required>
                            </div>
                            <div class="form-group">
                                <label for="num_ext">Número Exterior</label>
                                <input type="text" class="form-control" id="num_ext" name="num_ext" required>
                            </div>
                            <div class="form-group">
                                <label for="num_int">Número Interior</label>
                                <input type="text" class="form-control" id="num_int" name="num_int">
                            </div>
                        </div>
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
