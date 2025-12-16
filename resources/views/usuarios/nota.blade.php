@extends('layout.main')
@section('title', 'Nota do Aluno')
@section('content')

<h1>Notas de {{ $usuario->nome }}</h1>

@if($notas->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Disciplina</th>
                <th>Turma</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notas as $nota)
                <tr>
                    <td>{{ $nota->turma->disciplina->nome ?? 'Sem disciplina' }}</td>
                    <td>{{ $nota->turma->nome ?? 'Sem turma' }}</td>
                    <td>{{ $nota->valor }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="alert alert-info">
        Média geral: {{ number_format($notas->avg('valor'), 2) }}
    </div>
@else
    <div class="alert alert-warning">
        Nenhuma nota encontrada para este aluno.
    </div>
@endif

@endsection
@section('footer')
@endsection