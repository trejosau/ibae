@extends('layouts.app')

@section('title', 'Dashboard Reportes Generales')

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
    .card-report {
    background-color: #007bff;
    position: relative;
    }

    .equal-height {
    display: flex;
    flex-direction: column;
    }

    .table-responsive {
    margin-top: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn {
    background-color: #007bff;
    color: white;
    }

    .btn:hover {
    background-color: #0056b3;
    }
    </style>

@section('content')
    <main class="container">
        <h1 class="dashboard-header text-center">Dashboard Reportes Generales</h1>

        <!-- Sección de Reporte de Ventas -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card card-report p-4 text-white">
                    <h5 class="mb-3">Reporte de Ventas</h5>

                    <!-- Filtros de Período -->
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="">Elegir rango específico</option>
                                <option value="semana">Semana</option>
                                <option value="mes">Mes</option>
                                <option value="trimestre">Trimestre</option>
                                <option value="año">Año</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn w-100">Generar Reporte PDF</button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn w-100">Generar Reporte Excel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Reporte de Citas -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card card-report p-4 text-white">
                    <h5 class="mb-3">Reporte de Citas</h5>

                    <!-- Filtros de Período -->
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="">Elegir rango específico</option>
                                <option value="semana">Semana</option>
                                <option value="mes">Mes</option>
                                <option value="trimestre">Trimestre</option>
                                <option value="año">Año</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn w-100">Generar Reporte PDF</button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn w-100">Generar Reporte Excel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Reporte de Estudiantes -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card card-report p-4 text-white">
                    <h5 class="mb-3">Reporte de Estudiantes</h5>

                    <!-- Filtros de Período -->
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="">Elegir rango específico</option>
                                <option value="semana">Semana</option>
                                <option value="mes">Mes</option>
                                <option value="trimestre">Trimestre</option>
                                <option value="año">Año</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn w-100">Generar Reporte PDF</button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn w-100">Generar Reporte Excel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Reporte de Satisfacción -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card card-report p-4 text-white">
                    <h5 class="mb-3">Reporte de Satisfacción</h5>

                    <!-- Filtros de Período -->
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="">Elegir rango específico</option>
                                <option value="semana">Semana</option>
                                <option value="mes">Mes</option>
                                <option value="trimestre">Trimestre</option>
                                <option value="año">Año</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn w-100">Generar Reporte PDF</button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn w-100">Generar Reporte Excel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Reporte de Inventarios -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card card-report p-4 text-white">
                    <h5 class="mb-3">Reporte de Inventarios</h5>

                    <!-- Filtros de Período -->
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="">Elegir rango específico</option>
                                <option value="semana">Semana</option>
                                <option value="mes">Mes</option>
                                <option value="trimestre">Trimestre</option>
                                <option value="año">Año</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn w-100">Generar Reporte PDF</button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn w-100">Generar Reporte Excel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
