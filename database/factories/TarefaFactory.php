<?php

namespace Database\Factories;

use App\Models\Tarefa;
use Illuminate\Database\Eloquent\Factories\Factory;

class TarefaFactory extends Factory
{
    protected $model = Tarefa::class;

    public function definition()
    {
        return [
            'tarefa' => $this->faker->sentence(),
            'descricao' => $this->faker->paragraph(),
            'responsavel' => $this->faker->name(),
            'tipo_desenvolvimento' => $this->faker->randomElement(['Backend', 'Frontend', 'Banco de dados', 'Infra']),
            'nivel_dificuldade' => $this->faker->randomElement(['Difícil', 'Moderada', 'Fácil', 'Intermediária']),
            'status' => $this->faker->randomElement(['Aberta', 'Fechada', 'Cancelada']),
            'conclusao_em' => $this->faker->optional()->date(),
            'concluida' => $this->faker->boolean(),
        ];
    }
}
