<?php

namespace App\Factories;

use App\Repositories\Eloquent\CustomerEloquentRepository;
use App\Services\AllCustomersService;

class MakeAllCustomersService
{
    public static function make(): AllCustomersService
    {
        $repository = new CustomerEloquentRepository();
        return new AllCustomersService($repository);
    }
}
