<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Services\TarefaService;

use Illuminate\Http\Request;

class TarefaController extends Controller
{
    protected $tarefaService;

    public function __construct(TarefaService $tarefaService)
    {
        $this->tarefaService = $tarefaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->tarefaService->getAllTarefas());
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
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $tarefa = $this->tarefaService->createTarefa($request->all(), $request->user()->id);

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
    public function edit(Request $request, string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $tarefa = Tarefa::find($id);

        if (!$tarefa) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        $updateTarefa = $this->tarefaService->updateTarefa($tarefa, $request->all());

        return response()->json($updateTarefa, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

     /**
     * Retorna a estrutura de campos para o frontend montar o formulário.
     */
    public function formStructure()
    {
        $formStructure = [
            [
                'name' => 'tarefa',
                'label' => 'Tarefa',
                'type' => 'text',
                'required' => true,
            ],
            [
                'name' => 'status',
                'label' => 'Status',
                'type' => 'select',
                'options' => ['Aberta', 'Em andamento', 'Fechada', 'Cancelada'],
                'required' => true,
            ],
            [
                'name' => 'responsavel',
                'label' => 'Responsável',
                'type' => 'text',
                'required' => true,
            ],
            [
                'name' => 'data_conclusao',
                'label' => 'Data de Conclusão',
                'type' => 'date',
                'required' => true,
            ]
        ];

        return response()->json($formStructure);
    }

}
