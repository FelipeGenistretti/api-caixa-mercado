<?php

namespace App\Services;

use Milon\Barcode\DNS1D;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Error;

class CreateProductService
{
    protected $productRepository;
    
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(array $data)
    {
        $product = $this->productRepository->findProductByName($data['name']);

        if($product){
            throw new Error("This product already exists");
        }

        $data['code_bar'] = $this->generateBarCode();

        return $this->productRepository->createProduct($data);

    }

    private function generateBarCode()
    {   
        do {
        $code = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        $exists = $this->productRepository->findProductByBarCode($code);
    } while ($exists);
        $generator = new DNS1D();
        $barcode = $generator->getBarcodePNG($code, 'C128');

        return $barcode;
    }
}