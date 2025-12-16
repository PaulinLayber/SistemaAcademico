@extends('layout.main')
@section('title', 'Criar disciplina')
@section('content')

    <h1>Criar turma</h1>
    <form action="{{ route('professor.criarTurma') }}" method="POST">
        @csrf
        <label for="nome">Nome da turma:</label>
        <input type="text" id="nome" name="nome" required>
        <br>

        <label for="descricao">Professor:</label>
        <select name="professor_id" id="professor_id" required>
            <option value="">Selecione...</option>
            @foreach($professores as $professor)
                <option value="{{ $professor->id_usuario}}">{{ $professor->nome }}</option>
            @endforeach
        </select>
        <br>

        <label for="disciplinas">Disciplinas:</label>
        <select name="disciplina_id" id="disciplina_id" required>
            <option value="">Selecione...</option>
            @foreach($disciplinas as $disciplina)
                <option value="{{ $disciplina->id_disciplina }}">{{ $disciplina->nome }}</option>
            @endforeach
        </select>

        <button type="submit">Criar Disciplina</button>
    </form>
@endsection
@section('footer')
@endsection