<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends Model
{
    /** @use HasFactory<\Database\Factories\SaleItemFactory> */
    use HasFactory;

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function sale():BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
