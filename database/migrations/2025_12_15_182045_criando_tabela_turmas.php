<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id('id_turma');
            $table->string('nome', 100);

            $table->unsignedBigInteger('disciplina_id');
            $table->unsignedBigInteger('professor_id')->nullable();

            $table->foreign('disciplina_id')
                  ->references('id_disciplina')
                  ->on('disciplinas')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('professor_id')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();
            
            $table->unsignedBigInteger('aluno_id')->nullable();
            $table->foreign('aluno_id')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->nullOnDelete() // Permite que a disciplina exista sem aluno
                  ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
