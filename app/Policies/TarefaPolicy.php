<?php

namespace App\Policies;

use App\Models\Tarefa;
use App\Models\User;

class TarefaPolicy extends BasePolicy
{
    protected $user; // Adicionando a propriedade para o usuário

    public function __construct(User $user)
    {
        $this->user = $user; // Armazenando o usuário
        parent::__construct($user);
    }

    public function viewAny(): bool
    {
        return true; // Lógica para visualizar todas as tarefas
    }

    public function view(Tarefa $tarefa): bool
    {
        return true; // Lógica específica de visualização da tarefa
    }

    public function create(): bool
    {
        return true; // Lógica para criar uma tarefa
    }

    public function update(Tarefa $tarefa): bool
    {
        if ($this->isGestor()) {
            return true;
        }

        return $tarefa->user_id === $this->user->id;
    }

    public function delete(Tarefa $tarefa): bool
    {
        // Adicione aqui a lógica específica para verificar se o usuário pode deletar a tarefa
        return $this->isGestor() || $tarefa->user_id === $this->user->id; // Exemplo de lógica
    }

    public function restore(Tarefa $tarefa): bool
    {
        return $this->isGestor() || $tarefa->user_id === $this->user->id; // Exemplo de lógica
    }

    public function forceDelete(Tarefa $tarefa): bool
    {
        return $this->isGestor(); // Apenas um gestor pode forçar a exclusão
    }
}
