@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 0;
    }

    main {
    padding: 40px;
    }

    /* Encabezado del Dashboard */
    .dashboard-header {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 30px;
    }

    /* Card styles */
    .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    height: 100%;
    padding: 25px;
    margin-bottom: 30px;
    }

    .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card h5 {
    font-size: 1.6rem;
    color: #fff;
    margin-bottom: 10px;
    font-weight: 600;
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

    .card h2 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    }

    /* Add small icon at top-right */
    .icon {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 2rem;
    color: rgba(255, 255, 255, 0.7);
    }

    /* Equal card height */
    .equal-height {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
    .dashboard-header {
    font-size: 1.8rem;
    text-align: center;
    }

    .card h5 {
    text-align: center;
    }

    .card {
    padding: 15px;
    }
    }

    /* Button styles */
    .btn-custom {
    background-color: #ffffff;
    color: black;
    transition: background-color 0.3s ease;
    border-radius: 25px;
    padding: 10px 20px;
    font-size: 0.95rem;
    border: 1px solid #ccc;
    margin-top: 15px;
    }

    .btn-custom:hover {
    background-color: #f4f4f4;
    border-color: #aaa;
    }

    /* Chart container */
    .chart-container {
    margin-top: 25px;
    padding: 15px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .chart-container h5 {
    margin-bottom: 20px;
    font-size: 1.3rem;
    font-weight: 600;
    }

    /* Main chart style */
    .chart {
    height: 170px;
    }

    /* Table styles */
    .table {
    margin-top: 20px;
    }

    .rounded-table {
    border-radius: 10px;
    }

    .table th, .table td {
    padding: 15px;
    font-size: 1rem;
    }

    .table th {
    background-color: #007bff;
    color: white;
    text-align: center;
    }

    .table-striped tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
    }
@endpush

@section('content')
    <main class="container">
        <h1 class="dashboard-header text-center">Dashboard Principal</h1>

        <!-- Sección de reportes principales -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card card-academia p-4 text-white equal-height">
                    <div class="icon"><i class="fas fa-school"></i></div>
                    <h5 class="mb-3">Academia</h5>
                    <h2>$12,000</h2>
                    <p>Ingresos Totales</p>
                    <div class="chart-container">
                        <canvas id="academyChart" class="chart"></canvas>
                        <small class="text-success">+10% desde el periodo anterior</small>
                    </div>
                    <button class="btn btn-light btn-custom mt-auto">Ver detalles</button>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card card-salon p-4 text-white equal-height">
                    <div class="icon"><i class="fas fa-cut"></i></div>
                    <h5 class="mb-3">Salón</h5>
                    <h2>$8,500</h2>
                    <p>Ingresos Totales</p>
                    <div class="chart-container">
                        <canvas id="salonChart" class="chart"></canvas>
                        <small class="text-danger">-5% desde el periodo anterior</small>
                    </div>
                    <button class="btn btn-light btn-custom mt-auto">Ver detalles</button>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card card-tienda p-4 text-white equal-height">
                    <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                    <h5 class="mb-3">Tienda</h5>
                    <h2>$15,000</h2>
                    <p>Ingresos Totales</p>
                    <div class="chart-container">
                        <canvas id="storeChart" class="chart"></canvas>
                        <small class="text-success">+15% desde el periodo anterior</small>
                    </div>
                    <button class="btn btn-light btn-custom mt-auto">Ver detalles</button>
                </div>
            </div>
        </div>

        <!-- Sección de reportes secundarios -->
        <div class="row">
            <!-- Ranking de Clientes -->
            <div class="col-md-6 mb-4">
                <div class="card p-4 bg-info text-white">
                    <h5 class="mb-3">Ranking de Clientes</h5>
                    <table class="table table-striped text-white rounded-table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Ingresos Generados</th>
                            <th>Rol Principal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Cliente 1</td>
                            <td>Academia</td>
                            <td>$5000</td>
                            <td>Estudiante</td>
                        </tr>
                        <tr>
                            <td>Cliente 2</td>
                            <td>Salón</td>
                            <td>$3000</td>
                            <td>Cliente</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Cantidad de Usuarios Registrados -->
            <div class="col-md-6 mb-4">
                <div class="card p-4 bg-secondary text-white">
                    <h5 class="mb-3">Usuarios Registrados</h5>
                    <p><strong>Total: 1500</strong></p>
                    <p><strong>Estudiantes:</strong> 800</p>
                    <p><strong>Clientes:</strong> 700</p>
                </div>
            </div>

            <!-- Seguidores en Instagram -->
            <div class="col-md-6 mb-4">
                <div class="card p-4 bg-secondary text-white">
                    <h5 class="mb-3"><i class="fab fa-instagram"></i> Seguidores en Instagram</h5>
                    <p><strong>Total:</strong> 2500</p>
                </div>
            </div>

            <!-- Seguidores en Facebook -->
            <div class="col-md-6 mb-4">
                <div class="card p-4 bg-secondary text-white">
                    <h5 class="mb-3"><i class="fab fa-facebook"></i> Seguidores en Facebook</h5>
                    <p><strong>Total:</strong> 3000</p>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    const academyCtx = document.getElementById('academyChart').getContext('2d');
    const salonCtx = document.getElementById('salonChart').getContext('2d');
    const storeCtx = document.getElementById('storeChart').getContext('2d');

    // Ejemplo de gráfico para la academia
    const academyChart = new Chart(academyCtx, {
    type: 'line',
    data: {
    labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
    datasets: [{
    label: 'Academia',
    data: [500, 1000, 750, 1250, 1500, 1750, 2000],
    borderColor: 'rgba(255, 255, 255, 1)',
    backgroundColor: 'rgba(255, 255, 255, 0.2)',
    borderWidth: 2
    }]
    },
    options: {
    responsive: true,
    scales: {
    y: {
    beginAtZero: true
    }
    }
    }
    });

    // Gráfico para el salón
    const salonChart = new Chart(salonCtx, {
    type: 'line',
    data: {
    labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
    datasets: [{
    label: 'Salón',
    data: [300, 600, 450, 900, 1100, 1300, 1500],
    borderColor: 'rgba(255, 255, 255, 1)',
    backgroundColor: 'rgba(255, 255, 255, 0.2)',
    borderWidth: 2
    }]
    },
    options: {
    responsive: true,
    scales: {
    y: {
    beginAtZero: true
    }
    }
    }
    });

    // Gráfico para la tienda
    const storeChart = new Chart(storeCtx, {
    type: 'line',
    data: {
    labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
    datasets: [{
    label: 'Tienda',
    data: [700, 800, 900, 1000, 1200, 1400, 1600],
    borderColor: 'rgba(255, 255, 255, 1)',
    backgroundColor: 'rgba(255, 255, 255, 0.2)',
    borderWidth: 2
    }]
    },
    options: {
    responsive: true,
    scales: {
    y: {
    beginAtZero: true
    }
    }
    }
    });
@endpush
