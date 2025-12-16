@extends('layout.main')
@section('title', 'Criar Turma')
@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-workspace me-2" viewBox="0 0 16 16">
                                <path d="M4 16s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H4Zm4-4.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                <path d="M12.5 10a.5.5 0 0 1 .5.5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 .5-.5ZM11 2h3a1 1 0 0 1 1 1v7h-1V3a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 0-.5.5v3H9V3a1 1 0 0 1 1-1Z"/>
                            </svg>
                            Criar Nova Turma
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('professor.criarTurma') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome da turma:</label>
                                <input type="text" id="nome" name="nome" class="form-control" 
                                    value="{{ old('nome') }}" required>
                                @error('nome')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="professor_id" class="form-label">Professor:</label>
                                <select name="professor_id" id="professor_id" class="form-select" required>
                                    <option value="">Selecione um Professor...</option>
                                    @foreach($professores as $professor)
                                        <option 
                                            value="{{ $professor->id_usuario }}"
                                            {{ old('professor_id') == $professor->id_usuario ? 'selected' : '' }}
                                        >
                                            {{ $professor->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('professor_id')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="disciplina_id" class="form-label">Disciplina:</label>
                                <select name="disciplina_id" id="disciplina_id" class="form-select" required>
                                    <option value="">Selecione uma Disciplina...</option>
                                    @foreach($disciplinas as $disciplina)
                                        <option 
                                            value="{{ $disciplina->id_disciplina }}"
                                            {{ old('disciplina_id') == $disciplina->id_disciplina ? 'selected' : '' }}
                                        >
                                            {{ $disciplina->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('disciplina_id')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Criar Turma
                                </button>
                                <a href="{{ route('professor.turmasPage') }}" class="btn btn-outline-secondary">
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