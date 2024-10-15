<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarefa;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
    }

    /**
     * Método para criar tarefas com usuários randomizados.
     */
    public function createTarefas()
    {
        $users = User::all(); // Recupera todos os usuários

        // Exemplo de criação de 10 tarefas
        for ($i = 1; $i <= 10; $i++) {
            Tarefa::create([  // Use 'Tarefa' em vez de 'Task', se esse for o nome correto do modelo
                'tarefa' => "Tarefa $i",
                'descricao' => "Descrição da tarefa $i",
                'responsavel' => $users->random()->id, // Atribui um responsável aleatório
                'tipo_desenvolvimento' => 'Backend', // Pode ser aleatório também
                'nivel_dificuldade' => 'Fácil', // Pode variar entre os níveis
                'status' => 'Aberta',
                'conclusao_em' => null,
                'concluida' => false,
            ]);
        }
    }
}
