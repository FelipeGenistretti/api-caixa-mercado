<?php

namespace App\Http\Controllers\Product;

use App\Factories\MakeAddCartService;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCartRequest;
use App\Http\Resources\ProductResource;

class AddCartController extends Controller
{
    public function store(AddCartRequest $request)
    {
        try {
            $data = $request->validated();
            $addCartService = MakeAddCartService::make();

            $product = $addCartService->execute(
                $data['barcode'], 
                $data['quantity'] ?? 1
            );

            return response()->json([
                'message' => 'Product created successfully',
                'data' => $product
            ], 201);

        } catch (InvalidArgumentException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Unexpected error: ' . $e->getMessage()
            ], 500);
        }
    }
}