<?php

namespace App\Factories;

use App\Repositories\Eloquent\CustomerEloquentRepository;
use App\Services\RegisterCustomerService;

class MakeRegisterCustomerService
{
    public static function make(): RegisterCustomerService
    {
        $repository = new CustomerEloquentRepository();
        return new RegisterCustomerService($repository);
    }
}
