<?php

namespace App\Repositories\Eloquent;

use App\Models\Sale;
use App\Repositories\Contracts\SaleRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class SaleEloquentRepository implements SaleRepositoryInterface
{
    public function createSale(array $data)
    {   
        $sale = Sale::create($data);
        $cacheKey = "sale_id_{$sale->id}";
        Cache::put($cacheKey, $sale, 60);

        return $sale;
    }
}
