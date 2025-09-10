<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function findProductById(int $id);
    public function createProduct();
}