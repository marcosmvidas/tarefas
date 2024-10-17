<?php

namespace App\Policies;

use App\Models\Tarefa;
use App\Models\User;

class TarefaPolicy extends BasePolicy
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function view(Tarefa $tarefa): bool
    {
        // Lógica para verificar se o usuário pode ver a tarefa
        return $this->user->role->hasAccessToScreen('tarefa', 'view');
    }

    public function update(Tarefa $tarefa): bool
    {
        // Lógica para verificar se o usuário pode atualizar a tarefa
        return $this->user->role->hasAccessToScreen('tarefa', 'update');
    }

    public function delete(Tarefa $tarefa): bool
    {
        // Lógica para verificar se o usuário pode deletar a tarefa
        return $this->user->role->hasAccessToScreen('tarefa', 'delete');
    }
}
