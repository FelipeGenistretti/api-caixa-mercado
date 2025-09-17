<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthCustomerController;
use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\DeleteProductController;
use App\Http\Controllers\Product\IndexProductController;
use App\Http\Controllers\Product\ShowProductController;
use App\Http\Controllers\Product\UpdateProductController;
use App\Http\Controllers\CreateSaleController;
use App\Http\Controllers\Product\AddCartController;
use App\Http\Controllers\Product\RemoveItemCartController;
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

Route::prefix('admin')->group(function (){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth:sanctum')->prefix('product')->group(function (){
    Route::post('/create', [CreateProductController::class, 'store']);
    Route::put('/{product}', [UpdateProductController::class, 'update']);
    Route::delete('/{product}', [DeleteProductController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('cart')->group(function (){
    Route::post('/add', [AddCartController::class, 'store']); 
    Route::delete('/remove/{id}', [RemoveItemCartController::class, 'destroy']);
});

Route::prefix('customer')->group(function (){
    Route::post('/register', [AuthCustomerController::class, 'register']);
    Route::post('/login', [AuthCustomerController::class, 'login']);
});

// Dashboard de cliente (protegido)
Route::middleware('auth:sanctum')->prefix('customer')->group(function (){
    Route::get('/dashboard', fn() => response()->json(['msg'=>'Bem-vindo Cliente']));
    Route::post('/sales', [CreateSaleController::class, 'store']);
});

Route::prefix('product')->group(function (){
    Route::get('/', [IndexProductController::class, 'index']);
    Route::get('/{id}', [ShowProductController::class, 'show']);
});

Route::prefix("customer")->group(function (){
    Route::get("/",)
})