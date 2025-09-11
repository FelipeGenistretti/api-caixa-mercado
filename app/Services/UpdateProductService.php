<?php

namespace App\Services;

use App\Models\Product;
use Milon\Barcode\DNS1D;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Error;

class UpdateProductService
{
    protected $productRepository;
    
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(Product $product, array $data)
    {
        return $this->productRepository->updateProduct($product, $data);

    }
}