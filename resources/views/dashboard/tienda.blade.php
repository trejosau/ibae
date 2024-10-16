@extends('layouts.app')

@section('title', 'Dashboard Tienda')

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
    .card-fisica {
    background-color: #007bff;
    position: relative;
    }

    .card-online {
    background-color: #28a745;
    position: relative;
    }

    .card-comparativa {
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
        <h1 class="dashboard-header text-center">Dashboard Tienda</h1>

        <!-- Sección de Total de Ingresos en la Tienda Física -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-primary text-white">
                    <h5 class="mb-3">Total de Ingresos en la Tienda Física</h5>

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

                    <!-- Total de Ventas por Tipo -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card card-fisica p-4 text-white equal-height">
                                <h5 class="mb-3">Compra Física</h5>
                                <h2>$8,000</h2>
                                <p>Ventas Totales</p>
                                <div class="chart-container">
                                    <canvas id="compraFisicaChart" class="chart"></canvas>
                                    <small class="text-success">+12% desde el mes anterior</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card card-online p-4 text-white equal-height">
                                <h5 class="mb-3">Compra Online</h5>
                                <h2>$5,000</h2>
                                <p>Ventas Totales</p>
                                <div class="chart-container">
                                    <canvas id="compraOnlineChart" class="chart"></canvas>
                                    <small class="text-danger">-5% desde el mes anterior</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Comparativa de Ventas a Estudiantes y No Estudiantes -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-warning text-dark">
                    <h5 class="mb-3">Comparativa de Ventas a Estudiantes y No Estudiantes</h5>

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

                    <!-- Gráfico de Comparativa de Ventas -->
                    <div class="chart-container">
                        <canvas id="ventasEstudiantesChart" class="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Valor Promedio por Compra -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-info text-white">
                    <h5 class="mb-3">Valor Promedio por Compra</h5>

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

                    <!-- Valor Promedio por Compra -->
                    <div class="chart-container">
                        <h2>$150</h2>
                        <small>Promedio por compra en el periodo seleccionado</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Productos con Crecimiento Significativo -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-success text-white">
                    <h5 class="mb-3">Productos con Crecimiento Significativo</h5>

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

                    <!-- Tabla de Productos con Mayor Crecimiento -->
                    <table class="table table-striped text-white rounded-table mt-4">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Crecimiento</th>
                            <th>Ventas Totales</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Producto A</td>
                            <td>25%</td>
                            <td>$2,000</td>
                        </tr>
                        <tr>
                            <td>Producto B</td>
                            <td>18%</td>
                            <td>$1,500</td>
                        </tr>
                        <tr>
                            <td>Producto C</td>
                            <td>12%</td>
                            <td>$1,200</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección de Descuento Aplicado a Estudiantes -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-danger text-white">
                    <h5 class="mb-3">Descuento Aplicado a Estudiantes</h5>

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

                    <!-- Gráfico de Descuento Aplicado -->
                    <div class="chart-container">
                        <canvas id="descuentoEstudiantesChart" class="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Ranking de Productos Vendidos -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card p-4 bg-dark text-white">
                    <h5 class="mb-3">Ranking de Productos Vendidos</h5>

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

                    <!-- Tabla de Ranking de Productos -->
                    <table class="table table-striped text-white rounded-table mt-4">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Unidades Vendidas</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Producto X</td>
                            <td>120</td>
                        </tr>
                        <tr>
                            <td>Producto Y</td>
                            <td>95</td>
                        </tr>
                        <tr>
                            <td>Producto Z</td>
                            <td>80</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <!-- Scripts de gráficos -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Gráfico de Compra Física
            const ctxCompraFisica = document.getElementById('compraFisicaChart').getContext('2d');
            const ctxCompraOnline = document.getElementById('compraOnlineChart').getContext('2d');
            const ctxVentasEstudiantes = document.getElementById('ventasEstudiantesChart').getContext('2d');
            const ctxDescuentoEstudiantes = document.getElementById('descuentoEstudiantesChart').getContext('2d');

            new Chart(ctxCompraFisica, {
                type: 'line',
                data: {
                    labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
                    datasets: [{
                        label: 'Ventas Físicas',
                        data: [2000, 2500, 3000, 3500],
                        borderColor: '#007bff',
                        fill: false,
                    }]
                }
            });

            new Chart(ctxCompraOnline, {
                type: 'line',
                data: {
                    labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
                    datasets: [{
                        label: 'Ventas Online',
                        data: [1500, 1800, 1600, 1900],
                        borderColor: '#28a745',
                        fill: false,
                    }]
                }
            });

            // Gráfico de Comparativa de Ventas
            new Chart(ctxVentasEstudiantes, {
                type: 'bar',
                data: {
                    labels: ['Estudiantes', 'No Estudiantes'],
                    datasets: [{
                        label: 'Ventas',
                        data: [5000, 3000],
                        backgroundColor: '#ffc107',
                    }]
                }
            });

            // Gráfico de Descuento Aplicado
            new Chart(ctxDescuentoEstudiantes, {
                type: 'line',
                data: {
                    labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
                    datasets: [{
                        label: 'Descuento Aplicado',
                        data: [200, 300, 250, 400],
                        borderColor: '#dc3545',
                        fill: false,
                    }]
                }
            });
        </script>
    @endpush
@endsection
