<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SaleItemRepositoryInterface;
use App\Repositories\Contracts\SaleRepositoryInterface;
use Illuminate\Support\Facades\Log;

class CreateSaleService
{
    protected $productRepository;
    protected $saleRepository;
    protected $saleItemRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        SaleRepositoryInterface $saleRepository,
        SaleItemRepositoryInterface $saleItemRepository
    ) {
        $this->productRepository = $productRepository;
        $this->saleRepository = $saleRepository;
        $this->saleItemRepository = $saleItemRepository;
    }

    public function execute(array $data)
    {
        $sale = $this->saleRepository->createSale([
            'user_id'     => $data['user_id'],
            'customer_id' => ,
            'total'       => 0,
            'payment_type'=> $data['payment_type'],
        ]);

        $total = 0;

        foreach ($data['items'] as $itemData) {
            $product = $this->productRepository->findProductByBarCode($itemData['code_bar']);

            if (!$product) {
                throw new \Exception("Produto com código {$itemData['code_bar']} não encontrado.");
            }

            if ($product->stock_qty < $itemData['quantity']) {
                throw new \Exception("Estoque insuficiente para {$product->name}.");
            }

            $subtotal = $product->price * $itemData['quantity'];
            $total += $subtotal;

            $this->saleItemRepository->createSaleItem([
                'sale_id'    => $sale->id,
                'product_id' => $product->id,
                'quantity'   => $itemData['quantity'],
                'unit_price' => $product->price,
                'subtotal'   => $subtotal,
            ]);
            
            $product->stock_qty -= $itemData['quantity'];
            $product->save();
            if ($product->stock_qty < 10) {
                Log::warning("Estoque baixo para {$product->name}. Restam apenas {$product->stock_qty} unidades."); //dps trocar por diparo de emaill
            }
        }
        $sale->total = $total;
        $sale->save();

        return $sale;
    }
}
