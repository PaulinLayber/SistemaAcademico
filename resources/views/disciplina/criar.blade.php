@extends('layout.main')
@section('title', 'Criar disciplina')
@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-journal-plus me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                            </svg>
                            Criar Nova Disciplina
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('professor.criarDisciplina') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome da disciplina:</label>
                                <input type="text" id="nome" name="nome" class="form-control" 
                                    value="{{ old('nome') }}" required>
                                @error('nome')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição:</label>
                                <textarea id="descricao" name="descricao" class="form-control" rows="4" 
                                    required>{{ old('descricao') }}</textarea>
                                @error('descricao')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-success btn-lg">
                                    Criar Disciplina
                                </button>
                                <a href="{{ route('professor.disciplinasPage') }}" class="btn btn-outline-secondary">
                                    Voltar para a Listagem
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer')
@endsection