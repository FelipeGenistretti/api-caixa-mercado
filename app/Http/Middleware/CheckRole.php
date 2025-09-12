<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // se não estiver autenticado ou o role não estiver na lista permitida
        if (!$user || !in_array($user->role, $roles)) {
            return response()->json(['error' => 'Acesso negado.'], 403);
        }

        return $next($request);
    }
}
