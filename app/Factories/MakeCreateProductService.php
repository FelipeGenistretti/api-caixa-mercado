<?php

namespace App\Factories;


use App\Repositories\EloquentRepository\ProductEloquentRepository;
use App\Services\CreateProductService;

class MakeCreateProductService
{
    public static function make(): CreateProductService
    {
        $repository = new ProductEloquentRepository();
        return new CreateProductService($repository);
    }
}
