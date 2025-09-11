<?php

namespace App\Repositories\Eloquent;

use App\Models\Sale;
use App\Repositories\Contracts\SaleRepositoryInterface;

class SaleEloquentRepository implements SaleRepositoryInterface
{
    public function createSale(array $data)
    {
        return Sale::create($data);
    }
}
