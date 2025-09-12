<?php

namespace App\Factories;

use App\Repositories\Eloquent\CustomerEloquentRepository;
use App\Services\LoginCustomerService;

class MakeLoginCustomerService
{
    public static function make(): LoginCustomerService
    {
        $repository = new CustomerEloquentRepository();
        return new LoginCustomerService($repository);
    }
}
