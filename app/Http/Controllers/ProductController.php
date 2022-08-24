<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ProductController extends Controller
{
    public function create()
    {
        return view('product');
    }
    public function store()
    {
        $attributes = request()->validate(
            [
            'title' => ['required', ValidationRule::unique('products', 'title')],
            'description' => 'required|min:10',
            'price' => 'required',
            'image' => 'required|image',
            ]
        );

        $attributes['slug'] = $attributes['title'];
        $attributes['image'] = request()->file('image')->store('uploads');

        Product::create($attributes);

        return redirect()->back();
    }

    public function show()
    {
        if (auth()->guest()) {
            abort(HttpFoundationResponse::HTTP_FORBIDDEN);
        }
        return view('products', ['products' => Product::all()]);
    }

    public function edit(Product $product)
    {
        return view('product_edit', ['product' => $product]);
    }
    public function appEditForm(Product $product)
    {
        return response()->json(
            [

            'html' => view('components.app-edit-form', compact('product'))->render()
            ]
        );
    }
    public function appAddForm()
    {
        return response()->json(
            [

            'html' => view('components.app-add-form')->render()
            ]
        );
    }

    public function update(Product $product)
    {
        $attributes = request()->validate(
            [
            'title' => ['required', ValidationRule::unique('products', 'title')->ignore($product->id)],
            'description' => 'required|min:10',
            'price' => 'required',
            'image' => 'image',
            ]
        );

        $attributes['slug'] = $attributes['title'];
        if (isset($attributes['image'])) {
            $attributes['image'] = request()->file('image')->store('uploads');
        }
        $product->update($attributes);
        return back()->with('succes', 'Product updated');
    }
    public function appUpdate(Product $product)
    {
        $attributes = request()->validate(
            [
                'title' => ['required', ValidationRule::unique('products', 'title')->ignore($product->id)],
            'description' => 'required|min:10',
            'price' => 'required',
            'image' => 'image',
            ]
        );

        $attributes['slug'] = $attributes['title'];
        if (isset($attributes['image'])) {
            $attributes['image'] = request()->file('image')->store('uploads');
        }
        $product->update($attributes);
        return back()->with('succes', 'Product updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('succes', 'Product was deleted');
    }
    public function deleteProduct(Product $product)
    {
        $product->delete();
        return back()->with('succes', 'Product was deleted');
    }

    public function addTocart(Request $request, $id)
    {
        $product = Product::find($id);

        $product = ['product_id' => $id];
        $productIds = $request->session()->has('cart') ? array_column(session()->get('cart'), 'product_id') : [];
        if (!(in_array($id, $productIds))) {
            $request->session()->push('cart', $product);
        }

        return redirect()->route('index');
    }
    public function addToCartApp(Request $request, $id)
    {
        $product = Product::find($id);
        $product = ['product_id' => $id];
        $productIds = $request->session()->has('cart') ? array_column(session()->get('cart'), 'product_id') : [];
        if (!(in_array($id, $productIds) )) {
            $request->session()->push('cart', $product);
        }
        return redirect()->route('indexApp');
    }

    public function removeFromCart($id)
    {
        foreach (session('cart') as $key => $value) {
            if ($value['product_id'] == $id) {
                session()->pull('cart.' . $key);
            }
        }

        return redirect()->route('cart');
    }
    public function removeFromCartApp($id)
    {
        foreach (session('cart') as $key => $value) {
            if ($value['product_id'] == $id) {
                session()->pull('cart.' . $key);
            }
        }

        return redirect()->route('indexApp');
    }
}
