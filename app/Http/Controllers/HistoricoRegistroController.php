<?php

namespace App\Http\Controllers;

use App\Services\HistoricoRegistroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoricoRegistroController extends Controller
{
    protected $historicoService;

    public function __construct(HistoricoRegistroService $historicoService)
    {
        $this->historicoService = $historicoService;
    }

    public function index(Request $request)
    {
        $this->authorizeUser();

        $registros = $this->historicoService->getAllRegistros();

        return response()->json($registros);
    }

    private function authorizeUser()
    {
        if (!Auth::check()) {
            abort(401, 'Unauthorized');
        }
    }
}
