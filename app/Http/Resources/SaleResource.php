<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SaleItemResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'customer_id' => $this->customer_id,
            'total' => $this->total,
            'payment_type' => $this->payment_type,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
            
            'items' => SaleItemResource::collection($this->whenLoaded('saleItems')),
        ];
    }
}
