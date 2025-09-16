<?php

namespace App\Http\Controllers\Product;

use App\Factories\MakeRemoveItemCartService;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Http\Controllers\Controller;

class RemoveItemCartController extends Controller
{
    public function destroy(Request $request, int $id)
    {
        try {
            $removeItemCartService = MakeRemoveItemCartService::make();

            $cart = $removeItemCartService->execute($id);

            return response()->json([
                'message' => 'Product deleted successfully',
                'data' => $cart
            ], 200);

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
