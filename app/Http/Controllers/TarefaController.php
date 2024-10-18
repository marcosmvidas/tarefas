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
     *     tags={"Tarefa"},
     *     summary="Retornar uma lista das tarefas",
     *     description="Retornar os objetos dos tarefas",
     *     path="/api/tarefa",
     *     @OA\Response(response="200", description="Uma lista com tarefas"),
     *     @OA\Response(response="404", description="Nenhuma lista de tarefas encontrada"),
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
     *     tags={"Tarefa"},
     *     summary="Edita uma tarefa",
     *     description="Retornar os objetos da tarefa",
     *     path="/api/tarefa/{id}",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id da tarefa",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              format="int64",
     *         ),
     *     ),
     *     @OA\Parameter(
     *         name="descricao",
     *         in="query",
     *         description="Descrição da tarefa",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              format="str",
     *         ),
     *     ),
     *     @OA\Parameter(
     *             name="tipo_desenvolvimento",
     *             in="query",
     *             description="Tipo de desenvolvimento",
     *             required=true,
     *             @OA\Schema(
     *                  type="string",
     *                  enum={"Backend", "Frontend", "Database"},
     *                  default="Backend"
     *             ),
     *         ),
     *     @OA\Parameter(
     *         name="nivel_dificuldade",
     *         in="query",
     *         description="Nível de dificuldade",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              enum={"Fácil", "Moderada", "Difícil"},
     *              default="Moderada"
     *         ),
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status da tarefa",
     *         required=true,
     *         @OA\Schema(
     *              type="string",
     *              enum={"Aberta", "Fechada", "Cancelada"},
     *              default="Aberta"
     *         ),
     *     ),
     *     @OA\Parameter(
     *          name="concluida",
     *          in="query",
     *          description="Tarefa concluída",
     *          required=false,
     *          @OA\Schema(
     *              type="boolean",
     *              default=false
     *          ),
     *     ),
     *     @OA\Parameter(
     *         name="responsavel",
     *         in="query",
     *         description="Responsável pela tarefa (ID selecionado da tabela de usuários)",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              enum={1, 2, 3, 4},
     *         ),
     *     ),
     *
     *     @OA\Response(response="200", description="Tarefa salva com sucesso"),
     *     @OA\Response(response="422", description="Atributos não podem ser processados"),
     *     @OA\Response(response="500", description="Erro interno do servidor"),
     *     @OA\Response(response="400", description="Erro na solicitação"),
     *     @OA\Response(response="401", description="Não autorizado, autenticação requerida"),
     *     @OA\Response(response="403", description="Acesso proibido"),
     *     @OA\Response(response="404", description="Recurso não encontrado"),
     *     @OA\Response(response="409", description="Conflito ao processar a solicitação"),
     *     @OA\Response(response="429", description="Muitas solicitações, tente novamente mais tarde")
     * ),
     *
     */


    public function update(Request $request, $id)
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
