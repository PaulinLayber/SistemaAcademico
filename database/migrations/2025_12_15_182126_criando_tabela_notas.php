<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id('id_nota');
            $table->decimal('valor', 5, 2);

            $table->unsignedBigInteger('turma_id');
            $table->unsignedBigInteger('aluno_id');

            $table->foreign('turma_id')
                  ->references('id_turma')
                  ->on('turmas')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('aluno_id')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
