<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

// Rota de login
// Rota de login
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('eSocial')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    return response()->json(['message' => 'Unauthorized'], 401);
});


// Agrupando rotas que exigem autenticação
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('user', UserController::class);
    Route::apiResource('tarefa', TarefaController::class);
});



// Caso precisar de uma rota pública, ficará fora do agrupamento
Route::get('/public-route', function () {
    return response()->json(['message' => 'Esta é uma rota pública']);
});
