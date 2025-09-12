<?php

namespace App\Repositories\Contracts;

use App\Models\Customer;

interface CustomerRepositoryInterface
{
    public function findCustomerByEmail(string $email);
    public function createCustomer(array $data);
}