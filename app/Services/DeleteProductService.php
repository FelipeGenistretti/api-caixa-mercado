<?php

namespace App\Services;

use App\Models\Product;
use Milon\Barcode\DNS1D;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Error;
use InvalidArgumentException;

class DeleteProductService
{
    protected $productRepository;
    
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(Product $product)
    {
        if(!$product){
            throw new InvalidArgumentException("O Id do produto deve ser preenchido");
        }
        return $this->productRepository->deleteProduct($product);
    }
}