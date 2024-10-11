<?php

namespace App\Http\Controllers;
use App\Models\Tarefa;

use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarefas = Tarefa::all();

        return response()->json($tarefas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tarefa' => 'required|string|max:255',
            'descricao' => 'required|string',
            'responsavel' => 'required|string|max:255',
            'tipo_desenvolvimento' => 'required|in:Backend,Frontend,Banco de dados,Infra',
            'nivel_dificuldade' => 'required|in:Difícil,Moderada,Fácil,Intermediária',
            'status' => 'in:Aberta,Fechada,Cancelada',
            'conclusao_em' => 'nullable|date',
            'concluida' => 'boolean',
        ]);

        $tarefa = Tarefa::create($validatedData);

        return response()->json($tarefa, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
