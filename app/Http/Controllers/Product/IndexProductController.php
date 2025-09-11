<?php

namespace App\Http\Controllers\Product;

use App\Factories\MakeIndexProductService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use InvalidArgumentException;

class IndexProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $indexProductService = MakeIndexProductService::make();
            $products = $indexProductService->execute();

            return ProductResource::collection($products);
            
        } catch(ModelNotFoundException $e){
             return response()->json([
                'message' => $e->getMessage() ?: 'Nenhum produto encontrado.'
            ], 404);
        } catch(\Exception $e){
            return response()->json([
                'message' => 'Ocorreu um erro inesperado.'
            ], 500);
        }
    }

    
}
