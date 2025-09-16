<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class RemoveItemCartService
{
    public function execute(int $id)
    {
        $userId = Auth::id();
        $cart = Cache::get("cart_{$userId}", []);

        if (empty($cart)) {
            throw new Exception("Carrinho vazio");
        }

        $newItems = [];
        $total = 0;
        $found = false;

        foreach ($cart as $item) {
            if ($item['id'] == $id) {
                $found = true;
                continue; 
            }

            $newItems[] = $item;
            $total += $item['price'] * $item['quantity'];
        }

        if (!$found) {
            throw new Exception("Produto não encontrado no carrinho");
        }

        Cache::put("cart_{$userId}", $newItems, 60 * 60 * 2);

        return [
            'items' => $newItems,
            'total' => $total
        ];
    }
}
