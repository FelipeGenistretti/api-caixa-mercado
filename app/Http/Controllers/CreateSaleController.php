<?php

namespace App\Http\Controllers;

use App\Factories\MakeCreateSaleService;
use App\Http\Requests\CreateSaleRequest;
use App\Http\Resources\SaleResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class CreateSaleController extends Controller
{
    public function store(CreateSaleRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $data['customer_id'] = Auth::guard('customer')->id() ?? $data['customer_id']; 
            $createSaleService = MakeCreateSaleService::make();
            $sales = $createSaleService->execute($data);

            return response()->json([
                'message' => 'Venda registrada com sucesso!',
                'data'    =>  new SaleResource($sales->load('saleItems.product')),
            ], 201);

        } catch (Throwable $e) {
            return response()->json([
                'error'   => 'Erro ao registrar a venda',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
