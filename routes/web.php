<?php
// routes/web.php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\TurmaController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

// ... (Outros 'use's)

// --- ROTAS DE AUTENTICAÇÃO (Login) ---


Route::get('/', function () {
    return view ('dashboard');
})->name('dashboard');

Route::prefix('auth')->group(function () {
    // Rota GET para exibir a página de login: URI será '/auth/login'
    Route::get('/login', [UsuarioController::class, 'index'])->name('auth.loginPage');

    // Rota POST para submeter o formulário de login: URI será '/auth/login'
    Route::post('/login', [UsuarioController::class, 'login'])->name('auth.login');

    // Rotas de Registro
    Route::get('/register', [UsuarioController::class, 'register'])->name('registerPage'); // Ou 'auth.registerPage'
    Route::post('/register', [UsuarioController::class, 'store'])->name('auth.register');
    Route::get('/logout', [UsuarioController::class, 'logout'])->name('auth.logout');
});

Route::middleware(['auth'])->group(function () {
Route::prefix('disciplina')->group(function () {
    Route::get('', [DisciplinaController::class, 'index'])->name('professor.disciplinaPage')->middleware('can:isAdmin');
    Route::post('/criar', [DisciplinaController::class, 'store'])->name('professor.criarDisciplina')->middleware('can:isAdmin');
    Route::get('/lista', [DisciplinaController::class, 'disciplinas'])->name('professor.disciplinasPage')->middleware('can:isAdmin');
    Route::delete('/delete/{disciplina}', [DisciplinaController::class, 'delete'])->name('professor.deletarDisciplina')->middleware('can:isAdmin');
    Route::put('/update/{disciplina}', [DisciplinaController::class, 'update'])->name('professor.atualizarDisciplina')->middleware('can:isAdmin');
});

Route::prefix('turma')->group(function () {
    Route::get('', [TurmaController::class, 'index'])->name('professor.turmaPage')->middleware('can:isAdmin');
    Route::get('/lista', [TurmaController::class, 'turmas'])->name('professor.turmasPage')->middleware('can:isAdmin');
    Route::post('/criar', [TurmaController::class, 'storeTurma'])->name('professor.criarTurma')->middleware('can:isAdmin');
    Route::delete('/delete/{turma}', [TurmaController::class, 'deleteTurma'])->name('professor.deletarTurma')->middleware('can:isAdmin');
    Route::put('/update/{turma}', [TurmaController::class, 'updateTurma'])->name('professor.atualizarTurma')->middleware('can:isAdmin');
});

Route::prefix('usuarios')->group(function () {
    Route::get('/lista', [UsuarioController::class, 'listarUsuarios'])->name('usuarios.lista')->middleware('can:isProfessor');
    Route::delete('/delete/{usuario}', [UsuarioController::class, 'deletarAluno'])->name('professor.deletarAluno')->middleware('can:isAdmin');
    Route::post('/professor/salvar-nota', [UsuarioController::class, 'salvarNota'])->name('professor.salvarNota')->middleware('can:isProfessor');
    Route::get('/nota-usuario', [UsuarioController::class, 'notaUsuario'])->name('aluno.notaUsuario')->middleware('can:isAluno');
});
 

});
Route::get('/login', [UsuarioController::class, 'index'])->name('auth.loginPage');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');