<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tarefa',
        'descricao',
        'responsavel',
        'tipo_desenvolvimento',
        'nivel_dificuldade',
        'status',
        'conclusao_em',
        'concluida',
    ];
}
