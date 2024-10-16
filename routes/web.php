<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/inicio', [DashboardController::class, 'inicio'])->name('dashboard.inicio');
    Route::get('/dashboard/ventas', [DashboardController::class, 'ventas'])->name('dashboard.ventas');
    Route::get('/dashboard/academia', [DashboardController::class, 'academia'])->name('dashboard.academia');
    Route::get('/dashboard/salon', [DashboardController::class, 'salon'])->name('dashboard.salon');
    Route::get('/dashboard/tienda', [DashboardController::class, 'tienda'])->name('dashboard.tienda');
    Route::get('/dashboard/productos', [DashboardController::class, 'productos'])->name('dashboard.productos');
    Route::get('/dashboard/reportes', [DashboardController::class, 'reportes'])->name('dashboard.reportes');

});

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/about-us', function () {
    return view('sobrenosotros');
})->name('sobrenosotros');

Route::get('/plataforma', function () {
    return view('plataforma');
})->name('plataforma');

Route::get('/salon', function () {
    return view('salon');
})->name('salon');
