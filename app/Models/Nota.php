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
        'atividade_id',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id', 'id_aluno');
    }
}
