<?php

namespace App\Factories;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Repositories\Eloquent\SaleEloquentRepository;
use App\Repositories\Eloquent\SaleItemEloquentRepository;
use App\Services\CreateSaleService;

class MakeCreateSaleService
{
    public static function make(): CreateSaleService
    {
        $productRepository = new ProductEloquentRepository();
        $saleRepository = new SaleEloquentRepository();
        $saleItemRepository = new SaleItemEloquentRepository();
        return new CreateSaleService($productRepository, $saleRepository,$saleItemRepository);
    }
}
