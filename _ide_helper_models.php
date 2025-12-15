<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id_disciplina
 * @property string $nome
 * @property string|null $descricao
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disciplina newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disciplina newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disciplina query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disciplina whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disciplina whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disciplina whereIdDisciplina($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disciplina whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disciplina whereUpdatedAt($value)
 */
	class Disciplina extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_nota
 * @property numeric $valor
 * @property int $turma_id
 * @property int $aluno_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nota newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nota newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nota query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nota whereAlunoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nota whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nota whereIdNota($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nota whereTurmaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nota whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nota whereValor($value)
 */
	class Nota extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_turma
 * @property string $nome
 * @property int $disciplina_id
 * @property int|null $professor_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Disciplina $disciplina
 * @property-read \App\Models\Usuario|null $professor
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turma newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turma newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turma query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turma whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turma whereDisciplinaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turma whereIdTurma($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turma whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turma whereProfessorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turma whereUpdatedAt($value)
 */
	class Turma extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_usuario
 * @property string $nome
 * @property string $email
 * @property string $password
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereUpdatedAt($value)
 */
	class Usuario extends \Eloquent {}
}

