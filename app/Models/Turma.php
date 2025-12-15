<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Adicionar se você for usar Factories
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Turma extends Model
{
    use HasFactory; // Recomendado

    protected $table = 'turmas';
    protected $primaryKey = 'id_turma';

    protected $fillable = [
        'nome',
        'professor_id',
        'disciplina_id',
    ];
    

    public function professor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'professor_id', 'id_usuario');
    }
    
  
    public function disciplina(): BelongsTo 
    {
        return $this->belongsTo(Disciplina::class, 'disciplina_id', 'id_disciplina');
    }
}