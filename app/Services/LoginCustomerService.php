<?php

namespace App\Services;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class LoginCustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function execute(array $data)
    {

        $customer = $this->customerRepository->findCustomerByEmail($data['email']);

        if (!$customer || Hash::check($data['password'], $customer->password)) {
            throw ValidationException::withMessages([
                'message' => ['Credenciais inválidas'],
            ]);
        }

        return $customer;

    }


}