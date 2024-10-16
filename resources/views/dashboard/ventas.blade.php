@extends('layouts.app')

@section('title', 'Dashboard Ventas')

<style>
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
    .card-academia {
    background-color: #007bff;
    position: relative;
    }

    .card-salon {
    background-color: #28a745;
    position: relative;
    }

    .card-tienda {
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
    </style>

@section('content')
    <main class="container">
        <h1 class="dashboard-header text-center">Dashboard Ventas</h1>

        <!-- Sección de Total de Ventas por Proceso -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-primary text-white">
                    <h5 class="mb-3">Total de Ventas por Proceso</h5>

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

                    <!-- Desglose de Ventas por Proceso -->
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card card-academia p-4 text-white equal-height">
                                <h5 class="mb-3">Academia</h5>
                                <h2>$12,000</h2>
                                <p>Ventas Totales</p>
                                <div class="chart-container">
                                    <canvas id="academyChart" class="chart"></canvas>
                                    <small class="text-success">+10% desde el mes anterior</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card card-salon p-4 text-white equal-height">
                                <h5 class="mb-3">Salón</h5>
                                <h2>$8,500</h2>
                                <p>Ventas Totales</p>
                                <div class="chart-container">
                                    <canvas id="salonChart" class="chart"></canvas>
                                    <small class="text-danger">-5% desde el mes anterior</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card card-tienda p-4 text-white equal-height">
                                <h5 class="mb-3">Tienda</h5>
                                <h2>$15,000</h2>
                                <p>Ventas Totales</p>
                                <div class="chart-container">
                                    <canvas id="storeChart" class="chart"></canvas>
                                    <small class="text-success">+15% desde el mes anterior</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Ranking de Clientes -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-info text-white">
                    <h5 class="mb-3">Ranking de Clientes</h5>

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

                    <!-- Tabla de Ranking de Clientes -->
                    <table class="table table-striped text-white rounded-table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Proceso</th>
                            <th>Ventas Generadas</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Cliente 1</td>
                            <td>Academia</td>
                            <td>$5000</td>
                        </tr>
                        <tr>
                            <td>Cliente 2</td>
                            <td>Salón</td>
                            <td>$3000</td>
                        </tr>
                        <tr>
                            <td>Cliente 3</td>
                            <td>Tienda</td>
                            <td>$7000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección de Comparativa Estudiantes vs No Estudiantes -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-warning text-dark">
                    <h5 class="mb-3">Comparativa Estudiantes vs No Estudiantes</h5>

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

                    <!-- Ventas por Categoría -->
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Cat 1</strong></p>
                            <p>Total Ventas: $5000</p>
                            <p>Ventas Estudiantes: $1700</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Cat 2</strong></p>
                            <p>Total Ventas: $5000</p>
                            <p>Ventas Estudiantes: $2300</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Cat 3</strong></p>
                            <p>Total Ventas: $10000</p>
                            <p>Ventas Estudiantes: $4000</p>
                        </div>
                    </div>

                    <!-- Gráfico de Comparativa -->
                    <div class="chart-container">
                        <canvas id="studentComparisonChart" class="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection
