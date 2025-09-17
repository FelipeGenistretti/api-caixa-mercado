<?php

namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class CustomerEloquentRepository implements CustomerRepositoryInterface
{
    public function findCustomerByEmail(string $email)
    {   
        $cacheKey = "customer_email_{$email}";
         return Cache::remember($cacheKey, 60, function () use ($email) {
            return Customer::where('email', $email)->first();
        });
    }

    public function createCustomer(array $data)
    {   
        $customer = Customer::create($data);
        $cacheKey = "customer_email_{$customer->email}";
        Cache::put($cacheKey, $customer, 60);
        return $customer; 
    }

    public function findCustomerByCpf(string $cpf)
    {
        return Customer::where("cpf", $cpf)->first();
    }


    public function allCostumers()
    {
        return Customer::all();
    }
}
