<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

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
}
