<div class="container mt-4">
    <h2>Gestión de Cursos Aperturados</h2>

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
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#aperturarCursoModal">
        Aperturar Curso
    </button>
    <div class="row mt-4">
        @foreach ($cursosApertura as $apertura)
            <div class="col-12 mb-4">
                <div class="card shadow-sm curso-card" style="font-size: 0.9rem; border: 1px solid #D32F2F; overflow: hidden; position: relative;" data-bs-toggle="collapse" data-bs-target="#dropdown-{{ $apertura->id }}">
                    <div class="card-body" style="padding: 15px;">
                        <h5 class="card-title" style="font-size: 1.2rem; color: #333; margin-bottom: 10px;">{{ $apertura->curso->nombre }}</h5>
                        <p class="card-text mb-1">
                            <strong>Día de Clase:</strong> {{ $apertura->dia_clase }}<br>
                            <strong>Hora de Clase:</strong> {{ $apertura->hora_clase }}<br>
                            <strong>Fecha de Inicio:</strong> {{ $apertura->fecha_inicio }}
                        </p>
                        <p class="card-text mb-2">
                        <span class="badge
                            @if($apertura->estado == 'finalizado') bg-success
                            @elseif($apertura->estado == 'en curso') bg-warning
                            @else bg-secondary @endif" style="font-size: 0.85rem; color: #fff;">
                            {{ ucfirst($apertura->estado) }}
                        </span>
                        </p>
                        @if($apertura->estado == 'programado')
                            <button class="btn btn-danger btn-sm" style="position: absolute; top: 10px; right: 10px;" data-bs-toggle="modal" data-bs-target="#inscribirAlumnosModal-{{ $apertura->id }}">Inscribir</button>
                        @elseif($apertura->estado == 'en curso')
                            <a href="{{ route('plataforma.registrarAsistencia', $apertura->id) }}" class="btn btn-info btn-sm" style="position: absolute; top: 10px; right: 10px;">Registrar</a>
                        @endif
                    </div>
                    <div id="dropdown-{{ $apertura->id }}" class="collapse">
                        <div class="card-body" style="padding-top: 10px;">
                            @for ($i = 1; $i <= $apertura->curso->duracion_semanas; $i++)
                                <div style="margin: 15px 0; padding: 10px;">
                                    <h6 style="margin: 0; font-size: 1.2rem; color: #333;">Semana {{ $i }}</h6>
                                    <hr style="border: 2px solid #C2185B; margin: 5px 0;">
                                    <p class="mt-1" style="margin: 0; font-size: 1rem; color: #C2185B;">
                                    <span class="badge" style="background-color: #FFABAB; color: #333; border-radius: 4px; border: 1px solid #C2185B;">
                                        Módulo: Módulo ABC
                                    </span>
                                    </p>
                                    <p class="mt-1" style="margin: 0; margin-left: 10px; font-size: 0.9rem; color: #555; border-left: 2px solid #C2185B; padding-left: 10px;">
                                        Tema 1: Introducción al Curso
                                    </p>
                                    <p class="mt-1" style="margin: 0; margin-left: 10px; font-size: 0.9rem; color: #555; border-left: 2px solid #C2185B; padding-left: 10px;">
                                        Tema 2: Objetivos del Curso
                                    </p>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <!-- Modals -->
    @foreach ($cursosApertura as $apertura)
        @if ($apertura->estado == 'programado')
            <!-- Modal para Inscribir Alumnos -->

            <div class="modal fade" id="inscribirAlumnosModal-{{ $apertura->id }}" tabindex="-1" aria-labelledby="inscribirAlumnosModalLabel-{{ $apertura->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="inscribirAlumnosModalLabel-{{ $apertura->id }}">Inscribir Alumnos - {{ $apertura->curso->nombre }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="searchInput-{{ $apertura->id }}" onkeyup="searchMatricula('{{ $apertura->id }}')" placeholder="Buscar por matrícula..." class="form-control mb-3">
                            <table class="table table-striped table-bordered" id="studentsTable-{{ $apertura->id }}">
                                <thead class="table-light">
                                <tr>
                                    <th>Matrícula</th>
                                    <th>Nombre Completo</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($estudiantes as $estudiante)
                                    <tr>
                                        <td>{{ $estudiante->matricula }}</td>
                                        <td>{{ $estudiante->persona->nombre }} {{ $estudiante->persona->ap_paterno }} {{ $estudiante->persona->ap_materno }}</td>
                                        <td>
                                            @php
                                                $estado = null;

                                                foreach ($resultado as $resultadoEstudiante) {
                                                    if ($resultadoEstudiante['matricula'] == $estudiante->matricula) {
                                                        foreach ($resultadoEstudiante['cursos'] as $curso) {
                                                            if ($curso['id_curso_apertura'] == $apertura->id) {
                                                                $estado = $curso['estado']; // Obtiene el estado del curso
                                                                break 2; // Sale de ambos bucles al encontrar el curso correspondiente
                                                            }
                                                        }
                                                    }
                                                }


                                            @endphp

                                            @if($estado === 'cursando')
                                                <form action="{{ route('darDeBaja') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="matricula" value="{{ $estudiante->matricula }}">
                                                    <input type="hidden" name="curso_apertura_id" value="{{ $apertura->id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm">Quitar Inscripción <i class="fa fa-times"></i></button>
                                                </form>
                                            @elseif($estado === 'baja')
                                                <span class="badge bg-warning">Alumno Baja</span>
                                            @else
                                                <form action="{{ route('inscribirAlumno') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="matricula" value="{{ $estudiante->matricula }}">
                                                    <input type="hidden" name="curso_apertura_id" value="{{ $apertura->id }}">
                                                    <button type="submit" class="btn btn-primary btn-sm">Inscribir</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <script>
                function searchMatricula(aperturaId) {
                    const input = document.getElementById('searchInput-' + aperturaId);
                    const filter = input.value.trim();
                    const table = document.getElementById('studentsTable-' + aperturaId);
                    const trs = table.getElementsByTagName('tr');

                    // Validar si el input es un número
                    const isNumber = /^[0-9]*$/.test(filter);

                    for (let i = 1; i < trs.length; i++) {
                        const tds = trs[i].getElementsByTagName('td');
                        const matricula = tds[0].textContent || tds[0].innerText;

                        if (isNumber && matricula.includes(filter)) {
                            trs[i].style.display = '';
                        } else {
                            trs[i].style.display = 'none';
                        }
                    }
                }
            </script>



       @endif


    @endforeach


    <!-- Modal para aperturar un curso -->
    <div class="modal fade" id="aperturarCursoModal" tabindex="-1" aria-labelledby="aperturarCursoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aperturarCursoModalLabel">Aperturar Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="aperturarCursoForm" method="POST" action="{{ route('plataforma.storeCursoApertura') }}">
                    @csrf <!-- Token CSRF para protección -->
                    <div class="modal-body">
                        <!-- Selección de Curso -->
                        <div class="mb-3">
                            <label for="cursoSelect" class="form-label">Selecciona el Curso</label>
                            <select class="form-select" id="cursoSelect" name="id_curso" required>
                                <option value="" disabled selected>Seleccione un curso</option>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}" data-duracion="{{ $curso->duracion_semanas }}">
                                        {{ $curso->nombre }} ({{ $curso->duracion_semanas }} semanas)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campo para la Fecha de Inicio -->
                        <div class="mb-3">
                            <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fecha_inicio" required>
                        </div>

                        <!-- Campo para la Hora de Clase -->
                        <div class="mb-3">
                            <label for="horaClase" class="form-label">Hora de Clase</label>
                            <input type="time" class="form-control" id="horaClase" name="hora_clase" required>
                        </div>

                        <!-- Campo para el Monto de Colegiatura -->
                        <div class="mb-3">
                            <label for="montoColegiatura" class="form-label">Monto de Colegiatura</label>
                            <input type="number" class="form-control" id="montoColegiatura" name="monto_colegiatura" placeholder="Ingrese el monto de colegiatura" required>
                        </div>

                        <!-- Contenedor de semanas -->
                        <div id="semanasContainer">
                            <!-- Semanas generadas dinámicamente -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aperturar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
