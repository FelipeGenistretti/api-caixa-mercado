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

    public function execute(Product $product, ?string $name, ?float $price, ?string $category, ?int $stock_qty)
    {
        return $this->productRepository->updateProduct($product, [
            'name' => $name ?? $product->name,
            'price' => $price ?? $product->price,
            'category' => $category ?? $product->category,
            'stock_qty' => $stock_qty ?? $product->stock_qty,
        ]);
    }
}