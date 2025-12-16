@extends('layout.main')
@section('title', 'Listagem de Turmas')
@section('content')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Listagem de Turmas</h1>

            <a href="{{ route('professor.turmaPage') }}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2z"/>
                </svg>
                Criar
            </a>
        </div>

        @if($turmas->count() > 0)
            <div class="table-responsive shadow-sm">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="col-3">Nome</th>
                            <th scope="col" class="col-3">Professor</th>
                            <th scope="col" class="col-3">Disciplina</th>
                            <th scope="col" class="col-3 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($turmas as $turma)
                            <tr>
                                <td>{{ $turma->nome }}</td>
                                <td>{{ $turma->professor->nome }}</td>
                                <td>{{ $turma->disciplina->nome }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-info me-1" 
                                        data-bs-toggle="modal" data-bs-target="#modalVisualizar"
                                        data-nome="{{ $turma->nome }}" 
                                        data-professor="{{ $turma->professor->nome }}"
                                        data-disciplina="{{ $turma->disciplina->nome }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                        </svg>
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1"
                                        data-bs-toggle="modal" data-bs-target="#modalEditar"
                                        data-id="{{ $turma->id }}"
                                        data-nome="{{ $turma->nome }}"
                                        data-professor="{{ $turma->professor_id }}"
                                        data-disciplina="{{ $turma->disciplina_id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.29 1.29z"/>
                                            <path d="M13.52 3.856l2.364 2.364L7.498 14.803 5.134 12.44 13.52 3.856zM14 6.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h6.5v2H3v9h10V6.5z"/>
                                        </svg>
                                    </button>

                                    <form action="{{ route('professor.deletarTurma', $turma) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Tem certeza que deseja deletar a turma: {{ $turma->nome }}?')"
                                            class="btn btn-sm btn-outline-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h.5a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 0 0-1h-2a.5.5 0 0 1-.5-.5h-2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2a.5.5 0 0 1 .5.5H6.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 0 0-1H8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5h-2a.5.5 0 0 0 0 1h2a.5.5 0 0 1 .5.5h2a.5.5 0 0 1 .5.5h2a.5.5 0 0 0 0 1H13v7H3V5h2V3z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Nenhuma turma encontrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning shadow-sm" role="alert">
                Nenhuma turma cadastrada. Utilize o botão **Criar** acima para adicionar uma nova.
            </div>
        @endif
    </div>

    @if($turmas->count() > 0)
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="#" id="formEditar" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalEditarLabel">Editar Turma</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editar_nome" class="form-label">Nome:</label>
                            <input type="text" name="nome" id="editar_nome" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="editar_professor_id" class="form-label">Professor:</label>
                            <select name="professor_id" id="editar_professor_id" class="form-select" required>
                                <option value="">Selecione...</option>
                                @foreach($professores as $professor)
                                    <option value="{{ $professor->id_usuario }}">{{ $professor->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="editar_disciplina_id" class="form-label">Disciplina:</label>
                            <select name="disciplina_id" id="editar_disciplina_id" class="form-select" required>
                                <option value="">Selecione...</option>
                                @foreach($disciplinas as $disciplina)
                                    <option value="{{ $disciplina->id_disciplina }}">{{ $disciplina->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalVisualizar" tabindex="-1" aria-labelledby="modalVisualizarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="modalVisualizarLabel">Visualizar Turma</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="visualizar_nome" class="form-label fw-bold">Nome:</label>
                        <input type="text" id="visualizar_nome" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="visualizar_professor" class="form-label fw-bold">Professor:</label>
                        <input type="text" id="visualizar_professor" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="visualizar_disciplina" class="form-label fw-bold">Disciplina:</label>
                        <input type="text" id="visualizar_disciplina" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('footer')
    <script>
        // Lógica para preencher o Modal de Visualização
        $('#modalVisualizar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var nome = button.data('nome');
            var professor = button.data('professor');
            var disciplina = button.data('disciplina');

            var modal = $(this);
            modal.find('#visualizar_nome').val(nome);
            modal.find('#visualizar_professor').val(professor);
            modal.find('#visualizar_disciplina').val(disciplina);
        });

        // Lógica para preencher o Modal de Edição e configurar a action do formulário
        $('#modalEditar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nome = button.data('nome');
            var professorId = button.data('professor'); // Recebe o ID do professor
            var disciplinaId = button.data('disciplina'); // Recebe o ID da disciplina

            var modal = $(this);
            modal.find('#editar_nome').val(nome);
            
            // Seleciona o professor correto
            modal.find('#editar_professor_id').val(professorId);
            
            // Seleciona a disciplina correta
            modal.find('#editar_disciplina_id').val(disciplinaId);

            // IMPORTANTE: Define a action do formulário para o ID correto
            var updateRoute = "{{ route('professor.atualizarTurma', ':id') }}";
            modal.find('#formEditar').attr('action', updateRoute.replace(':id', id));
        });
    </script>
@endsection