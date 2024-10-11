<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->string('tarefa');
            $table->string('descricao');
            $table->string('responsavel');

            $table->enum('tipo_desenvolvimento', [
                'Backend',
                'Frontend',
                'Banco de dados',
                'Infra'
            ]);

            $table->enum('nivel_dificuldade', [
                'Difícil',
                'Moderada',
                'Fácil',
                'Intermediária'
            ]);

            $table->enum('status', [
                'Aberta',
                'Fechada',
                'Cancelada'
            ])->default('Aberta');

            $table->timestamp('conclusao_em')->nullable();
            $table->boolean('concluida')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
