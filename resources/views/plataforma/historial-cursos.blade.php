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
    <table class="table table-striped table-bordered mt-3">
        <thead>
        <tr>
            <th>Nombre del Curso</th>
            <th>Día de Clases</th>
            <th>Hora de Clase</th>
            <th>Fecha de Inicio</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cursosApertura as $apertura)
            <tr>
                <td>{{ $apertura->curso->nombre }}</td>
                <td>{{ $apertura->dia_clase }}</td>
                <td>{{ $apertura->hora_clase }}</td>
                <td>{{ $apertura->fecha_inicio }}</td>
                <td>
                    @if($apertura->estado == 'finalizado')
                        <span class="badge bg-success">Terminado</span>
                    @elseif($apertura->estado == 'en curso')
                        <span class="badge bg-warning">En Curso</span>
                    @else
                        <span class="badge bg-secondary">Programado</span>
                    @endif
                </td>
                <td>
                    @if($apertura->estado == 'programado')
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inscribirAlumnosModal-{{ $apertura->id }}">Inscribir Alumnos</button>
                    @elseif($apertura->estado == 'en curso')
                        <a href="{{ route('plataforma.registrarAsistencia', $apertura->id) }}" class="btn btn-info">Registrar Asistencia/Pagos</a>

                   @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

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
