<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    public function index()
    {
        if (session('cart')) {
            $productIds = array_column(session()->get('cart'), 'product_id');
        } else {
            $productIds = [];
        }

        return view('index', ['products' => Product::whereNotIn('id', $productIds)->get()]);
    }

    public function indexApp()
    {
        return view('app');
    }

    public function fetchProducts()
    {

        if (session('cart')) {
            $productIds = array_column(session()->get('cart'), 'product_id');
        } else {
            $productIds = [];
        }
        $products = Product::whereNotIn('id', $productIds)->get();
        return response()->json(
            [

                'products' => $products,
            ]
        );
    }
    public function fetchAllProducts()
    {

        $products = Product::all();
        return response()->json(
            [

                'products' => $products,
            ]
        );


        return view('index', ['products' => Product::whereNotIn('id', $productIds)->get()]);

    }
}
