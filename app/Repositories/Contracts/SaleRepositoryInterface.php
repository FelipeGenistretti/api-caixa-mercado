<?php

namespace App\Repositories\Contracts;

use App\Models\Sale;

interface SaleRepositoryInterface
{
    public function createSale(array $data);
    
}