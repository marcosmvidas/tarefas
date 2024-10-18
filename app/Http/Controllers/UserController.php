<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     /**
     * @OA\Get(
     *     tags={"Usuário"},
     *     summary="Retornar uma lista de usuários",
     *     description="Retornar os objetos dos usuários",
     *     path="/api/user",
     *     @OA\Response(response="200", description="Uma lista com usuários"),
     *     @OA\Response(response="404", description="Nenhuma lista de usuários encontrada"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     *
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
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
        //
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
