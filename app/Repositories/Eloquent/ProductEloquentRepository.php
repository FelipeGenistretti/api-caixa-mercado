<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Ramsey\Uuid\Type\Time;

class ProductEloquentRepository implements ProductRepositoryInterface
{
    public function findProductById(int $id)
    {
        return Product::findOrFail($id);
    }

    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    public function findProductByName(string $name)
    {
        return Product::where('name', $name)->first();
    }

    public function findProductByBarCode(string $barcode)
    {
        return Product::where('code_bar', $barcode)->exists();
    }

    public function findAllProducts()
    {
        return Product::all();
    }

    public function updateProduct(Product $product ,array $data)
    {
        $product->update($data);
        return $product->fresh(); 
    }
}
