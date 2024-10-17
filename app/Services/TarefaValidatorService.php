<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class TarefaValidatorService
{
    public function validate($data)
    {
        return Validator::make($data, [
            'tarefa' => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo_desenvolvimento' => 'required|in:Backend,Frontend,Banco de dados,Infra',
            'nivel_dificuldade' => 'required|in:Difícil,Moderada,Fácil,Complexa,Intermediária',
            'status' => 'in:Aberta,Em andamento,Fechada,Cancelada',
            'conclusao_em' => 'nullable|date',
            'concluida' => 'boolean',
        ])->validate();
    }
}
