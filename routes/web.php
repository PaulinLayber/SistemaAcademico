<?php
// routes/web.php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

// ... (Outros 'use's)

// --- ROTAS DE AUTENTICAÇÃO (Login) ---

Route::get('/', function () {
    return redirect()->route('auth.loginPage');
});

Route::prefix('auth')->group(function () {
    Route::get('/register', [UsuarioController::class, 'register'])->name('registerPage');
    Route::post('/register', [UsuarioController::class, 'store'])->name('auth.register');
    Route::post('/login', [UsuarioController::class, 'login'])->name('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/login', [UsuarioController::class, 'index'])->name('auth.loginPage'); 