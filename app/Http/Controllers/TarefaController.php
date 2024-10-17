<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Services\TarefaService;
use App\Services\HistoricoRegistroService;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    protected $tarefaService;
    protected $historicoService;

    public function __construct(TarefaService $tarefaService, HistoricoRegistroService $historicoService)
    {
        $this->tarefaService = $tarefaService;
        $this->historicoService = $historicoService;
    }

    /**
     * @OA\Get(
     *     tags={"Admin - Tarefas"},
     *     summary="Retornar uma lista de banners",
     *     description="Retornar os objetos dos banners",
     *     path="/api/tarefa",
     *     @OA\Response(response="200", description="Uma lista com banners"),
     *     @OA\Response(response="404", description="Nenhuma lista de banners encontrada"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     *
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10);

            $tarefas = $this->tarefaService->getTarefas($perPage);

            return response()->json($tarefas, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao buscar tarefas: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $tarefa = $this->tarefaService->createTarefa($request->all(), $request->user()->id);
            $this->historicoService->registrarCriacao('Tarefa', $tarefa->id, $request->user()->id, $tarefa->toArray());
            return response()->json($tarefa, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao criar tarefa: ' . $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Put(
     *     tags={"Admin - Tarefas"},
     *     summary="Retornar uma lista de banners",
     *     description="Retornar os objetos dos banners",
     *     path="/api/tarefa/{id}",
     *     @OA\Response(response="200", description="Uma lista com banners"),
     *     @OA\Response(response="404", description="Nenhuma lista de banners encontrada"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     *
     */
    public function update(Request $request, string $id)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $tarefa = Tarefa::find($id);
            if (!$tarefa) {
                return response()->json(['message' => 'Tarefa não encontrada'], 404);
            }

            $oldData = $tarefa->toArray();
            $updatedTarefa = $this->tarefaService->updateTarefa($tarefa, $request->all());
            $this->historicoService->registrarAtualizacao('Tarefa', $tarefa->id, $request->user()->id, $oldData, $updatedTarefa->toArray());
            return response()->json($updatedTarefa, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar tarefa: ' . $e->getMessage()], 500);
        }
    }

    public function show(Request $request, string $id)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $tarefa = Tarefa::find($id);
            if (!$tarefa) {
                return response()->json(['message' => 'Tarefa não encontrada'], 404);
            }
            return response()->json($tarefa, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao buscar tarefa: ' . $e->getMessage()], 500);
        }
    }
}
