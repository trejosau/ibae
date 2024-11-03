<div class="container mt-4">
    <h2>Gestión de Cursos</h2>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#aperturarCursoModal">
        Aperturar Curso
    </button>
    <table class="table table-striped table-bordered mt-3">
        <thead>
        <tr>
            <th>Nombre del Curso</th>
            <th>Fecha de Inicio</th>
            <th>Periodo</th>
            <th>Año</th>
            <th>Día de Clases</th>
            <th>Alumnos Inscritos</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <tr data-bs-toggle="collapse" data-bs-target="#details1" aria-expanded="false" aria-controls="details1">
            <td>Curso de Maquillaje Profesional</td>
            <td>2024-02-10</td>
            <td>Primer Semestre</td>
            <td>2024</td>
            <td>Sábados</td>
            <td>12</td>
            <td><span class="badge bg-success">Terminado</span></td>
            <td>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verResumenModal">Ver Resumen</button>
            </td>
        </tr>
        <tr class="collapse" id="details1">
            <td colspan="9">
                <div class="p-3">
                    <h5 class="text-uppercase">Descripción</h5>
                    <p>Aprende técnicas avanzadas de maquillaje para diferentes ocasiones.</p>
                    <hr class="my-3"> <!-- Divider added -->
                    <h5 class="text-uppercase">Plan de Estudio - Curso de Maquillaje Profesional</h5>
                    <div class="border-top border-bottom my-3">
                        <span class="badge bg-info fs-6">Semana 1</span>
                        <span class="badge bg-secondary fs-6">Módulo: Fundamentos del Maquillaje</span>
                        <ol class="list-unstyled mt-2">
                            <li class="mb-1">Tema: Tipos de Piel</li>
                            <li class="mb-1">Tema: Herramientas de Maquillaje</li>
                        </ol>
                    </div>
                    <div class="border-top border-bottom my-3">
                        <span class="badge bg-info fs-6">Semana 2</span>
                        <span class="badge bg-secondary fs-6">Módulo: Técnicas de Aplicación</span>
                        <ol class="list-unstyled mt-2">
                            <li class="mb-1">Tema: Maquillaje Natural</li>
                            <li class="mb-1">Tema: Maquillaje de Noche</li>
                        </ol>
                    </div>
                    <div class="border-top border-bottom my-3">
                        <span class="badge bg-info fs-6">Semana 3</span>
                        <span class="badge bg-secondary fs-6">Módulo: Maquillaje para Eventos Especiales</span>
                        <ol class="list-unstyled mt-2">
                            <li class="mb-1">Tema: Maquillaje de Novias</li>
                            <li class="mb-1">Tema: Maquillaje de Quinceañeras</li>
                        </ol>
                    </div>
                </div>
            </td>
        </tr>
        <tr data-bs-toggle="collapse" data-bs-target="#details2" aria-expanded="false" aria-controls="details2">
            <td>Curso de Cortes de Cabello</td>
            <td>2024-03-15</td>
            <td>Primer Semestre</td>
            <td>2024</td>
            <td>Martes</td>
            <td>15</td>
            <td><span class="badge bg-warning">En Curso</span></td>
            <td>
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#registrarAsistenciaModal">Registrar Asistencia/Pagos</button>
            </td>
        </tr>
        <tr class="collapse" id="details2">
            <td colspan="9">
                <div class="p-3">
                    <h5 class="text-uppercase">Descripción</h5>
                    <p>Domina las técnicas de corte de cabello para todos los estilos.</p>
                    <hr class="my-3"> <!-- Divider added -->
                    <h5 class="text-uppercase">Plan de Estudio - Curso de Cortes de Cabello</h5>
                    <div class="border-top border-bottom my-3">
                        <span class="badge bg-info fs-6">Semana 1</span>
                        <span class="badge bg-secondary fs-6">Módulo: Introducción a los Cortes</span>
                        <ol class="list-unstyled mt-2">
                            <li class="mb-1">Tema: Herramientas de Corte</li>
                            <li class="mb-1">Tema: Teoría de Cortes</li>
                        </ol>
                    </div>
                    <div class="border-top border-bottom my-3">
                        <span class="badge bg-info fs-6">Semana 2</span>
                        <span class="badge bg-secondary fs-6">Módulo: Cortes para Mujeres</span>
                        <ol class="list-unstyled mt-2">
                            <li class="mb-1">Tema: Cortes Clásicos</li>
                            <li class="mb-1">Tema: Cortes Modernos</li>
                        </ol>
                    </div>
                    <div class="border-top border-bottom my-3">
                        <span class="badge bg-info fs-6">Semana 3</span>
                        <span class="badge bg-secondary fs-6">Módulo: Cortes para Hombres</span>
                        <ol class="list-unstyled mt-2">
                            <li class="mb-1">Tema: Cortes Clásicos para Hombres</li>
                            <li class="mb-1">Tema: Técnicas de Fade</li>
                        </ol>
                    </div>
                </div>
            </td>
        </tr>
        <tr data-bs-toggle="collapse" data-bs-target="#details3" aria-expanded="false" aria-controls="details3">
            <td>Curso de Técnicas de Coloración</td>
            <td>2024-04-20</td>
            <td>Segundo Semestre</td>
            <td>2024</td>
            <td>Jueves</td>
            <td>10</td>
            <td><span class="badge bg-secondary">Programado</span></td>
            <td>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#gestionarAlumnosModal">Inscribir Alumnos</button>
            </td>
        </tr>
        <tr class="collapse" id="details3">
            <td colspan="9">
                <div class="p-3">
                    <h5 class="text-uppercase">Descripción</h5>
                    <p>Aprende a aplicar color en el cabello de manera profesional.</p>
                    <hr class="my-3"> <!-- Divider added -->
                    <h5 class="text-uppercase">Plan de Estudio - Curso de Técnicas de Coloración</h5>
                    <div class="border-top border-bottom my-3">
                        <span class="badge bg-info fs-6">Semana 1</span>
                        <span class="badge bg-secondary fs-6">Módulo: Introducción a la Coloración</span>
                        <ol class="list-unstyled mt-2">
                            <li class="mb-1">Tema: Teoría del Color</li>
                            <li class="mb-1">Tema: Tipos de Colorantes</li>
                        </ol>
                    </div>
                    <div class="border-top border-bottom my-3">
                        <span class="badge bg-info fs-6">Semana 2</span>
                        <span class="badge bg-secondary fs-6">Módulo: Técnicas de Aplicación</span>
                        <ol class="list-unstyled mt-2">
                            <li class="mb-1">Tema: Coloración Completa</li>
                            <li class="mb-1">Tema: Mechas y Balayage</li>
                        </ol>
                    </div>
                    <div class="border-top border-bottom my-3">
                        <span class="badge bg-info fs-6">Semana 3</span>
                        <span class="badge bg-secondary fs-6">Módulo: Corrección de Color</span>
                        <ol class="list-unstyled mt-2">
                            <li class="mb-1">Tema: Solución de Errores de Color</li>
                            <li class="mb-1">Tema: Técnicas de Matización</li>
                        </ol>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>

</div>

<!-- Modal para aperturar un curso -->
<div class="modal fade" id="aperturarCursoModal" tabindex="-1" aria-labelledby="aperturarCursoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aperturarCursoModalLabel">Aperturar Curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="cursoSelect" class="form-label">Selecciona el Curso</label>
                    <select class="form-select" id="cursoSelect">
                        <option value="" disabled selected>Seleccione un curso</option>
                        <option value="cocina">Curso de Cocina</option>
                        <option value="fotografia">Curso de Fotografía</option>
                        <option value="pintura">Curso de Pintura</option>
                    </select>
                </div>

                <!-- Contenedor de semanas -->
                <div id="semanasContainer">
                    <!-- Semana 1 -->
                    <div class="semana mb-3">
                        <label class="form-label">Semana 1</label>
                        <select class="form-select moduloSelect">
                            <option value="" disabled selected>Selecciona un Módulo</option>
                            <option value="modulo1">Módulo 1: Introducción</option>
                            <option value="modulo2">Módulo 2: Técnicas Avanzadas</option>
                            <option value="modulo3">Módulo 3: Proyectos Prácticos</option>
                        </select>
                        <div class="temasContainer mt-2">
                            <label class="form-label">Temas</label>
                            <div class="input-group">
                                <select class="form-select temaSelect">
                                    <option value="" disabled selected>Selecciona un Tema</option>
                                    <option value="tema1">Tema 1: Conceptos Básicos</option>
                                    <option value="tema2">Tema 2: Técnicas Especializadas</option>
                                    <option value="tema3">Tema 3: Proyectos Ejemplo</option>
                                </select>
                                <button type="button" class="btn btn-outline-secondary agregarTema" title="Agregar Tema" onclick="agregarTema(this)">
                                    +
                                </button>
                            </div>
                            <div class="temasList mt-2" style="border: 1px solid #ccc; padding: 10px; min-height: 40px;">
                                <!-- Lista de temas se ordenarán aquí -->
                            </div>
                        </div>
                    </div>

                    <!-- Otras semanas se pueden agregar aquí de forma similar -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Aperturar Curso</button>
            </div>
        </div>
    </div>
</div>

<script>
    function agregarTema(button) {
        const temaSelect = button.previousElementSibling;
        const selectedTema = temaSelect.value;
        const selectedTemaText = temaSelect.options[temaSelect.selectedIndex].text;

        if (selectedTema) {
            const temasList = button.closest('.temasContainer').querySelector('.temasList');
            const newTemaDiv = document.createElement('div');
            newTemaDiv.textContent = selectedTemaText; // Text of the selected tema
            newTemaDiv.classList.add('temaItem'); // Add a class for styling if needed
            temasList.appendChild(newTemaDiv); // Append the new tema to the temas list

            // Optionally, reset the select after adding
            temaSelect.selectedIndex = 0; // Reset the select to the first option
        } else {
            alert('Por favor selecciona un tema para agregar.');
        }
    }
</script>

<!-- Modal para gestionar alumnos -->
<div class="modal fade" id="gestionarAlumnosModal" tabindex="-1" aria-labelledby="gestionarAlumnosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gestionarAlumnosModalLabel">Gestionar Alumnos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Lista de Alumnos</h5>
                <div class="mb-3">
                    <label for="buscadorAlumnos" class="form-label">Buscar por Matrícula o Nombre</label>
                    <input type="text" class="form-control" id="buscadorAlumnos" placeholder="Buscar...">
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>001</td>
                        <td>Juan</td>
                        <td>Pérez</td>
                        <td><span class="badge bg-secondary">Inscrito</span></td>
                        <td><button class="btn btn-primary" disabled>Inscribir</button></td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Ana</td>
                        <td>Gómez</td>
                        <td><span class="badge bg-secondary">No Inscrito</span></td>
                        <td><button class="btn btn-primary" onclick="inscribirAlumno(2)">Inscribir</button></td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Luis</td>
                        <td>Martínez</td>
                        <td><span class="badge bg-secondary">No Inscrito</span></td>
                        <td><button class="btn btn-primary" onclick="inscribirAlumno(3)">Inscribir</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para registrar asistencia y pagos -->
<div class="modal fade" id="registrarAsistenciaModal" tabindex="-1" aria-labelledby="registrarAsistenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarAsistenciaModalLabel">Registrar Asistencia/Pagos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Seleccionar Semana</h6>
                <div class="mb-3">
                    <label for="semanaSelect" class="form-label">Semana:</label>
                    <select class="form-select" id="semanaSelect">
                        <option>Semana 1</option>
                        <option>Semana 2</option>
                        <option>Semana 3</option>
                        <option>Semana 4</option>
                    </select>
                </div>
                <h6>Lista de Alumnos</h6>
                <div class="mb-3">
                    <label for="buscadorAsistencia" class="form-label">Buscar por Matrícula o Nombre</label>
                    <input type="text" class="form-control" id="buscadorAsistencia" placeholder="Buscar...">
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Asistió</th>
                        <th>Pago</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>001</td>
                        <td>Juan</td>
                        <td>Pérez</td>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td><input type="checkbox" class="form-check-input"></td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Ana</td>
                        <td>Gómez</td>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td><input type="checkbox" class="form-check-input"></td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Luis</td>
                        <td>Martínez</td>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td><input type="checkbox" class="form-check-input"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Registrar Asistencia/Pagos</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver resumen de cursos terminados -->
<div class="modal fade" id="verResumenModal" tabindex="-1" aria-labelledby="verResumenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verResumenModalLabel">Resumen del Curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Lista de Alumnos:</h6>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Termino</th>
                        <th>Se Retiró</th>
                        <th>Motivo de Retiro</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Juan Pérez</td>
                        <td><span class="badge bg-success">Sí</span></td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Ana Gómez</td>
                        <td><span class="badge bg-danger">No</span></td>
                        <td>2024-10-01</td>
                        <td>Cambio de curso</td>
                    </tr>
                    <tr>
                        <td>Luis Martínez</td>
                        <td><span class="badge bg-success">Sí</span></td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
