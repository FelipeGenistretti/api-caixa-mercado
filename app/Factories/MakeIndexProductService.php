<?php

namespace App\Factories;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Services\IndexProductService;

class MakeIndexProductService
{
    public static function make(): IndexProductService
    {
        $repository = new ProductEloquentRepository();
        return new IndexProductService($repository);
    }
}
