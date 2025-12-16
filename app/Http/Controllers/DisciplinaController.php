<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisciplinaRequest;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    public function index(){
        return view("disciplina.criar");
    }

    public function store(DisciplinaRequest $request){
        
        Disciplina::create($request->validated());
        return redirect()->route("professor.disciplinasPage")->with("success","Disciplina criadada com sucesso!");
    }

    public function disciplinas(){
        $disciplinas = Disciplina::all();
        return view("disciplina.disciplinas", compact("disciplinas"));
    }

    public function delete(Disciplina $disciplina){
        $disciplina->delete();
        return redirect()->route("professor.disciplinasPage")->with("success","Disciplina deletada com sucesso!");
    }

    public function update(DisciplinaRequest $request, Disciplina $disciplina){
        $disciplina->update($request->validated());
        return redirect()->route("professor.disciplinasPage")->with("success","Disciplina atualizada com sucesso!");
    }
}
