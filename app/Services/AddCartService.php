<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AddCartService
{
    protected $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,

    ) {
        $this->productRepository = $productRepository;
    }

    public function execute(string $barcode, int $quantity = 1)
{
    $userId = Auth::id();
    $cart = Cache::get("cart_{$userId}", []);

    if (isset($cart[$barcode])) {
        $cart[$barcode]['quantity'] += $quantity;
    } else {
        $product = $this->productRepository->findProductByBarCode($barcode);

        if (!$product) {
            throw new Exception("Produto com código {$barcode} não encontrado.");
        }

        $cart[$barcode] = [
            'id'       => $product['id'],
            'name'     => $product['name'],
            'price'    => $product['price'],
            'quantity' => $quantity,
            'stock_qty'=> $product['stock_qty'], 
        ];
    }

    $totalCart = 0;
    foreach ($cart as $code => $item) {
        if ($item['stock_qty'] < $item['quantity']) {
            throw new Exception("Atualmente temos apenas {$item['stock_qty']} unidades de {$item['name']}.");
        }

        $cart[$code]['subtotal'] = $item['price'] * $item['quantity'];
        $totalCart += $cart[$code]['subtotal'];
    }

    Cache::put("cart_{$userId}", $cart, 60*60*2);

    return [
        'items' => array_values($cart),
        'total' => $totalCart
    ];
}

}
