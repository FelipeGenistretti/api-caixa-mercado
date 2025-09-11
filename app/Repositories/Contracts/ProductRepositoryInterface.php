<?php

namespace App\Repositories\Contracts;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function findProductById(int $id);
    public function createProduct(array $data);
    public function findProductByName(string $name);
    public function findProductByBarCode(string $barcode);
    public function findAllProducts();
    public function updateProduct(Product $product, array $data);
}