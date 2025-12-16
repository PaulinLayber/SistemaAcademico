@extends('layout.main')
@section('title', 'Criar disciplina')
@section('content')

    <h1>Listagem de Turmas</h1>
    <a href="{{ route('professor.turmaPage') }}">Criar</a>
    <table>
        <tr>
            <th>Nome</th>
            <th>Professor</th>
            <th>Disciplina</th>
        </tr>
        @forelse($turmas as $turma)
            <tr>
                <td>{{ $turma->nome }}</td>
                <td>{{ $turma->professor->nome }}</td>
                <td>{{ $turma->disciplina->nome }}</td>
                <td>
                    <button
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEditar"
                        data-id="{{ $turma->id }}"
                        data-nome="{{ $turma->nome }}"
                        data-professor="{{ $turma->professor_id }}"
                        data-disciplina="{{ $turma->disciplina_id }}"
                    >
                        Editar
                    </button>

                    <form action="{{ route('professor.deletarTurma', $turma) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja deletar esta turma?')"
                            style="border:none; background:none; color:red; cursor :pointer;">
                            Deletar
                        </button>
                    </form>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalVisualizar"
                        data-id="{{ $turma->id }}" data-nome="{{ $turma->nome }}" data-professor="{{ $turma->professor->nome }}"
                        data-disciplina="{{ $turma->disciplina->nome }}">
                        Visualizar
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Nenhuma turma encontrada.</td>
            </tr>
        @endforelse
    </table>

    <!-- Modal Editar -->
    @if($turmas ->count() > 0)
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('professor.atualizarTurma', $turma) }}" id="formEditar" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Editar turma</h5>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input
                            type="text"
                            name="nome"
                            id="nome"
                            class="form-control"
                            value="{{ old('nome', $turma->nome) }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="professor_id" class="form-label">Professor:</label>
                        <select name="professor_id" id="professor_id" class="form-control" required>
                            <option value="">Selecione...</option>
                            @foreach($professores as $professor)
                                <option
                                    value="{{ $professor->id_usuario }}"
                                    {{ old('professor_id', $turma->professor_id) == $professor->id_usuario ? 'selected' : '' }}
                                >
                                    {{ $professor->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="disciplina_id" class="form-label">Disciplina:</label>
                        <select name="disciplina_id" id="disciplina_id" class="form-control" required>
                            <option value="">Selecione...</option>
                            @foreach($disciplinas as $disciplina)
                                <option
                                    value="{{ $disciplina->id_disciplina }}"
                                    {{ old('disciplina_id', $turma->disciplina_id) == $disciplina->id_disciplina ? 'selected' : '' }}
                                >
                                    {{ $disciplina->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Salvar mudanças
                    </button>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancelar
                    </button>
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
                        <input type="text" name="nome" id="nome" class="form-control" value="{{ $turma->nome }}" readonly>
                    </div>
                    <div>
                        <label for="professor">Professor:</label>
                        <input type="text" name="professor" id="professor" class="form-control"
                            value="{{ $turma->professor->nome }}" readonly>

                        <label for="disciplina">Disciplina:</label>
                        <input type="text" name="disciplina" id="disciplina" class="form-control"
                            value="{{ $turma->disciplina->nome }}" readonly>

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