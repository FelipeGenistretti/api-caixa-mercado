<?php

namespace App\Factories;

use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Services\AddCartService;

class MakeAddCartService
{
    public static function make(): AddCartService
    {
        $repository = new ProductEloquentRepository();
        return new AddCartService($repository);
    }
}
