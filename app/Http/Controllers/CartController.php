<?php

namespace App\Http\Controllers;

use App\Mail\CheckOut;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Session\Session;

class CartController extends Controller
{
    public function index()
    {
        if (!session('cart')) {
            return view('cart', ['products_ids' => null]);
        } else {
            $productIds = array_column(session()->get('cart'), 'product_id');
            return view('cart', ['products' => Product::findMany($productIds),
             'total' => Product::findMany($productIds)->sum('price')]);
        }
    }

    public function cartProducts()
    {
        if (session('cart')) {
            $productIds = array_column(session()->get('cart'), 'product_id');
        } else {
         =======
            $productIds = array_column(session()->get('cart'), 'product_id');
            return view('cart', ['products' => Product::findMany($productIds),
            'total' => Product::findMany($productIds)->sum('price')]);

        }
        $products = Product::findMany($productIds);
        return response()->json([

            'products' => $products,
            'html' => view('components.cart-form')->render()
        ]);
    }

    public function postCheckout()
    {
        if (!session('cart')) {
            return redirect()->route('index');
        }

        request()->validate([
            'name' => 'required|max:200',
            'details' => 'required|min:10',
            'comments' => 'required|min:10',

        ]);

        $order = Order::create([
            'user_name' => request()->name,
            'details' => request()->details,
            'price' => request()->price,

        ]);
        foreach (session('cart') as $key => $value) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $value['product_id'],
                'product_price' => Product::find($value['product_id'])->price,

            ]);
        }

        $productIds = array_column(session()->get('cart'), 'product_id');
        $order_items = Product::findMany($productIds);

        Mail::to(env('MAIL_MANAGER'))->send(new CheckOut($order, $order_items));
        session()->forget('cart');
        session()->flash('succes', 'Your order has been placed');
        return redirect('/');
    }
}
