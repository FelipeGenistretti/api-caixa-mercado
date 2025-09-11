<?php

namespace App\Http\Controllers;

use App\Factories\MakeCreateSaleService;
use App\Http\Requests\CreateSaleRequest;
use App\Http\Resources\SaleResource;
use Illuminate\Http\JsonResponse;
use Throwable;

class CreateSaleController extends Controller
{
    public function store(CreateSaleRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $createSaleService = MakeCreateSaleService::make();
            $sale = $createSaleService->execute($data);

            return response()->json([
                'message' => 'Venda registrada com sucesso!',
                'data'    => SaleResource::make($sale),
            ], 201);

        } catch (Throwable $e) {
            return response()->json([
                'error'   => 'Erro ao registrar a venda',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
