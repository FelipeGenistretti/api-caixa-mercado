<?php

namespace App\Http\Controllers\Product;

use App\Factories\MakeDeleteProductService;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use InvalidArgumentException;

class DeleteProductController extends Controller
{
    public function destroy(Product $product)
    {
        try {
            $deleteProductService = MakeDeleteProductService::make();
            $deleteProductService->execute($product);

            return response()->json([
                'message' => "O produto {$product->name} foi deletado com sucesso"
            ], 200);

        } catch (InvalidArgumentException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Erro interno ao deletar o produto'
            ], 500);
        }
    }
}
