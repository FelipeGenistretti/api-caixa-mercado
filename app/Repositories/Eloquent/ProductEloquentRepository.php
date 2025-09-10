<?php

namespace App\Repositories\EloquentRepository;

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
        return Product::where('bar_code', $barcode)->exists();
    }
}
