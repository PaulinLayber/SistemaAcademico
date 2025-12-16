@extends('layout.main')
@section('title', 'Nota do Aluno')
@section('content')

    <div class="container mt-4">
        <h1 class="mb-4">Notas de {{ $usuario->nome }}</h1>

        @if($notas->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Disciplina</th>
                            <th scope="col">Turma</th>
                            <th scope="col">Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notas as $nota)
                            <tr>
                                <td>{{ $nota->turma->disciplina->nome ?? 'Sem disciplina' }}</td>
                                <td>{{ $nota->turma->nome ?? 'Sem turma' }}</td>
                                <td>{{ number_format($nota->valor, 2) }}</td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="alert alert-info mt-4 w-50 mx-auto text-center shadow-sm">
                <h4 class="alert-heading">Média Geral</h4>
                <p class="h2 mb-0 fw-bold">{{ number_format($notas->avg('valor'), 2) }}</p>
            </div>
        @else
            <div class="alert alert-warning shadow-sm" role="alert">
                <h4 class="alert-heading">Atenção!</h4>
                Nenhuma nota encontrada para este aluno.
            </div>
        @endif
    </div>

@endsection
@section('footer')
@endsection