@extends('layout.main')
@section('title', 'Listagem de Disciplinas')
@section('content')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Listagem de disciplinas</h1>

            <a href="{{ route('professor.disciplinaPage') }}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2z"/>
                </svg>
                Criar
            </a>
        </div>

        @if($disciplinas->count() > 0)
            <div class="table-responsive shadow-sm">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="col-3">Nome</th>
                            <th scope="col" class="col-6">Descrição</th>
                            <th scope="col" class="col-3 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($disciplinas as $disciplina)
                            <tr>
                                <td>{{ $disciplina->nome }}</td>
                                <td>{{ Str::limit($disciplina->descricao, 100) }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal"
                                        data-bs-target="#modalVisualizar" data-id="{{ $disciplina->id }}"
                                        data-nome="{{ $disciplina->nome }}" data-descricao="{{ $disciplina->descricao }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                        </svg>
                                    </button>

                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                        data-bs-target="#modalEditar" data-id="{{ $disciplina->id }}"
                                        data-nome="{{ $disciplina->nome }}" data-descricao="{{ $disciplina->descricao }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.29 1.29z"/>
                                            <path d="M13.52 3.856l2.364 2.364L7.498 14.803 5.134 12.44 13.52 3.856zM14 6.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h6.5v2H3v9h10V6.5z"/>
                                        </svg>
                                    </button>

                                    <form action="{{ route('professor.deletarDisciplina', $disciplina) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Tem certeza que deseja deletar a disciplina: {{ $disciplina->nome }}?')"
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
                                <td colspan="3" class="text-center">Nenhuma disciplina encontrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning shadow-sm" role="alert">
                Nenhuma disciplina cadastrada. Utilize o botão **Criar** acima para adicionar uma nova.
            </div>
        @endif
    </div>

    @if($disciplinas->count() > 0)
        <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="#" id="formEditar" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="modalEditarLabel">Editar Disciplina</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="disciplina_id" id="editar_disciplina_id">
                            <div class="mb-3">
                                <label for="editar_nome" class="form-label">Nome:</label>
                                <input type="text" name="nome" id="editar_nome" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editar_descricao" class="form-label">Descrição:</label>
                                <textarea name="descricao" id="editar_descricao" class="form-control" rows="3" required></textarea>
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
                        <h5 class="modal-title" id="modalVisualizarLabel">Visualizar Disciplina</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="visualizar_nome" class="form-label fw-bold">Nome:</label>
                            <input type="text" id="visualizar_nome" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="visualizar_descricao" class="form-label fw-bold">Descrição:</label>
                            <textarea id="visualizar_descricao" class="form-control" rows="5" readonly></textarea>
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
            var descricao = button.data('descricao');

            var modal = $(this);
            modal.find('#visualizar_nome').val(nome);
            modal.find('#visualizar_descricao').val(descricao);
        });

        // Lógica para preencher o Modal de Edição e configurar a action do formulário
        $('#modalEditar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nome = button.data('nome');
            var descricao = button.data('descricao');

            var modal = $(this);
            modal.find('#editar_disciplina_id').val(id); // Opcional, mas bom para debug
            modal.find('#editar_nome').val(nome);
            modal.find('#editar_descricao').val(descricao);

            // IMPORTANTE: Define a action do formulário para o ID correto
            var updateRoute = "{{ route('professor.atualizarDisciplina', ':id') }}";
            modal.find('#formEditar').attr('action', updateRoute.replace(':id', id));
        });
    </script>
@endsection