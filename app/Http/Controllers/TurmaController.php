<?php

namespace App\Http\Controllers;

use App\Http\Requests\TurmaRequest;
use App\Models\Disciplina;
use App\Models\Turma;
use App\Models\Usuario;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index(){
        $professores = Usuario::where('role', 'professor')->get();
        $disciplinas = Disciplina::all();
        return view("turma.criar", compact("professores", "disciplinas"));
    }

    public function turmas(){
        $professores = Usuario::where('role', 'professor')->get();
        $disciplinas = Disciplina::all();
        $turmas = Turma::all();
        return view("turma.turmas", compact("turmas", "professores", "disciplinas"));
    }

    public function storeTurma(TurmaRequest $request){
        $dadosValidados = $request->validated();
        Turma::create($dadosValidados); 
        return redirect()->route('professor.turmaPage')->with('success', 'Turma criada com sucesso!');
    }

    public function deleteTurma(Turma $turma){
        $turma->delete();
        return redirect()->route('professor.turmasPage')->with('success', 'Turma deletada com sucesso!');
    }

    public function updateTurma(TurmaRequest $request, Turma $turma){
        $dadosValidados = $request->validated();
        $turma->update($dadosValidados);
        return redirect()->route('professor.turmasPage')->with('success', 'Turma atualizada com sucesso!');
    }

}
