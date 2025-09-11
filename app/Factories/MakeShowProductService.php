<?php

namespace App\Factories;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Services\ShowProductService;

class MakeShowProductService
{
    public static function make(): ShowProductService
    {
        $repository = new ProductEloquentRepository();
        return new ShowProductService($repository);
    }
}
