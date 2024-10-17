@extends('layouts.app')

@section('title', 'Dashboard Productos')

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
    .card-list {
    background-color: #007bff;
    position: relative;
    }

    .card-stock {
    background-color: #ffc107;
    position: relative;
    }

    .card-ordenes {
    background-color: #28a745;
    position: relative;
    }

    .equal-height {
    display: flex;
    flex-direction: column;
    }

    .table-striped {
    background-color: #ffffff;
    }

    /* Table and search styles */
    .table-responsive {
    margin-top: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .search-bar {
    margin-bottom: 20px;
    }

    </style>

@section('content')
    <main class="container">
        <h1 class="dashboard-header text-center">Dashboard Productos</h1>

        <!-- Sección de Listado de Productos -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card card-list p-4 text-white">
                    <h5 class="mb-3">Listado de Productos</h5>

                    <!-- Filtros de Búsqueda -->
                    <div class="row search-bar">
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Buscar por nombre">
                        </div>
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="">Categoría</option>
                                <option value="categoria1">Categoría 1</option>
                                <option value="categoria2">Categoría 2</option>
                                <option value="categoria3">Categoría 3</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="">Más vendido</option>
                                <option value="masvendido">Sí</option>
                                <option value="menosvendido">No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="">Stock disponible</option>
                                <option value="bajostock">Bajo stock</option>
                                <option value="agotado">Agotado</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tabla de Productos -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Categoría</th>
                                <th>Ventas</th>
                                <th>Stock</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Producto A</td>
                                <td>Categoría 1</td>
                                <td>120</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>Producto B</td>
                                <td>Categoría 2</td>
                                <td>80</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>Producto C</td>
                                <td>Categoría 3</td>
                                <td>200</td>
                                <td>5</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Órdenes a Proveedores -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card card-ordenes p-4 text-white">
                    <h5 class="mb-3">Órdenes a Proveedores</h5>

                    <!-- Formulario para crear órdenes -->
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Nombre del proveedor">
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" placeholder="Cantidad a pedir">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-light w-100">Crear Orden</button>
                        </div>
                    </div>

                    <!-- Lista de Órdenes Pendientes -->
                    <h6 class="mt-4">Órdenes Pendientes</h6>
                    <table class="table table-striped text-white rounded-table mt-4">
                        <thead>
                        <tr>
                            <th>Proveedor</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha de Creación</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Proveedor A</td>
                            <td>Producto A</td>
                            <td>50</td>
                            <td>15/10/2024</td>
                        </tr>
                        <tr>
                            <td>Proveedor B</td>
                            <td>Producto B</td>
                            <td>100</td>
                            <td>14/10/2024</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección de Visualización de Stock -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card card-stock p-4 text-white">
                    <h5 class="mb-3">Visualización de Stock</h5>

                    <!-- Filtros de Stock -->
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="">Tienda Física</option>
                                <option value="bajostock">Bajo stock</option>
                                <option value="agotado">Agotado</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="">Tienda Online</option>
                                <option value="bajostock">Bajo stock</option>
                                <option value="agotado">Agotado</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tabla de Productos con Stock Bajo -->
                    <div class="table-responsive mt-4">
                        <table class="table table-striped text-white">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Tienda</th>
                                <th>Stock Actual</th>
                                <th>Stock Mínimo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Producto A</td>
                                <td>Física</td>
                                <td>5</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>Producto B</td>
                                <td>Online</td>
                                <td>3</td>
                                <td>10</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Comparativa de Ventas por Producto -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card card-stock p-4 text-white">
                    <h5 class="mb-3">Comparativa de Ventas por Producto</h5>

                    <!-- Filtros de Período -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <select class="form-control">
                                <option value="">Elegir rango específico</option>
                                <option value="semana">Elegir semana</option>
                                <option value="mes">Elegir mes</option>
                                <option value="trimestre">Elegir trimestre</option>
                                <option value="año">Elegir año</option>
                            </select>
                        </div>
                    </div>

                    <!-- Gráfico de Comparativa de Ventas -->
                    <div class="chart-container">
                        <canvas id="comparativaVentasChart" class="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

   @endsection
