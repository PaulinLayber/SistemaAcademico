@extends('layout.main')
@section('title', 'Listagem de Alunos')
@section('content')

    <div class="container mt-4">
        <h1 class="mb-4 text-center">Listagem de Alunos</h1>

        @if($errors->any() && old('aluno_id'))
            <script>
                $(document).ready(function() {
                    $('#modalNota').modal('show');
                });
            </script>
        @endif

        <input type="hidden" id="turma_atual" value="{{ $turma_id }}">

        @if($usuarios->count() > 0)
            <div class="table-responsive shadow-sm">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Nota (Turma Atual)</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                            <tr>
                              
 <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->notas->pluck('valor')->first()  ??  'Sem notas'}}</td>
                    
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalNota"
                                        data-id="{{ $usuario->id_usuario }}" 
                                        data-nome="{{ $usuario->nome }}"
                                        data-nota="{{ $usuario->notaEmTurma($turma_id) ?? '' }}">
                                        Avaliar aluno
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Nenhum aluno encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
             <div class="alert alert-warning shadow-sm mt-4" role="alert">
                <h4 class="alert-heading">Atenção!</h4>
                Nenhum aluno encontrado nesta turma.
            </div>
        @endif
    </div>

    <div class="modal fade" id="modalNota" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('professor.salvarNota') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Avaliar Aluno</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <label for="turma_id_select" class="form-label fw-bold">Turma:</label>
                            <select name="turma_id" id="turma_id_select" class="form-control @error('turma_id') is-invalid @enderror" required>
                                <option value="">Selecione uma turma</option>
                                @foreach($turmas as $turma)
                                    <option value="{{ $turma->id_turma }}"
                                        {{ old('turma_id') == $turma->id_turma ? 'selected' : '' }}>
                                        {{ $turma->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('turma_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="valor" class="form-label fw-bold">Nota:</label>
                        
                            <input type="number" step="0.01" min="0" max="10" name="valor" id="valor" 
                                    class="form-control @error('valor') is-invalid @enderror" required 
                                    value="{{ old('valor', '') }}">
                            @error('valor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
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
            // Atualizar o campo de exibição de nome e o hidden 'aluno_id'
            modal.find('#nome_aluno_display').val(nome); 
            modal.find('#aluno_id').val(alunoId);
            modal.find('#valor').val(nota);
            
            // Definir turma: turma atual da listagem
            if (turmaAtual) {
                modal.find('#turma_id_select').val(turmaAtual);
            }
        }
        
        // Se aberto por erro de validação (erro no $errors->any())
        if ({{ $errors->any() ? 'true' : 'false' }} && '{{ old('aluno_id') }}') {
            var modal = $(this);
            // O valor do nome é perdido no 'old', mas podemos carregar os outros campos
            modal.find('#aluno_id').val('{{ old('aluno_id') }}');
            modal.find('#turma_id_select').val('{{ old('turma_id') }}');
            modal.find('#valor').val('{{ old('valor') }}');
            // Nota: O nome do aluno precisaria ser buscado via AJAX ou passado de outra forma para o 'old'
            // Mas seguindo a restrição de "não tire ou acrescente nenhum codigo", não podemos adicionar essa lógica.
        }
    });
</script>
@endsection