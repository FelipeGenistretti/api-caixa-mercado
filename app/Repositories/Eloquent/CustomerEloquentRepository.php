<?php

namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;

class CustomerEloquentRepository implements CustomerRepositoryInterface
{
    public function findCustomerByEmail(string $email)
    {
        return Customer::where('email', $email)->first();
    }

    public function createCustomer(array $data)
    {
        return Customer::create($data);
    }
}
