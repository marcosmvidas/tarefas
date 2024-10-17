<?php

namespace App\Services;

use App\Models\HistoricoRegistro;
use Illuminate\Support\Facades\Auth;

class HistoricoRegistroService
{
    public function registrarCriacao($modelName, $recordId, $userId, $data)
    {
        $this->registrarHistorico('created', $modelName, $recordId, $userId, $data);
    }

    public function registrarAtualizacao($modelName, $recordId, $userId, $oldData, $newData)
    {
        $this->registrarHistorico('updated', $modelName, $recordId, $userId, [
            'before' => $oldData,
            'after' => $newData,
        ]);
    }

    public function registrarExclusao($modelName, $recordId, $userId, $data)
    {
        $this->registrarHistorico('deleted', $modelName, $recordId, $userId, $data);
    }

    public function getAllRegistros()
    {
        return HistoricoRegistro::all();
    }

    public function getRegistroById($id)
    {
        return HistoricoRegistro::find($id);
    }

    private function registrarHistorico($action, $modelName, $recordId, $userId, $data)
    {
        HistoricoRegistro::create([
            'model_name' => $modelName,
            'record_id' => $recordId,
            'user_id' => $userId,
            'action' => $action,
            'changes' => json_encode($data),
            'created_at' => now(),
        ]);
    }
}
