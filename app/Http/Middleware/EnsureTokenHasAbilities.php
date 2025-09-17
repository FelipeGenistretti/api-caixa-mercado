<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTokenHasAbilities
{
    /**
     * $abilities virá dos parâmetros da rota: e.g. abilities:admin,editor
     */
    public function handle(Request $request, Closure $next, ...$abilities)
    {
        // Usuário autenticado via token Sanctum
        $user = $request->user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Se não veio token (ex: sessão), tokenCan retorna false — tratamos como não autorizado
        foreach ($abilities as $ability) {
            // tokenCan funciona para tokens pessoais do Sanctum
            if (! $request->user()->tokenCan($ability)) {
                return response()->json(['message' => 'Forbidden. Missing ability: ' . $ability], 403);
            }
        }

        return $next($request);
    }
}
