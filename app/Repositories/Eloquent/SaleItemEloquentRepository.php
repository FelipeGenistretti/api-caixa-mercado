<?php

namespace App\Repositories\Eloquent;

use App\Models\SaleItem;
use App\Repositories\Contracts\SaleItemRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class SaleItemEloquentRepository implements SaleItemRepositoryInterface
{
     public function createSaleItem(array $data)
     {  
        $saleItem = SaleItem::create($data);
         $cacheKey = "sale_item_{$saleItem->id}";
         Cache::put($cacheKey, $saleItem, 60);

        return $saleItem;
     }
}
