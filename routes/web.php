<?php

use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/sign-up', [SignUpController::class, 'showSignUpForm'])->name('showSignUpForm');
Route::post('/sign-up', [SignUpController::class, 'signUp'])->name('processSignUp');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [LoginController::class, 'login'])->name('processLogin');

Route::post('/logout', [LoginController::class, 'logout'])->name('processLogout');

Route::get('/home', function () {
    return view('home');
})->name('dashboard')->middleware('auth');
