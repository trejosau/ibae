@extends('layouts.app')

@push('styles')
    <style>
        .container {
        margin-top: 120px;
        }
        </style>

@endpush

@section('title', 'Dashboard Academia')


@section('content')
    <main class="container">
        <h1 class="dashboard-header text-center">Dashboard Academia</h1>

        <!-- Sección de Total de Ingresos en la Academia -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-primary text-white">
                    <h5 class="mb-3">Total de Ingresos en la Academia</h5>

                    <!-- Filtros de Período -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="rango-especifico">Elegir rango específico</option>
                                <option value="semana">Elegir semana</option>
                                <option value="mes">Elegir mes</option>
                                <option value="trimestre">Elegir trimestre</option>
                                <option value="año">Elegir año</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <!-- Desglose de Ingresos -->
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="card card-inscripciones p-4 text-white equal-height">
                                <h5 class="mb-3">Inscripciones</h5>
                                <h2>$8,000</h2>
                                <p>Ingresos Totales</p>
                                <div class="chart-container">
                                    <canvas id="inscripcionesChart" class="chart"></canvas>
                                    <small class="text-success">+15% desde el mes anterior</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card card-colegiaturas p-4 text-white equal-height">
                                <h5 class="mb-3">Colegiaturas</h5>
                                <h2>$12,000</h2>
                                <p>Ingresos Totales</p>
                                <div class="chart-container">
                                    <canvas id="colegiaturasChart" class="chart"></canvas>
                                    <small class="text-danger">-8% desde el mes anterior</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card card-certificacion p-4 text-white equal-height">
                                <h5 class="mb-3">Certificación</h5>
                                <h2>$5,000</h2>
                                <p>Ingresos Totales</p>
                                <div class="chart-container">
                                    <canvas id="certificacionChart" class="chart"></canvas>
                                    <small class="text-success">+10% desde el mes anterior</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Cantidad de Alumnos Inscritos por Periodo -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-info text-white">
                    <h5 class="mb-3">Cantidad de Alumnos Inscritos por Periodo</h5>

                    <!-- Filtros de Período -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="rango-especifico">Elegir rango específico</option>
                                <option value="semana">Elegir semana</option>
                                <option value="mes">Elegir mes</option>
                                <option value="trimestre">Elegir trimestre</option>
                                <option value="año">Elegir año</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <!-- Gráfico de Inscritos -->
                    <div class="chart-container">
                        <canvas id="alumnosInscritosChart" class="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Colegiaturas Pagadas/No Pagadas -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-warning text-dark">
                    <h5 class="mb-3">Colegiaturas Pagadas/No Pagadas</h5>

                    <!-- Filtros de Período -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="rango-especifico">Elegir rango específico</option>
                                <option value="semana">Elegir semana</option>
                                <option value="mes">Elegir mes</option>
                                <option value="trimestre">Elegir trimestre</option>
                                <option value="año">Elegir año</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <!-- Tabla de Colegiaturas -->
                    <table class="table table-striped text-dark rounded-table">
                        <thead>
                        <tr>
                            <th>Alumno</th>
                            <th>Fecha de Pago</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Alumno 1</td>
                            <td>10/02/2024</td>
                            <td class="text-danger">No Pagada</td>
                        </tr>
                        <tr>
                            <td>Alumno 2</td>
                            <td>12/02/2024</td>
                            <td class="text-success">Pagada</td>
                        </tr>
                        <tr>
                            <td>Alumno 3</td>
                            <td>15/02/2024</td>
                            <td class="text-danger">No Pagada</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección de Ranking de Alumnos -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-success text-white">
                    <h5 class="mb-3">Ranking de Alumnos</h5>

                    <!-- Filtros de Período -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="rango-especifico">Elegir rango específico</option>
                                <option value="semana">Elegir semana</option>
                                <option value="mes">Elegir mes</option>
                                <option value="trimestre">Elegir trimestre</option>
                                <option value="año">Elegir año</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tabla de Ranking -->
                    <table class="table table-striped text-white rounded-table">
                        <thead>
                        <tr>
                            <th>Alumno</th>
                            <th>Total Gastado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Alumno 1</td>
                            <td>$1,500</td>
                        </tr>
                        <tr>
                            <td>Alumno 2</td>
                            <td>$1,200</td>
                        </tr>
                        <tr>
                            <td>Alumno 3</td>
                            <td>$1,000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección de Indicador de Satisfacción -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-dark text-white">
                    <h5 class="mb-3">Indicador de Satisfacción</h5>

                    <!-- Filtros de Período -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="rango-especifico">Elegir rango específico</option>
                                <option value="semana">Elegir semana</option>
                                <option value="mes">Elegir mes</option>
                                <option value="trimestre">Elegir trimestre</option>
                                <option value="año">Elegir año</option>
                            </select>
                        </div>
                    </div>

                    <!-- Gráfico de Satisfacción Promedio -->
                    <div class="chart-container">
                        <canvas id="satisfaccionChart" class="chart"></canvas>
                    </div>

                </div>
            </div>
        </div>

    </main>

@endsection

