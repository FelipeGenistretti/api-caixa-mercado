<?php

namespace App\Services;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class RegisterCustomerCpfService
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function execute(array $data)
    {

        $customer = $this->customerRepository->findCustomerByCpf($data['cpf'] ?? null);

        if ($customer) {
            return $customer;
        }

        $customerData = [
            'name'     => $data['name'],
            'cpf'      => $data['cpf'],   
            'email'    => $data['email'] ?? null,
            'cnpj'     => $data['cnpj'] ?? null,  
            'phone'    => $data['phone'] ?? null, 
        ];

        return $this->customerRepository->createCustomer($customerData);


    }

}