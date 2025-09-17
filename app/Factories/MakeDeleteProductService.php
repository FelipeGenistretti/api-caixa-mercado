<?php

namespace App\Factories;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Services\DeleteProductService;

class MakeDeleteProductService
{
    public static function make(): DeleteProductService
    {
        $repository = new ProductEloquentRepository();
        return new DeleteProductService($repository);
    }
}
