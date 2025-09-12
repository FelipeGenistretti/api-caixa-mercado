<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthCustomerController;
use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\DeleteProductController;
use App\Http\Controllers\Product\IndexProductController;
use App\Http\Controllers\Product\ShowProductController;
use App\Http\Controllers\Product\UpdateProductController;
use App\Http\Controllers\CreateSaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rotas de API organizadas para Admin e Customer.
|
*/

// ---------------------
// ADMIN ROUTES
// ---------------------

// Login e register (sem middleware, pois ainda não estão autenticados)
Route::prefix('admin')->group(function (){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Dashboard e rotas de produtos protegidas (apenas admin)
Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('admin')->group(function (){
    Route::get('/dashboard', fn() => response()->json(['msg'=>'Bem-vindo Admin']));
});

// Rotas CRUD de produtos (apenas admin)
Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('product')->group(function (){
    Route::post('/create', [CreateProductController::class, 'store']);
    Route::put('/{product}', [UpdateProductController::class, 'update']);
    Route::delete('/{product}', [DeleteProductController::class, 'destroy']);
});

// ---------------------
// CUSTOMER ROUTES
// ---------------------

// Login e register (sem middleware)
Route::prefix('customer')->group(function (){
    Route::post('/register', [AuthCustomerController::class, 'register']);
    Route::post('/login', [AuthCustomerController::class, 'login']);
});

// Dashboard de cliente (protegido)
Route::middleware(['auth:sanctum', 'abilities:customer'])->prefix('customer')->group(function (){
    Route::get('/dashboard', fn() => response()->json(['msg'=>'Bem-vindo Cliente']));
    // Criar vendas (apenas cliente)
    Route::post('/sales', [CreateSaleController::class, 'store']);
});

// ---------------------
// PUBLIC / PRODUCT ROUTES
// ---------------------

// Rotas públicas de listagem e detalhes de produtos
Route::prefix('product')->group(function (){
    Route::get('/', [IndexProductController::class, 'index']);
    Route::get('/{id}', [ShowProductController::class, 'show']);
});
