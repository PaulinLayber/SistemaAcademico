<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Nota;
use App\Models\Turma;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;

class DashboardController extends Controller
{
    public function index() // ou o método que renderiza o dashboard
{
    $alunos = Usuario::where('role', 'aluno')->count();
    $professores = Usuario::where('role', 'professor')->count();
    $turmas = Turma::count();
    $disciplinas = Disciplina::count();
    
    // Se for aluno, calcula sua média
    $mediaGeral = null;
    if (auth()->check() && auth()->user()->role === 'aluno') {
        $mediaGeral = Nota::where('aluno_id', auth()->id())->avg('valor');
        $mediaGeral = $mediaGeral ? number_format($mediaGeral, 2) : 'N/A';
    } else {
        // Se for professor/admin, mostra média geral de todos
        $mediaGeral = Nota::avg('valor');
        $mediaGeral = $mediaGeral ? number_format($mediaGeral, 2) : 'N/A';
    }
    
    return view('dashboard', compact('alunos', 'professores', 'turmas', 'disciplinas', 'mediaGeral'));
}
}
