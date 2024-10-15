<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Adiciona os cabeçalhos CORS à resposta
        $response->headers->set('Access-Control-Allow-Origin', '*'); // Permitir todas as origens
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS'); // Métodos permitidos
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization'); // Cabeçalhos permitidos
        $response->headers->set('Access-Control-Allow-Credentials', 'true'); // Permitir credenciais (cookies, etc.)

        // Se a requisição for do tipo OPTIONS, retorne uma resposta 200
        if ($request->getMethod() === 'OPTIONS') {
            return response()->json([], 200);
        }

        return $response;
    }
}
