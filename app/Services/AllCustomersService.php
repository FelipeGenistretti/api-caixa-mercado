<?php

namespace App\Services;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use Milon\Barcode\DNS1D;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Error;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AllCustomersService
{
    protected $customerRepository;
    
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function execute()
    {
        $customers = $this->customerRepository->allCostumers();

        if($customers->isEmpty()){
            throw new ModelNotFoundException("Nenhum cliente encontrado");
        }

        return $customers;

    }

}