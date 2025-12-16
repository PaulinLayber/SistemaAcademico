@extends('layout.main')
@section('title', 'Listagem de Alunos')
@section('content')

    <h1>Listagem de alunos</h1>

    <!-- Script para abrir modal automaticamente se houver erro -->
    @if($errors->any() && old('aluno_id'))
        <script>
            $(document).ready(function() {
                $('#modalNota').modal('show');
            });
        </script>
    @endif

    <!-- Campo oculto para passar a turma atual para o JavaScript -->
    <input type="hidden" id="turma_atual" value="{{ $turma_id }}">

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Nota</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->notas->pluck('valor')->first()  ??  'Sem notas'}}</td>
                    <td>
                        <!-- Botão Avaliar/Editar Nota -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNota"
                            data-id="{{ $usuario->id_usuario }}" 
                            data-nome="{{ $usuario->nome }}"
                            data-nota="{{ $usuario->notaEmTurma($turma_id) ?? '' }}">
                            Avaliar aluno
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhum aluno encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal Avaliar/Editar Nota -->
    <div class="modal fade" id="modalNota" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('professor.salvarNota') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Avaliar Aluno</h5>
                    </div>
                    <div class="modal-body">
                        <!-- Hidden para enviar o ID do aluno -->
                        <input type="hidden" name="aluno_id" id="aluno_id" value="{{ old('aluno_id', '') }}">
                        
                        <!-- Hidden para manter a turma atual da listagem -->
                        <input type="hidden" name="turma_atual" value="{{ $turma_id }}">
                        
                        <!-- Apenas exibe o nome -->
                        <div class="mb-3">
                            <label for="nome_aluno" class="form-label">Aluno:</label>
                            <input type="hidden" id="nome_aluno" class="form-control" name="aluno_id"
                                value="{{ $usuario->id_usuario }}" readonly>
                            <input type="text" value="{{ $usuario->nome }}" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="turma_id" class="form-label">Turma:</label>
                            <select name="turma_id" id="turma_id_select" class="form-control" required>
                                <option value="">Selecione uma turma</option>
                                @foreach($turmas as $turma)
                                    <option value="{{ $turma->id_turma }}"
                                        {{ old('turma_id') == $turma->id_turma ? 'selected' : '' }}>
                                        {{ $turma->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('turma_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="valor" class="form-label">Nota:</label>
                          
                            <input type="text" step="0.01" min="0" max="10" name="valor" id="valor" 
                                   class="form-control" required 
                                   value="{{ $usuario->notas->pluck('valor')->first()  ??  ''}}">
                            @error('valor')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('footer')
<script>
    // Modal Avaliar/Editar Nota - SOMENTE quando aberto pelo botão
    $('#modalNota').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        
        // Se foi aberto por um botão (não por erro de validação)
        if (button.length > 0) {
            var alunoId = button.data('id');
            var nome = button.data('nome');
            var nota = button.data('nota');
            var turmaAtual = $('#turma_atual').val();

            var modal = $(this);
            modal.find('#aluno_id').val(alunoId);
            modal.find('#nome_aluno').val(nome);
            modal.find('#valor').val(nota);
            
            // Definir turma: turma atual da listagem
            if (turmaAtual) {
                modal.find('#turma_id_select').val(turmaAtual);
            }
        }
    });
</script>
@endsection