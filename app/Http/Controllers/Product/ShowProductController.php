<?php

namespace App\Http\Controllers\Product;

use App\Factories\MakeShowProductService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class ShowProductController extends Controller
{
    public function show(int $id)
    {
        try {
            $showProductService = MakeShowProductService::make();
            $product = $showProductService->execute($id);

            return ProductResource::make($product);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Product not found'
            ], 404);

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
