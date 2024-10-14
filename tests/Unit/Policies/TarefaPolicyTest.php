<?php

namespace Tests\Unit\Policies;

use App\Models\User;
use App\Models\Tarefa;
use App\Policies\TarefaPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TarefaPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected TarefaPolicy $tarefaPolicy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gestor = User::factory()->create(['role_id' => 1]); // Gestor
        $this->tarefaPolicy = new TarefaPolicy($this->gestor);
    }

    /** @test */
    public function a_gestor_can_update_a_tarefa()
    {
        $gestor = User::factory()->create(['role_id' => 1]); // Supondo que 1 é o ID do papel Gestor
        $tarefa = Tarefa::factory()->create(['user_id' => $gestor->id]); // A tarefa pertence ao gestor

        $this->assertTrue($this->tarefaPolicy->update($gestor, $tarefa));
    }

    /** @test */
    public function a_user_can_update_their_own_tarefa()
    {
        $user = User::factory()->create(['role_id' => 2]); // Usuário não gestor
        $tarefa = Tarefa::factory()->create(['user_id' => $user->id]); // A tarefa pertence ao usuário

        $this->assertTrue($this->tarefaPolicy->update($user, $tarefa));
    }

    /** @test */
    public function a_non_gestor_cannot_update_a_tarefa()
    {
        $user = User::factory()->create(['role_id' => 2]); // Supondo que 2 é o ID de um papel não gestor
        $tarefa = Tarefa::factory()->create(); // A tarefa não pertence ao usuário

        $this->assertFalse($this->tarefaPolicy->update($user, $tarefa));
    }

    /** @test */
    public function a_non_owner_user_cannot_update_another_users_tarefa()
    {
        $gestor = User::factory()->create(['role_id' => 1]); // Gestor
        $user = User::factory()->create(['role_id' => 2]); // Usuário não gestor
        $tarefa = Tarefa::factory()->create(['user_id' => $gestor->id]); // Tarefa pertence ao gestor

        $this->assertFalse($this->tarefaPolicy->update($user, $tarefa));
    }
}
