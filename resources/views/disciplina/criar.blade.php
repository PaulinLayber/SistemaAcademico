@extends('layout.main')
@section('title', 'Criar disciplina')
@section('content')

 <h1>Criar disciplina</h1>
<form action="{{ route('professor.criarDisciplina') }}" method="POST">
    @csrf
    <label for="nome">Nome da disciplina:</label>
    <input type="text" id="nome" name="nome" required>
    <br><br>
    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao" required></textarea>
    <br><br>
    <button type="submit">Criar Disciplina</button>
</form>
@endsection
@section('footer')
@endsection

