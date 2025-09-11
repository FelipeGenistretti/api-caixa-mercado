<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class IndexProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute()
    {
        $products = $this->productRepository->findAllProducts();

        if($products->isEmpty()){
            throw new ModelNotFoundException("Nenhum produto encontrado");
        }

        return $products;
    }

}