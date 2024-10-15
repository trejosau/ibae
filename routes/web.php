<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/inicio', [DashboardController::class, 'index'])->name('dashboard.inicio');
    Route::get('/dashboard/opcion1', [DashboardController::class, 'opcion1'])->name('dashboard.opcion1');
    Route::get('/dashboard/opcion2', [DashboardController::class, 'opcion2'])->name('dashboard.opcion2');
    Route::get('/dashboard/opcion3', [DashboardController::class, 'opcion3'])->name('dashboard.opcion3');
    Route::get('/dashboard/opcion4', [DashboardController::class, 'opcion4'])->name('dashboard.opcion4');
    Route::get('/dashboard/opcion5', [DashboardController::class, 'opcion5'])->name('dashboard.opcion5');
});

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');
