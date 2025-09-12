<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cache;


class ProductEloquentRepository implements ProductRepositoryInterface
{
    public function findProductById(int $id)
    {
        $cacheKey = "product_id_{$id}";
        return Cache::remember($cacheKey, 60, function() use ($id){
            return Product::findOrFail($id); 
        });
    }

    public function createProduct(array $data)
    {   
        $product = Product::create($data);
        $cacheKey = "pruduct_id_{$product->id}";
        Cache::put($cacheKey, $product, 60);

        return $product;
    }

    public function findProductByName(string $name)
    {   
        $cacheKey = "product_name_{$name}";
        return Cache::remember($cacheKey, 60 ,function() use ($name){
            return Product::where('name', $name)->first();
        });
    }

    public function findProductByBarCode(string $barcode)
    {
        $cacheKey = "product_barcode_" . trim($barcode);
        return Cache::remember($cacheKey, 60, function() use ($barcode) {
            return Product::where('code_bar', trim($barcode))->first();
        });
    }

    public function findAllProducts()
    {
        $cacheKey = "all_products";
        return Cache::remember($cacheKey, 60, function() {
            return Product::all();
        });
    }

    public function updateProduct(Product $product, array $data)
    {
        $oldKeys = [
            "product_name_{$product->name}",
            "product_barcode_{$product->code_bar}",
        ];

        $product->update($data);

        foreach ($oldKeys as $key) {
            Cache::forget($key);
        }
        $newKeys = [
            "product_id_{$product->id}",
            "product_name_{$product->name}",
            "product_barcode_{$product->code_bar}",
            "all_products"
        ];

        foreach ($newKeys as $key) {
            Cache::put($key, $product, 60);
        }

        return $product->fresh();
    }


    public function deleteProduct(Product $product)
    {
        $result = $product->delete();

        $cacheKeys = [
            "product_id_{$product->id}",
            "product_name_{$product->name}",
            "product_barcode_{$product->code_bar}",
            "all_products"
        ];

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }

        return $result;
    }
}
