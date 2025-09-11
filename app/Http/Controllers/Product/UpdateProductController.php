<?php

namespace App\Http\Controllers\Product;

use App\Factories\MakeUpdateProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use InvalidArgumentException;

class UpdateProductController extends Controller
{
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $data = $request->validated();
            $updateProductService = MakeUpdateProductService::make();
            $updatedProduct = $updateProductService->execute(
                $product,
                $data['name'] ?? null,
                $data['price'] ?? null,
                $data['category'] ?? null,
                $data['stock_qty'] ?? null
            );
            return ProductResource::make($updatedProduct);
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
