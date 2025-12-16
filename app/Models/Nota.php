<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';
    protected $primaryKey = 'id_nota';

    protected $fillable = [
        'valor',
        'aluno_id',
        'turma_id',
    ];

    public function aluno()
    {
        return $this->belongsTo(Usuario::class, 'aluno_id', 'id_usuario');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id', 'id_turma');
    }
}