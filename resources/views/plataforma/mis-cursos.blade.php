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



    <h2 class="text-center mb-4" style="color: #0D1E4C; border-bottom: 3px solid #26415E;">Gestión de Cursos</h2>

    <!-- Botones -->
    <div class="text-center my-4">
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addCourseModal" style="background-color: #83A6CE; color: white; border-radius: 8px;">Agregar Curso</button>
        <button type="button" class="btn ms-2" data-bs-toggle="modal" data-bs-target="#addCertificadoModal" style="background-color: #C48CB3; color: white; border-radius: 8px;">Agregar Certificado</button>
        <button type="button" class="btn ms-2" data-bs-toggle="modal" data-bs-target="#changeStatusModal" style="background-color: #83A6CE; color: #ffffff; border-radius: 8px;">Cambiar Estado de Curso</button>
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
                                    <p class="card-text m-0"><strong>Duración:</strong> {{ $curso->duracion_horas }} horas</p>
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
                                <div class=" d-flex card-header bg-light align-items-baseline justify-content-center">
                                    <h6 class="m-0">Descripción:</h6>
                                    <p>{{ $curso->descripcion }}</p>
                                </div>
                                <!-- Sección para el certificado y cantidades -->
                                <div class="card-body bg-light">
                                   <h6 class="m-0 d-flex justify-content-center">Certificado: <strong>{{ $curso->certificado->nombre }}</strong></h6>



                                    <div class="d-flex justify-content-between">
                                        <small><strong>Cursos pendientes:</strong> 3</small>
                                        <small><strong>Cursos aperturados:</strong> 1</small>
                                        <small><strong>Cursos finalizados:</strong> 1</small>
                                    </div>
                                </div>
                                <!-- Footer con el botón de eliminar -->
                                <div class="card-footer d-flex justify-content-center ">
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




        <!-- Paginación con estilos -->
        @if ($cursos->hasPages())
            <nav aria-label="Page navigation" style="margin-top: 20px;">
                <ul style="display: flex; justify-content: center; list-style: none; padding: 0;">
                    {{-- Botón de página anterior --}}
                    @if ($cursos->onFirstPage())
                        <li style="margin: 0 5px;">
                            <span style="display: inline-block; padding: 10px 15px; color: #ccc; background-color: #f5f5f5; border: 1px solid #ddd; border-radius: 5px;">&laquo;</span>
                        </li>
                    @else
                        <li style="margin: 0 5px;">
                            <a href="{{ $cursos->previousPageUrl() }}" rel="prev"
                               style="display: inline-block; padding: 10px 15px; color: #007bff; background-color: #fff; border: 1px solid #ddd; border-radius: 5px; text-decoration: none;">
                                &laquo;
                            </a>
                        </li>
                    @endif

                    {{-- Números de página --}}
                    @foreach ($cursos->links()->elements as $element)
                        @if (is_string($element))
                            <li style="margin: 0 5px;">
                                <span style="display: inline-block; padding: 10px 15px; color: #ccc; background-color: #f5f5f5; border: 1px solid #ddd; border-radius: 5px;">{{ $element }}</span>
                            </li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $cursos->currentPage())
                                    <li style="margin: 0 5px;">
                                        <span style="display: inline-block; padding: 10px 15px; color: #fff; background-color: #007bff; border: 1px solid #007bff; border-radius: 5px;">
                                            {{ $page }}
                                        </span>
                                    </li>
                                @else
                                    <li style="margin: 0 5px;">
                                        <a href="{{ $url }}"
                                           style="display: inline-block; padding: 10px 15px; color: #007bff; background-color: #fff; border: 1px solid #ddd; border-radius: 5px; text-decoration: none;">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Botón de página siguiente --}}
                    @if ($cursos->hasMorePages())
                        <li style="margin: 0 5px;">
                            <a href="{{ $cursos->nextPageUrl() }}" rel="next"
                               style="display: inline-block; padding: 10px 15px; color: #007bff; background-color: #fff; border: 1px solid #ddd; border-radius: 5px; text-decoration: none;">
                                &raquo;
                            </a>
                        </li>
                    @else
                        <li style="margin: 0 5px;">
                            <span style="display: inline-block; padding: 10px 15px; color: #ccc; background-color: #f5f5f5; border: 1px solid #ddd; border-radius: 5px;">&raquo;</span>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif



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
                                <textarea
                                    class="form-control"
                                    id="descripcion"
                                    name="descripcion"
                                    maxlength="200"
                                    required
                                    oninput="actualizarContador(this)"
                                ></textarea>
                                <small id="contador" class="form-text text-muted">
                                    200 caracteres restantes.
                                </small>
                            </div>
                            <div class="mb-3">
                                <label for="duracion_semanas" class="form-label">Duración (semanas)</label>
                                <input type="number" class="form-control" id="duracion_semanas" name="duracion_semanas" min="1" step="1" required max="24">

                            </div>
                            <div class="mb-3">
                                <label for="duracion_horas" class="form-label">Duración por clase (horas)</label>
                                <input type="number" class="form-control" id="duracion_horas" name="duracion_horas" min="1"  max="24"  required>
                            </div>
                            <div class="mb-3">
                                <label for="id_certificacion" class="form-label">Certificado</label>
                                <select class="form-select" id="id_certificacion" name="id_certificacion" required>
                                    <option value="">Seleccione un certificado</option>
                                    @foreach($certificados as $certificado)
                                        <option value="{{ $certificado->id }}">{{ $certificado->nombre }} - {{ $certificado->institucion }}</option>
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
                                maxlength="200"
                                required
                                oninput="actualizarContadorCertificado(this)"
                            >{{ old('descripcion') }}</textarea>
                            <small id="contadorCertificado" class="form-text text-muted">
                                200 caracteres restantes.
                            </small>
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




<script>
    // Función para actualizar el contador de caracteres para certificados
    function actualizarContadorCertificado(textarea) {
        const maxLength = parseInt(textarea.getAttribute('maxlength'), 10);
        const currentLength = textarea.value.length;
        const caracteresRestantes = maxLength - currentLength;

        const contador = document.getElementById('contadorCertificado');
        contador.textContent = `${caracteresRestantes} caracteres restantes.`;

        // Evita que se escriba más del límite
        if (currentLength >= maxLength) {
            textarea.value = textarea.value.substring(0, maxLength);
        }
    }
</script>


<script>
    // Función para actualizar el contador de caracteres
    function actualizarContador(textarea) {
        const maxLength = parseInt(textarea.getAttribute('maxlength'), 10);
        const currentLength = textarea.value.length;
        const caracteresRestantes = maxLength - currentLength;

        const contador = document.getElementById('contador');
        contador.textContent = `${caracteresRestantes} caracteres restantes.`;

        // Evita que se escriba más del límite
        if (currentLength >= maxLength) {
            textarea.value = textarea.value.substring(0, maxLength);
        }
    }
</script>

