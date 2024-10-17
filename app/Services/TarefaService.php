<?php

namespace App\Services;

use App\Models\Tarefa;

class TarefaService
{
    protected $validator;

    public function __construct(TarefaValidatorService $validator)
    {
        $this->validator = $validator;
    }

    public function createTarefa($data, $userId)
    {
        // Usar o serviço de validação
        $validatedData = $this->validator->validate($data);

        return Tarefa::create(array_merge($validatedData, [
            'responsavel' => $userId,
        ]));
    }

    public function getAllTarefas()
    {
        return Tarefa::with('nomeResponsavel')->get();
    }

    public function updateTarefa(Tarefa $tarefa, $data)
    {
        // Usar o serviço de validação
        $validatedData = $this->validator->validate($data);

        $tarefa->update($validatedData);

        return $tarefa;
    }
}
