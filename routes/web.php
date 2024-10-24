<?php

use App\Http\Controllers\DashboardController;
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
    Route::get('/dashboard/inicio', [DashboardController::class, 'index'])->name('dashboard.inicio');
    Route::get('/dashboard/ventas', [DashboardController::class, 'index'])->name('dashboard.ventas');
    Route::get('/dashboard/compras', [DashboardController::class, 'index'])->name('dashboard.compras');
    Route::get('/dashboard/citas', [DashboardController::class, 'index'])->name('dashboard.citas');
    Route::get('/dashboard/servicios', [DashboardController::class, 'index'])->name('dashboard.servicios');
    Route::get('/dashboard/productos', [DashboardController::class, 'index'])->name('dashboard.productos');
    Route::get('/dashboard/usuarios', [DashboardController::class, 'index'])->name('dashboard.usuarios');
    Route::get('/dashboard/auditoria', [DashboardController::class, 'index'])->name('dashboard.auditoria');
    Route::get('/dashboard/profile', [DashboardController::class, 'index'])->name('dashboard.profile');
    Route::get('/dashboard/fetch-followers', [DashboardController::class, 'fetchFollowers'])->name('dashboard.fetch.followers');
});

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/about-us', function () {
    return view('sobrenosotros');
})->name('sobrenosotros');


Route::middleware('auth')->group(function () {
    Route::get('/plataforma', [PlataformaController::class, 'index'])->name('plataforma');
    Route::get('/plataforma/inicio', [PlataformaController::class, 'index'])->name('plataforma.inicio');
    Route::get('/plataforma/ventas', [PlataformaController::class, 'index'])->name('plataforma.ventas');
    Route::get('/plataforma/compras', [PlataformaController::class, 'index'])->name('plataforma.compras');
    Route::get('/plataforma/citas', [PlataformaController::class, 'index'])->name('plataforma.citas');
    Route::get('/plataforma/servicios', [PlataformaController::class, 'index'])->name('plataforma.servicios');
    Route::get('/plataforma/productos', [PlataformaController::class, 'index'])->name('plataforma.productos');
    Route::get('/plataforma/usuarios', [PlataformaController::class, 'index'])->name('plataforma.usuarios');
    Route::get('/plataforma/auditoria', [PlataformaController::class, 'index'])->name('plataforma.auditoria');
    Route::get('/plataforma/perfil', [PlataformaController::class, 'index'])->name('plataforma.perfil');
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
