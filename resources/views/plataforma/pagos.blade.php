<div class="container my-5">
    <h1 class="text-center mb-4" style="font-size: 2rem; color: #6c757d;">Gestión de Pagos por Estudiante</h1>

    <!-- Search Bar -->
    <div class="mb-4">
        <input type="text" class="form-control" id="searchInput" placeholder="Buscar por matrícula o nombre..." aria-label="Buscar">
    </div>

    <div class="row" id="studentsContainer">
        <!-- Estudiante 1 -->
        <div class="col-12">
            <div class="card mb-3 ms-0 border-light">
                <div class="card-header bg-light text-dark" id="headingAlberto" style="background-color: #e2f0d9;">
                    <h5 class="mb-0">
                        <button class="btn btn-link text-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAlberto" aria-expanded="true" aria-controls="collapseAlberto" style="text-decoration: none;">
                            Matrícula: 001 | Nombre: Alberto | Fecha Inscripción: 01/09/2024 | Monto Inscripción: $500
                        </button>
                    </h5>
                </div>
                <div id="collapseAlberto" class="collapse show" aria-labelledby="headingAlberto">
                    <div class="card-body">
                        <h6 class="font-weight-bold" style="color: #6c757d;">Cursos Inscritos:</h6>
                        <!-- Curso 1: Fotografía -->
                        <div class="card mb-2 ms-1 border-light">
                            <div class="card-header" id="headingCursoFotografia" style="background-color: #d1e7dd;">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCursoFotografia" aria-expanded="true" aria-controls="collapseCursoFotografia" style="text-decoration: none;">
                                        Fotografía (4 semanas)
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseCursoFotografia" class="collapse show" aria-labelledby="headingCursoFotografia">
                                <div class="card-body">
                                    <h6 class="font-weight-bold" style="color: #6c757d;">Detalles de Pagos:</h6>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Semana #</th>
                                                <th>Asistencia</th>
                                                <th>Fecha de Pago</th>
                                                <th>Monto</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Sí</td>
                                                <td>01/10/2024</td>
                                                <td>$200</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Sí</td>
                                                <td>08/10/2024</td>
                                                <td>$200</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Curso 2: Cocina -->
                        <div class="card mb-2 ms-1 border-light">
                            <div class="card-header" id="headingCursoCocina" style="background-color: #d1e7dd;">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCursoCocina" aria-expanded="false" aria-controls="collapseCursoCocina" style="text-decoration: none;">
                                        Cocina (2 semanas)
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseCursoCocina" class="collapse" aria-labelledby="headingCursoCocina">
                                <div class="card-body">
                                    <h6 class="font-weight-bold" style="color: #6c757d;">Detalles de Pagos:</h6>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Semana #</th>
                                                <th>Asistencia</th>
                                                <th>Fecha de Pago</th>
                                                <th>Monto</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Sí</td>
                                                <td>03/10/2024</td>
                                                <td>$150</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estudiante 2 -->
        <div class="col-12">
            <div class="card mb-3 ms-0 border-light">
                <div class="card-header bg-light text-dark" id="headingJuan" style="background-color: #e2f0d9;">
                    <h5 class="mb-0">
                        <button class="btn btn-link text-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseJuan" aria-expanded="false" aria-controls="collapseJuan" style="text-decoration: none;">
                            Matrícula: 002 | Nombre: Juan | Fecha Inscripción: 05/09/2024 | Monto Inscripción: $600
                        </button>
                    </h5>
                </div>
                <div id="collapseJuan" class="collapse" aria-labelledby="headingJuan">
                    <div class="card-body">
                        <h6 class="font-weight-bold" style="color: #6c757d;">Cursos Inscritos:</h6>
                        <!-- Curso 1: Diseño Gráfico -->
                        <div class="card mb-2 ms-1 border-light">
                            <div class="card-header" id="headingCursoDiseno" style="background-color: #d1e7dd;">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCursoDiseno" aria-expanded="true" aria-controls="collapseCursoDiseno" style="text-decoration: none;">
                                        Diseño Gráfico (6 semanas)
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseCursoDiseno" class="collapse show" aria-labelledby="headingCursoDiseno">
                                <div class="card-body">
                                    <h6 class="font-weight-bold" style="color: #6c757d;">Detalles de Pagos:</h6>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Semana #</th>
                                                <th>Asistencia</th>
                                                <th>Fecha de Pago</th>
                                                <th>Monto</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Sí</td>
                                                <td>05/10/2024</td>
                                                <td>$300</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Curso 2: Idiomas -->
                        <div class="card mb-2 ms-1 border-light">
                            <div class="card-header" id="headingCursoIdiomas" style="background-color: #d1e7dd;">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCursoIdiomas" aria-expanded="false" aria-controls="collapseCursoIdiomas" style="text-decoration: none;">
                                        Idiomas (8 semanas)
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseCursoIdiomas" class="collapse" aria-labelledby="headingCursoIdiomas">
                                <div class="card-body">
                                    <h6 class="font-weight-bold" style="color: #6c757d;">Detalles de Pagos:</h6>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Semana #</th>
                                                <th>Asistencia</th>
                                                <th>Fecha de Pago</th>
                                                <th>Monto</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Sí</td>
                                                <td>10/10/2024</td>
                                                <td>$400</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Sí</td>
                                                <td>17/10/2024</td>
                                                <td>$400</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>No</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const students = document.getElementsByClassName('col-12');

        Array.from(students).forEach(function(student) {
            const text = student.innerText.toLowerCase();
            student.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
