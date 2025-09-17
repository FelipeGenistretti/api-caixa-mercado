<?php

namespace App\Factories;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Services\UpdateProductService;

class MakeUpdateProductService
{
    public static function make(): UpdateProductService
    {
        $repository = new ProductEloquentRepository();
        return new UpdateProductService($repository);
    }
}
