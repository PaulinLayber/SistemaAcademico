<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Boa prática para modelos modernos
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = 'disciplinas';
    
    protected $primaryKey = 'id_disciplina';
    
    protected $fillable = [
        'nome', 
        'descricao'
    ];
}
