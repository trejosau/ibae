<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlataformaController;
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


Route::get('/salon', function () {
    return view('salon');
})->name('salon');

Route::get('/tienda', function () {
    return view('tienda');
})->name('tienda');
