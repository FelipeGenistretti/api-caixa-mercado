<?php

namespace App\Http\Controllers\Product;

use App\Factories\MakeCreateProductService;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class CreateProductController extends Controller
{
    public function store(CreateProductRequest $request)
    {
        try {
            $data = $request->validated();
            $createProductService = MakeCreateProductService::make();

            $product = $createProductService->execute(
                $data
            );

            return response()->json([
                'message' => 'Product created successfully',
                'data' => ProductResource::make($product)
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