<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ShowProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(int $id)
    {
        $product = $this->productRepository->findProductById($id);

        if(!$product){
            throw new ModelNotFoundException("Nenhum produto encontrado");
        }

        return $product;
    }

}