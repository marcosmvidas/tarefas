<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
        /**
     * @OA\Get(
     *     tags={"Admin - Banners"},
     *     summary="Retornar uma lista de banners",
     *     description="Retornar os objetos dos banners",
     *     path="/api/v1/banner",
     *     @OA\Response(response="200", description="Uma lista com banners"),
     *     @OA\Response(response="404", description="Nenhuma lista de banners encontrada"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     *
     */

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
