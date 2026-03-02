<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $taxService;

    public function __construct(TaxService $taxService)
    {
        $this->taxService = $taxService;
    }

    public function createOrder($productId, $quantity)
    {
        return DB::transaction(function () use ($productId, $quantity) {

            $product = Product::findOrFail($productId);

            $subtotal = $product->base_price * $quantity;

            // Bulk discount
            $discount = 0;
            if ($quantity > 10) {
                $discount = $subtotal * 0.10;
            }

            $taxRates = $this->taxService->getRates();
            $rate = $taxRates[$product->category]
                ?? $taxRates['Default'];

            $taxableAmount = $subtotal - $discount;
            $tax = $taxableAmount * $rate;

            $total = $taxableAmount + $tax;

            return Order::create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'subtotal' => round($subtotal, 2),
                'discount' => round($discount, 2),
                'tax' => round($tax, 2),
                'total_price' => round($total, 2),
                'status' => '1',
            ]);
        });
    }
}