<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nome',
        'email',
        'password',
        'role',
    ];

    public function notas(): HasMany
    {
        return $this->hasMany(Nota::class, 'aluno_id', 'id_usuario');
    }

    public function notaEmTurma($turma_id)
    {
        if (!$turma_id) {
            return null;
        }
        
        $nota = $this->notas()->where('turma_id', $turma_id)->first();
        return $nota ? $nota->valor : null;
    }
}