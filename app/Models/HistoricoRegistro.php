<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoRegistro extends Model
{
    protected $table = 'historico_registros';

    protected $fillable = [
        'model_name',
        'record_id',
        'user_id',
        'action',
        'changes',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
