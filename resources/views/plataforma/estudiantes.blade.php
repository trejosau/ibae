<div class="container mt-4" >
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
            <button type="button" class="btn" data-toggle="modal" data-target="#modalRegistrarEstudiante"
                    style="background-color: #83A6CE; color: #ffffff; font-weight: bold; padding: 12px 24px; border-radius: 8px; border: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s, color 0.3s;">
                Registrar Estudiante
            </button>
        </div>
    </div>

<livewire:filtro-estudiantes />


</div>
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
                                <input type="tel" class="form-control" id="telefono" value="+52" name="telefono" required>
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
                                <select class="form-select" id="id_inscripcion" name="id_inscripcion" required>
                                    <option value="" selected disabled>Selecciona una Inscripción</option>
                                    @foreach($inscripciones as $inscripcion)
                                        <option value="{{ $inscripcion->id }}">{{ $inscripcion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha_inscripcion_estudiante">Fecha de Inscripción</label>
                                <input type="date" class="form-control" id="fecha_inscripcion_estudiante" name="fecha_inscripcion_estudiante" required>
                            </div>
                            <div class="form-group">
                                <label for="grado_estudio">Grado de Estudio</label>
                                <input type="text" class="form-control" id="grado_estudio" name="grado_estudio" required>
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
<!-- Paginación -->

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@livewireStyles
@livewireScripts


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelector("#telefono");

        if (input) {
            const iti = window.intlTelInput(input, {
                nationalMode: false, // Desactiva el modo nacional
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                preferredCountries: [ "mx"],
            });
        }
    });
</script>



