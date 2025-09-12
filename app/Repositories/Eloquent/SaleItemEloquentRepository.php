<?php

namespace App\Repositories\Eloquent;

use App\Models\SaleItem;
use App\Repositories\Contracts\SaleItemRepositoryInterface;

class SaleItemEloquentRepository implements SaleItemRepositoryInterface
{
     public function createSaleItem(array $data)
     {
        return SaleItem::create($data);
     }
}
