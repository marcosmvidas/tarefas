<?php

namespace Tests\Unit;

use App\Models\Tarefa;
use App\Services\TarefaService;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TarefaServiceTest extends TestCase
{
    use RefreshDatabase;

    private $tarefaService;

    public function setUp(): void
    {
        parent::setUp();
        $this->tarefaService = new TarefaService();
    }

    public function test_create_tarefa_successfully()
    {
        $data = [
            'tarefa' => 'Desenvolver API',
            'descricao' => 'Desenvolver API para o projeto X',
            'responsavel' => 'John Doe',
            'tipo_desenvolvimento' => 'Backend',
            'nivel_dificuldade' => 'Moderada',
            'status' => 'Aberta',
            'conclusao_em' => '2024-12-31',
            'concluida' => false,
        ];

        $userId = 1;

        $tarefa = $this->tarefaService->createTarefa($data, $userId);

        $this->assertInstanceOf(Tarefa::class, $tarefa);
        $this->assertDatabaseHas('tarefas', [
            'tarefa' => 'Desenvolver API',
            'descricao' => 'Desenvolver API para o projeto X',
            'responsavel' => 1,
            'tipo_desenvolvimento' => 'Backend',
            'nivel_dificuldade' => 'Moderada',
            'status' => 'Aberta',
            'conclusao_em' => '2024-12-31',
            'concluida' => false,
        ]);
    }

    public function test_create_tarefa_fails_with_invalid_data()
    {
        $data = [
            'descricao' => 'Desenvolver API para o projeto X',
            'responsavel' => 'John Doe',
            'tipo_desenvolvimento' => 'Backend',
            'nivel_dificuldade' => 'Moderada',
            'status' => 'Aberta',
            'conclusao_em' => '2024-12-31',
            'concluida' => false,
        ];

        $this->expectException(ValidationException::class);

        $this->tarefaService->createTarefa($data, 1);
    }

    public function test_update_tarefa_successfully()
    {
        $tarefa = Tarefa::factory()->create([
            'tarefa' => 'Tarefa antiga',
            'descricao' => 'Descrição antiga',
        ]);

        $data = [
            'tarefa' => 'Tarefa atualizada',
            'descricao' => 'Descrição atualizada',
            'responsavel' => 'João Damasceno',
            'tipo_desenvolvimento' => 'Frontend',
            'nivel_dificuldade' => 'Fácil',
            'status' => 'Fechada',
            'conclusao_em' => '2024-11-30',
            'concluida' => true,
        ];

        $updatedTarefa = $this->tarefaService->updateTarefa($tarefa, $data);

        $this->assertEquals('Tarefa atualizada', $updatedTarefa->tarefa);
        $this->assertDatabaseHas('tarefas', [
            'tarefa' => 'Tarefa atualizada',
            'descricao' => 'Descrição atualizada',
            'responsavel' => 'João Damasceno',
            'tipo_desenvolvimento' => 'Frontend',
            'nivel_dificuldade' => 'Fácil',
            'status' => 'Fechada',
            'conclusao_em' => '2024-11-30',
            'concluida' => true,
        ]);
    }
}
