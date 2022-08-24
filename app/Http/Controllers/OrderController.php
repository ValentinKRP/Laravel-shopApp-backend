<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    public function create()
    {
        $orders = Order::all();
        return view('orders', ['orders' => $orders]);
    }

    public function viewOrder($id)
    {
        $order = Order::find($id);
        $orderItems = OrderItem::where('order_id', $id)->get();
        $orderProducts = [];
        foreach ($orderItems as $item) {
            $product = Product::find($item->product_id);
            $orderProducts[] = $product;
        }

        return view('order', ['order' => $order, 'orderProducts' => $orderProducts]);
    }

    public function fetchOrder($id)
    {
        $order = Order::find($id);
        $orderItems = OrderItem::where('order_id', $id)->get();
        $orderProducts = [];
        foreach ($orderItems as $item) {
            $product = Product::find($item->product_id);
            $orderProducts[] = $product;
        }

        return response()->json(
            [

            'order' => $order,
            'orderItems' => $orderProducts,
            ]
        );
    }

    public function fetchOrders()
    {
        $orders = Order::all();
        return response()->json(
            [

            'orders' => $orders,
            ]
        );
    }
}
