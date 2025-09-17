<?php

namespace App\Factories;

use App\Repositories\Eloquent\CustomerEloquentRepository;
use App\Services\RegisterCustomerCpfService;

class MakeRegisterCustomerCpfService
{
    public static function make(): RegisterCustomerCpfService
    {
        $repository = new CustomerEloquentRepository();
        return new RegisterCustomerCpfService($repository);
    }
}
