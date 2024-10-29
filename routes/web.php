<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GraficasController;
use App\Http\Controllers\loginGoogleController;
use App\Http\Controllers\PlataformaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\SalonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/inicio', [DashboardController::class, 'inicio'])->name('dashboard.inicio');
    Route::get('/dashboard/ventas', [DashboardController::class, 'ventas'])->name('dashboard.ventas');
    Route::get('/dashboard/compras', [DashboardController::class, 'compras'])->name('dashboard.compras');
    Route::get('/dashboard/citas', [DashboardController::class, 'citas'])->name('dashboard.citas');
    Route::get('/dashboard/servicios', [DashboardController::class, 'servicios'])->name('dashboard.servicios');
    Route::get('/dashboard/productos', [DashboardController::class, 'productos'])->name('dashboard.productos');
    Route::get('/dashboard/usuarios', [DashboardController::class, 'usuarios'])->name('dashboard.usuarios');
    Route::get('/dashboard/auditoria', [DashboardController::class, 'auditoria'])->name('dashboard.auditoria');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
});


Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/about-us', function () {
    return view('sobrenosotros');
})->name('sobrenosotros');

Route::get('/plataforma/', function () {
    return Redirect::route('plataforma.mis-cursos');
})->name('plataforma');

Route::middleware('auth')->group(function () {
    Route::get('/plataforma/cursos/mis-cursos', [PlataformaController::class, 'misCursos'])->name('plataforma.mis-cursos');
    Route::get('/plataforma/cursos/historial-cursos', [PlataformaController::class, 'historialCursos'])->name('plataforma.historial-cursos');
    Route::get('/plataforma/modulos/lista', [PlataformaController::class, 'listaModulos'])->name('plataforma.lista-modulos');
    Route::get('/plataforma/modulos/temas', [PlataformaController::class, 'temasModulos'])->name('plataforma.temas-modulos');
    Route::get('/plataforma/personal/estudiantes', [PlataformaController::class, 'estudiantes'])->name('plataforma.estudiantes');
    Route::get('/plataforma/personal/inscripciones', [PlataformaController::class, 'inscripciones'])->name('plataforma.inscripciones');
    Route::get('/plataforma/personal/profesores', [PlataformaController::class, 'profesores'])->name('plataforma.profesores');
    Route::get('/plataforma/finanzas/pagos', [PlataformaController::class, 'pagos'])->name('plataforma.pagos');
    Route::get('/plataforma/finanzas/historial-pagos', [PlataformaController::class, 'historialPagos'])->name('plataforma.historial-pagos');
    Route::get('/plataforma/espacio/mis-cursos', [PlataformaController::class, 'misCursosEspacio'])->name('plataforma.espacio-mis-cursos');
    Route::get('/plataforma/espacio/mis-pagos', [PlataformaController::class, 'misPagosEspacio'])->name('plataforma.espacio-mis-pagos');
    Route::get('/plataforma/espacio/perfil', [PlataformaController::class, 'perfilEspacio'])->name('plataforma.espacio-perfil');
    });



Route::get('/tienda', function () {
    return view('tienda');
})->name('tienda');
Route::get('/tienda', [ProductosController::class, 'index']);
Route::post('/tienda', [ProductosController::class, 'filtrar'])->name('productos.filtrar');

Route::get('/cursos', function () {
    return view('cursos');
})->name('cursos');


Route::get('auth/google', [loginGoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [loginGoogleController::class, 'handleGoogleCallback'])->name('login.google.callback');

Route::middleware('auth')->group(function () {
    Route::get('/salon', [SalonController::class, 'index'])->name('salon.index');
    Route::get('/salon/agendar', [SalonController::class, 'agendar'])->name('salon.agendar');
    Route::get('/salon/confirmar', [SalonController::class, 'confirmar'])->name('salon.confirmar');
});

Route::get('/graficas/colegiaturas', [GraficasController::class, 'obtenerTotalPorMesAcademia'])->name('graficas.colegiaturas');
Route::get('/graficas/salon', [GraficasController::class, 'obtenerTotalSalon'])->name('graficas.salon');
Route::get('/graficas/tienda', [GraficasController::class, 'obtenerTotalVentas'])->name('graficas.tienda');
Route::get('/graficas/data', [GraficasController::class, 'obtenerData'])->name('graficas.data');
