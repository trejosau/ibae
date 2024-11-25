<div class="container mt-4">
    <h2 class="text-center mb-4">Gestión de Cursos Aperturados</h2>

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

    <div class="text-center mb-4">
        @if(auth()->user()->hasRole('admin'))
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#aperturarCursoModal">
                Aperturar Curso
            </button>
            <a href="{{ route('plataforma.iniciarCursos') }}" class="btn btn-primary mb-3">
                Iniciar Cursos
            </a>
        @endif
    </div>
    
    <div class="row mt-4">
        @foreach ($cursosApertura as $apertura)
            <!-- Mostrar solo a administradores o cursos activos para profesores -->
            @if(auth()->user()->hasRole('admin') || $apertura->estado == 'en curso')
                <div class="col-12 mb-4">
                    <div class="card shadow-sm curso-card" style="font-size: 0.9rem; border: 1px solid #D32F2F; overflow: hidden; position: relative;">
                        <div class="card-body" style="padding: 15px;">
                            <h5 class="card-title" style="font-size: 1.2rem; color: #333; margin-bottom: 10px;">
                                {{ $apertura->curso->nombre }}
                            </h5>
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
                            
                            <!-- Botones según el rol y el estado -->
                            @if(auth()->user()->hasRole('admin') && $apertura->estado == 'programado')
                                <!-- Botón para inscribir (solo para admins) -->
                                <button class="btn btn-danger btn-sm" style="position: absolute; top: 10px; right: 10px;" data-bs-toggle="modal" data-bs-target="#inscribirAlumnosModal-{{ $apertura->id }}">
                                    Inscribir
                                </button>
                            @elseif(auth()->user()->hasRole('profesor') && $apertura->estado == 'en curso')
                                <!-- Botón para asistencia/colegiaturas (solo para profesores en cursos activos) -->
                                <a href="{{ route('plataforma.registrarAsistencia', $apertura->id) }}" class="btn btn-info btn-sm registrar-btn" style="position: absolute; top: 10px; right: 10px; z-index: 15;" target="_blank">
                                    Asistencia/Colegiaturas
                                </a>
                            @endif
                        </div>
                        
                        <!-- Detalles del curso (visible para todos los roles) -->
                        <div class="card-footer" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#dropdown-{{ $apertura->id }}">
                            <small class="text-muted">Ver detalles del curso</small>
                        </div>
                        <div id="dropdown-{{ $apertura->id }}" class="collapse">
                            <div class="card-body" style="padding-top: 10px;">
                                @foreach ($apertura->moduloCursos as $moduloCurso)
                                    <div style="margin: 15px 0; padding: 10px;">
                                        <h6 style="margin: 0; font-size: 1.2rem; color: #333;">Semana {{ $moduloCurso->orden }}</h6>
                                        <hr style="border: 2px solid #C2185B; margin: 5px 0;">
                                        <p class="mt-1" style="margin: 0; font-size: 1rem; color: #C2185B;">
                                            <span class="badge" style="background-color: #FFABAB; color: #333; border-radius: 4px; border: 1px solid #C2185B;">
                                                Módulo: {{ $moduloCurso->modulo->nombre }}
                                            </span>
                                        </p>
                                        @foreach ($moduloCurso->modulo->temas as $tema)
                                            <p class="mt-1" style="margin: 0; margin-left: 10px; font-size: 0.9rem; color: #555; border-left: 2px solid #C2185B; padding-left: 10px;">
                                                Tema: {{ $tema->nombre }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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
                            <select class="form-select" id="cursoSelect" name="id_curso" required
                                    style="background-color: #fdfdfe; border-color: #d3d3e3; color: #5a5a6e;">
                                <option value="" disabled selected>Seleccione un curso</option>

                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}" data-duracion="{{ $curso->duracion_semanas }}">
                                        {{ $curso->nombre }} ({{ $curso->duracion_semanas }} semanas)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select para Profesores -->
                        <div class="mb-3">
                            <label for="id_profesor" class="form-label">Profesor</label>
                            <select class="form-select" id="id_profesor" name="id_profesor" required>
                                <option value="">Seleccione un profesor</option>
                                @foreach($profesores as $profesor)
                                    <option value="{{ $profesor->id }}">
                                        {{ $profesor->persona->nombre }} {{ $profesor->persona->apellido_pa }} {{ $profesor->persona->apellido_ma }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campo para la Fecha de Inicio -->
                        <div class="mb-3">
                            <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fecha_inicio" required>
                            <small id="diaSemana" class="text-muted"></small> <!-- Elemento para mostrar el día de la semana -->
                        </div>

                        <!-- Campo para la Hora de Clase -->
                        <div class="mb-3">
                            <label for="horaClase" class="form-label">Hora de Clase</label>
                            <input type="time" class="form-control" id="horaClase" name="hora_clase" >
                        </div>

                        <script>
                            // Obtener la fecha actual
                            const hoy = new Date();
                            const año = hoy.getFullYear();
                            const mes = (hoy.getMonth() + 1).toString().padStart(2, '0'); // Mes actual, con formato de dos dígitos
                            const día = hoy.getDate().toString().padStart(2, '0'); // Día actual, con formato de dos dígitos

                            // Establecer el atributo 'min' del campo de fecha
                            document.getElementById('fechaInicio').setAttribute('min', `${año}-${mes}-${día}`);

                            // Mostrar el día de la semana cuando se selecciona una fecha
                            document.getElementById('fechaInicio').addEventListener('change', function() {
                                const partesFecha = this.value.split('-');
                                const año = parseInt(partesFecha[0], 10);
                                const mes = parseInt(partesFecha[1], 10) - 1; // Meses en JavaScript van de 0 a 11
                                const día = parseInt(partesFecha[2], 10);

                                const fechaSeleccionada = new Date(año, mes, día);

                                const diasSemana = [
                                    'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'
                                ];
                                const diaSemana = diasSemana[fechaSeleccionada.getDay()];

                                document.getElementById('diaSemana').textContent = diaSemana ? `Día seleccionado: ${diaSemana}` : '';
                            });
                        </script>

                        <!-- Campo para el Monto de Colegiatura -->
                        <div class="mb-3">
                            <label for="montoColegiatura" class="form-label">Monto de Colegiatura</label>
                            <input type="number" class="form-control" id="montoColegiatura" name="monto_colegiatura"
                                   placeholder="Ingrese el monto de colegiatura" required>
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

    <script>
        document.getElementById('cursoSelect').addEventListener('change', function() {
            // Obtener el valor de data-duracion del curso seleccionado
            const duracionSemanas = this.options[this.selectedIndex].getAttribute('data-duracion');
            const semanasContainer = document.getElementById('semanasContainer');

            // Limpiar el contenido anterior
            semanasContainer.innerHTML = '';

            // Obtener los módulos y temas desde la variable pasada del backend
            const modulosConTemas = @json($modulosConTemas);

            // Generar los divs y selects para cada semana
            for (let i = 1; i <= duracionSemanas; i++) {
                // Crear un div para la semana
                const semanaDiv = document.createElement('div');
                semanaDiv.classList.add('mb-3');

                // Crear una etiqueta para la semana
                const semanaLabel = document.createElement('label');
                semanaLabel.classList.add('form-label');
                semanaLabel.textContent = `Semana ${i}`;

                // Crear un select para los módulos
                const semanaSelect = document.createElement('select');
                semanaSelect.classList.add('form-select');
                semanaSelect.name = `modulos[semana_${i}]`; // Adaptado para enviar correctamente
                semanaSelect.required = true;
                semanaSelect.style = "background-color: #fdfdfe; border-color: #d3d3e3; color: #5a5a6e;";

                // Añadir una opción vacía al select
                const emptyOption = document.createElement('option');
                emptyOption.value = '';
                emptyOption.textContent = 'Seleccione un módulo';
                emptyOption.disabled = true;
                emptyOption.selected = true;
                semanaSelect.appendChild(emptyOption);

                // Añadir los módulos como opciones al select
                modulosConTemas.forEach(modulo => {
                    const option = document.createElement('option');
                    option.value = modulo.id;
                    option.textContent = modulo.nombre;
                    semanaSelect.appendChild(option);
                });

                // Contenedor para mostrar los temas
                const temasContainer = document.createElement('div');
                temasContainer.classList.add('mt-2');

                // Evento para actualizar los temas al seleccionar un módulo
                semanaSelect.addEventListener('change', function() {
                    // Limpiar temas anteriores
                    temasContainer.innerHTML = '';

                    // Obtener el módulo seleccionado
                    const moduloId = this.value;
                    const modulo = modulosConTemas.find(m => m.id == moduloId);

                    // Añadir los temas del módulo
                    if (modulo && modulo.temas) {
                        modulo.temas.forEach(tema => {
                            const temaSpan = document.createElement('span');
                            temaSpan.classList.add('tema-visible');
                            temaSpan.style = "display: inline-block; padding: 5px 10px; margin: 2px; border-radius: 5px; background-color: #ffebee; color: #c62828; font-size: 0.9em;";
                            temaSpan.textContent = tema.nombre;
                            temasContainer.appendChild(temaSpan);
                        });
                    }
                });

                // Agregar la etiqueta, el select y los temas al div de la semana
                semanaDiv.appendChild(semanaLabel);
                semanaDiv.appendChild(semanaSelect);
                semanaDiv.appendChild(temasContainer);

                // Añadir el div al contenedor
                semanasContainer.appendChild(semanaDiv);
            }

            // Mostrar el número de semanas en la consola
            console.log(`Duración del curso seleccionado: ${duracionSemanas} semanas`);
        });
    </script>


</div>
