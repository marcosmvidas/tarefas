<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ {
    UserController,
    TarefaController,
    HistoricoRegistroController
};
use Illuminate\Support\Facades\Auth;

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('eSocial')->plainTextToken;

        return response()->json([
            'token' => $token,
            'role_id' => $user->role_id,
            'usuario' => $user->name,
        ]);
    }

    return response()->json(['message' => 'Unauthorized'], 401);
});


// Agrupando rotas que exigem autenticação
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('user', UserController::class);

    // Rota personalizada para retornar a estrutura do formulário
    Route::get('/tarefa/form-structure', [TarefaController::class, 'formStructure']);

    // Rotas padrão de API para o CRUD de tarefas
    Route::apiResource('tarefa', TarefaController::class);
    Route::apiResource('historico', HistoricoRegistroController::class);
});



// Caso precisar de uma rota pública, ficará fora do agrupamento
Route::get('/public-route', function () {
    return response()->json(['message' => 'Esta é uma rota pública']);
});
