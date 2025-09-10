<?php

use App\Http\Controllers\Product\CreateProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aqui você pode registrar as rotas de API para sua aplicação. 
| Elas são carregadas pelo RouteServiceProvider e todas terão 
| automaticamente o prefixo "api".
|
*/

// Exemplo de rota protegida pelo Sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Exemplo de rota simples de teste
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

Route::post('/product/create', [CreateProductController::class, 'store']);