<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Models\Order;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    // POST /orders
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $order = $this->orderService->createOrder($data['product_id'], $data['quantity']);

        return response()->json($order);
    }

    // GET /orders
    public function index()
    {
        return Order::with('product')->latest()->get();
    }
}