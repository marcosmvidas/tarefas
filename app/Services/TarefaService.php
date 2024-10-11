<?php

namespace App\Services;

use App\Models\Tarefa;
use Illuminate\Validation\ValidationException;

class TarefaService
{
    public function createTarefa($data, $userId)
    {
        $validatedData = $this->validateTarefa($data);

        return Tarefa::create(array_merge($validatedData, [
            'responsavel' => $userId,
        ]));
    }

    private function validateTarefa($data)
    {
        return validator($data, [
            'tarefa' => 'required|string|max:255',
            'descricao' => 'required|string',
            'responsavel' => 'required|string|max:255',
            'tipo_desenvolvimento' => 'required|in:Backend,Frontend,Banco de dados,Infra',
            'nivel_dificuldade' => 'required|in:Difícil,Moderada,Fácil,Intermediária',
            'status' => 'in:Aberta,Fechada,Cancelada',
            'conclusao_em' => 'nullable|date',
            'concluida' => 'boolean',
        ])->validate();
    }

    public function getAllTarefas()
    {
        return Tarefa::all();
    }

    public function updateTarefa(Tarefa $tarefa, $data)
    {
        $validatedData = $this->validateTarefa($data);

        $tarefa->update($validatedData);

        return $tarefa;
    }

}
