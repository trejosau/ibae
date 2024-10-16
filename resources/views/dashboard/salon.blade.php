@extends('layouts.app')

@section('title', 'Dashboard Salón')

@push('styles')
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 0;
    }

    main {
    padding: 20px;
    }

    /* Card styles */
    .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    height: 100%;
    }

    .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card h5 {
    font-size: 1.4rem;
    color: #ffffff;
    }

    .card h2 {
    font-size: 2.2rem;
    margin-bottom: 0;
    }

    /* Custom colors for each section */
    .card-anticipos {
    background-color: #17a2b8;
    position: relative;
    }

    .card-citas-completadas {
    background-color: #28a745;
    position: relative;
    }

    .card-servicios-demanda {
    background-color: #ffc107;
    position: relative;
    }

    .equal-height {
    display: flex;
    flex-direction: column;
    }

    /* Chart container */
    .chart-container {
    margin-top: 30px;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .chart-container h5 {
    margin-bottom: 20px;
    }

    .chart {
    height: 150px;
    }

    /* Table styles */
    .table {
    margin-top: 20px;
    }

    .rounded-table {
    border-radius: 10px;
    }
@endpush

@section('content')
    <main class="container">
        <h1 class="dashboard-header text-center">Dashboard Salón</h1>

        <!-- Sección de Total de Ingresos del Salón -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-primary text-white">
                    <h5 class="mb-3">Total de Ingresos del Salón</h5>

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
                            <div class="card card-anticipos p-4 text-white equal-height">
                                <h5 class="mb-3">Anticipos</h5>
                                <h2>$3,000</h2>
                                <p>Ingresos Totales</p>
                                <div class="chart-container">
                                    <canvas id="anticiposChart" class="chart"></canvas>
                                    <small class="text-success">+8% desde el mes anterior</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card card-citas-completadas p-4 text-white equal-height">
                                <h5 class="mb-3">Citas Completadas</h5>
                                <h2>$7,000</h2>
                                <p>Ingresos Totales</p>
                                <div class="chart-container">
                                    <canvas id="citasCompletadasChart" class="chart"></canvas>
                                    <small class="text-danger">-3% desde el mes anterior</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Total de Citas Realizadas por Estilista -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-info text-white">
                    <h5 class="mb-3">Total de Citas Realizadas por Estilista</h5>

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

                    <!-- Gráfico de Citas Realizadas por Estilista -->
                    <div class="chart-container">
                        <canvas id="citasEstilistaChart" class="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Servicios con Mayor Demanda -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-warning text-dark">
                    <h5 class="mb-3">Servicios con Mayor Demanda</h5>

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

                    <!-- Gráficos de Servicios más Demandados -->
                    <div class="chart-container">
                        <canvas id="serviciosDemandaChart" class="chart"></canvas>
                    </div>

                    <!-- Tabla de Detalles -->
                    <table class="table table-striped text-dark rounded-table mt-4">
                        <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Cantidad Realizada</th>
                            <th>Ingresos por Servicio</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Corte de Cabello</td>
                            <td>100</td>
                            <td>$2,500</td>
                        </tr>
                        <tr>
                            <td>Manicura</td>
                            <td>80</td>
                            <td>$1,200</td>
                        </tr>
                        <tr>
                            <td>Pedicura</td>
                            <td>60</td>
                            <td>$1,000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección de Servicios con Mayor Margen de Ganancia -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-success text-white">
                    <h5 class="mb-3">Servicios con Mayor Margen de Ganancia</h5>

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

                    <!-- Tabla de Servicios Rentables -->
                    <table class="table table-striped text-white rounded-table mt-4">
                        <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Margen de Ganancia</th>
                            <th>Ingresos Totales</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Corte Premium</td>
                            <td>85%</td>
                            <td>$2,000</td>
                        </tr>
                        <tr>
                            <td>Manicura Deluxe</td>
                            <td>70%</td>
                            <td>$1,500</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Gráfica de Categorías más Populares -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-danger text-white">
                    <h5 class="mb-3">Categorías de Servicios más Populares</h5>

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

                    <!-- Gráfico Circular de Categorías Populares -->
                    <div class="chart-container">
                        <canvas id="categoriasPopularesChart" class="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <!-- Scripts de gráficos -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Gráfico de Ingresos del Salón
            const ctxAnticipos = document.getElementById('anticiposChart').getContext('2d');
            const ctxCitasCompletadas = document.getElementById('citasCompletadasChart').getContext('2d');
            const ctxCitasEstilista = document.getElementById('citasEstilistaChart').getContext('2d');
            const ctxServiciosDemanda = document.getElementById('serviciosDemandaChart').getContext('2d');
            const ctxCategoriasPopulares = document.getElementById('categoriasPopularesChart').getContext('2d');

            // Gráfico de Anticipos
            new Chart(ctxAnticipos, {
                type: 'line',
                data: {
                    labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
                    datasets: [{
                        label: 'Anticipos',
                        data: [500, 600, 700, 800],
                        borderColor: '#17a2b8',
                        fill: false,
                    }]
                }
            });

            // Gráfico de Citas Completadas
            new Chart(ctxCitasCompletadas, {
                type: 'line',
                data: {
                    labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
                    datasets: [{
                        label: 'Citas Completadas',
                        data: [1000, 1100, 1050, 1150],
                        borderColor: '#28a745',
                        fill: false,
                    }]
                }
            });

            // Gráfico de Citas Realizadas por Estilista
            new Chart(ctxCitasEstilista, {
                type: 'bar',
                data: {
                    labels: ['Estilista 1', 'Estilista 2', 'Estilista 3', 'Estilista 4'],
                    datasets: [{
                        label: 'Citas Realizadas',
                        data: [30, 40, 25, 35],
                        backgroundColor: '#007bff',
                    }]
                }
            });

            // Gráfico de Servicios con Mayor Demanda
            new Chart(ctxServiciosDemanda, {
                type: 'bar',
                data: {
                    labels: ['Corte', 'Manicura', 'Pedicura', 'Masaje'],
                    datasets: [{
                        label: 'Servicios Realizados',
                        data: [100, 80, 60, 90],
                        backgroundColor: '#ffc107',
                    }]
                }
            });

            // Gráfico de Categorías Populares
            new Chart(ctxCategoriasPopulares, {
                type: 'pie',
                data: {
                    labels: ['Corte', 'Manicura', 'Pedicura'],
                    datasets: [{
                        data: [40, 30, 30],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                    }]
                }
            });
        </script>
    @endpush
@endsection
