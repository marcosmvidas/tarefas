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
        $validatedData = $this->validator->validate($data);

        return Tarefa::create(array_merge($validatedData, [
            'responsavel' => $userId,
        ]));
    }

    public function getTarefas($perPage)
    {
        if ($perPage === 'all') {
            return Tarefa::with('nomeResponsavel')->get();
        }

        return Tarefa::with('nomeResponsavel')->paginate($perPage);

    }

    public function updateTarefa(Tarefa $tarefa, $data)
    {
        $validatedData = $this->validator->validate($data);

        $tarefa->update($validatedData);

        return $tarefa;
    }

}
