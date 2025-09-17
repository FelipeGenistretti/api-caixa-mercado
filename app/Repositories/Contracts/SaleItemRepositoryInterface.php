<?php

namespace App\Repositories\Contracts;

use App\Models\SaleItem;

interface SaleItemRepositoryInterface
{
    public function createSaleItem(array $data);

}