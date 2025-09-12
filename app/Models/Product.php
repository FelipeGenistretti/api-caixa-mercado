<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';


    // Permite o Mass Assignment nesses campos:
    protected $guarded = [];
    
    public function saleItems():HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function stockMovements():HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

}
