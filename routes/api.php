<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\DeleteProductController;
use App\Http\Controllers\Product\IndexProductController;
use App\Http\Controllers\Product\ShowProductController;
use App\Http\Controllers\Product\UpdateProductController;
use App\Http\Controllers\CreateSaleController;
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

Route::prefix("/product")->group(function (){
    Route::post('/create', [CreateProductController::class, 'store']);
    Route::get('/', [IndexProductController::class, 'index']);
    Route::get('/{id}', [ShowProductController::class, 'show']);
    Route::put('/{product}', [UpdateProductController::class, 'update']);
    Route::delete('/{product}', [DeleteProductController::class, 'destroy']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::get('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/sales', [CreateSaleController::class, 'store']);
});

// // só admin
// Route::middleware(['auth:sanctum', 'role:admin'])->get('/users', function () {
//     return "Área de administração";
// });

// // admin OU operador
// Route::middleware(['auth:sanctum', 'role:admin,operator'])->post('/sales', function () {
//     return "Área de vendas";
// });

// // só cliente
// Route::middleware(['auth:sanctum', 'role:customer'])->get('/my-orders', function () {
//     return "Pedidos do cliente";
// });

