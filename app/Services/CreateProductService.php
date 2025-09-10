<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Error;

class CreateProductService
{
    protected $productRepository;
    
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(int $id)
    {
        $product = $this->productRepository->findProductById($id);

        if($product){
            throw new Error("This product already exists");
        }


    }

    private function generateBarCode(){
        
    }
}