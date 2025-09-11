<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public function saleItems():HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
}
