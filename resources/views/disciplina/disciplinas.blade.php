@extends('layout.main')
@section('title', 'Criar disciplina')
@section('content')

    <h1>Listagem de disciplinas</h1>
    <a href="{{ route('professor.disciplinaPage') }}">Criar</a>
    <table>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
        @forelse($disciplinas as $disciplina)
            <tr>
                <td>{{ $disciplina->nome }}</td>
                <td>{{ $disciplina->descricao }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditar"
                        data-id="{{ $disciplina->id }}" data-nome="{{ $disciplina->nome }}"
                        data-descricao="{{ $disciplina->descricao }}">
                        Editar
                    </button>
                    <form action="{{ route('professor.deletarDisciplina', $disciplina) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja deletar esta disciplina?')"
                            style="border:none; background:none; color:red; cursor:pointer;">
                            Deletar
                        </button>
                    </form>
                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalVisualizar"
                        data-id="{{ $disciplina->id }}" data-nome="{{ $disciplina->nome }}"
                        data-descricao="{{ $disciplina->descricao }}">
                        Visualizar
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Nenhuma disciplina encontrada.</td>
            </tr>
        @endforelse
    </table>

    <!-- Modal Editar -->
 @if($disciplinas->count() > 0)
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('professor.atualizarDisciplina', $disciplina) }}" id="formEditar" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Disciplina</h5>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{ $disciplina->nome }}"
                                required>
                        </div>
                        <div>
                            <label for="descricao">Descrição:</label>
                            <textarea name="descricao" id="descricao" class="form-control"
                                required>{{ $disciplina->descricao }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVisualizar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar disciplina</h5>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{ $disciplina->nome }}"
                                readonly>
                        </div>
                        <div>
                            <label for="descricao">Descrição:</label>
                            <textarea name="descricao" id="descricao" class="form-control"
                                readonly>{{ $disciplina->descricao }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('footer')
    <script>
        // Preenche o modal com os dados da disciplina clicada
        $('#modalVisualizar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nome = button.data('nome');
            var descricao = button.data('descricao');

            var modal = $(this);
            modal.find('#nome').val(nome);
            modal.find('#descricao').val(descricao);

            // Atualiza a action do formulário para a disciplina correta
            modal.find('#formEditar').attr('action', '/professor/disciplinas/' + id);
        });


        $('#modalEditar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nome = button.data('nome');
            var descricao = button.data('descricao');

            var modal = $(this);
            modal.find('#nome').val(nome);
            modal.find('#descricao').val(descricao);
        });
    </script>
@endsection