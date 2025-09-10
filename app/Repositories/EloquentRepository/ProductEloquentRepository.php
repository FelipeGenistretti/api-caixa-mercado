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

    public function createProduct()
    {
        return Pro
    }
}
