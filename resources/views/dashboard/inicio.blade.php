<div class="container">
    <h2 class="text-center mb-4">Resumen General</h2>
    <!-- Accesos Directos -->
    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-3">
            <div class="card border-success text-center">
                <div class="card-body">
                    <h5 class="card-title">Atajo a ventas</h5>
                    <a href="{{ route('dashboard.ventas') }}" class="btn btn-success">Ir a ventas</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card border-warning text-center">
                <div class="card-body">
                    <h5 class="card-title">Gestión de Usuarios</h5>
                    <a href="{{ route('dashboard.usuarios') }}" class="btn btn-warning">Ir a usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card border-danger text-center">
                <div class="card-body">
                    <h5 class="card-title">Configuraciones</h5>
                    <a href="{{ route('profile.edit') }}" class="btn btn-danger">Ir a configuraciones</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card border-secondary text-center">
                <div class="card-body">
                    <h5 class="card-title">Acceso Directo</h5>
                    <a href="/plataforma" class="btn btn-secondary">Ir a Plataforma</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Ingresos Totales -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-info h-100 mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <i class="fas fa-money-bill-wave fa-2x text-info"></i> Ingresos Totales
                    </h5>
                    <p class="card-text h2">$ {{ $totalGeneral }}</p>
                </div>
            </div>
        </div>

    </div>



    <!-- Ingresos por Proceso -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-success h-100 mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <i class="fas fa-school fa-2x text-success"></i> Ingresos Academia
                    </h5>
                    <p class="card-text h2">$ {{ $totalAcademia  }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-warning h-100 mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <i class="fas fa-scissors fa-2x text-warning"></i> Ingresos Salón
                    </h5>
                    <p class="card-text h2">$ {{ $totalCitas }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-info h-100 mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <i class="fas fa-store fa-2x text-info"></i> Ingresos Tienda
                    </h5>
                    <p class="card-text h2">$ {{ $totalVentasPedidos }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Ingresos -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div id="chart" class="h-100"></div>
        </div>
    </div>

    <!-- Detalles de Usuarios -->
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="card border-primary h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-users fa-2x text-primary"></i> Detalles de Usuarios
                    </h5>
                    <ul class="list-unstyled">
                        <li class="p-1">
                            <i class="fas fa-user text-dark mb-3"></i>
                            <span class="font-weight-bold h4">TOTAL USUARIOS: {{ $compradoresCount }}</span>
                        </li>
                        <li class="p-1"><i class="fas fa-user-tie"></i> Estilistas: [{{ $estilistasCount }}]</li>
                        <li class="p-1"><i class="fas fa-user-shield"></i> Administradores: [{{ $administradoresCount }}]</li>
                        <li class="p-1"><i class="fas fa-user-graduate"></i> Profesores: [{{ $profesoresCount }}]</li>
                        <li class="p-1"><i class="fas fa-user-graduate"></i> Estudiantes: [{{ $estudiantesCount }}]</li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card border-success h-100 mb-4">
                <div class="card-body row">
                    <div class="col-md-4 text-center">
                        <h5 class="card-title">
                            <i class="fas fa-box-open fa-2x text-success"></i> Valor de stock
                        </h5>
                        <p class="card-text h2">$ {{ $valorStock }}</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <h5 class="card-title">
                            <i class="fas fa-dollar-sign fa-2x text-success"></i> Valor stock venta
                        </h5>
                        <p class="card-text h2">$ {{ $valorStockVenta }}</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <h5 class="card-title">
                            <i class="fas fa-chart-line fa-2x text-success"></i> Ganancia Aproximada
                        </h5>
                        <p class="card-text h2">$ {{ $valorStockVenta-$valorStock }}</p>
                    </div>
                </div>
            </div>
        </div>



    </div>

</div>
