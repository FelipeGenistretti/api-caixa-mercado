<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function findProductById(int $id);
    public function createProduct(array $data);
    public function findProductByName(string $name);
    public function findProductByBarCode(string $barcode);
}