<?php

namespace App\Services;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class RegisterCustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function execute(array $data)
    {

        $user = $this->customerRepository->findCustomerByEmail($data['email'] ?? null);

        if ($user) {
            throw ValidationException::withMessages([
                'email' => ['Já existe um usuário com este email. Faça o login.'],
            ]);
        }

        $customerData = [
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $this->hashPassoword($data['password']),
            'cpf'      => $data['cpf'] ?? null,   
            'cnpj'     => $data['cnpj'] ?? null,  
            'phone'    => $data['phone'] ?? null, 
        ];

        return $this->customerRepository->createCustomer($customerData);


    }

    protected function hashPassoword($password)
    {
        return Hash::make($password);
    }

}