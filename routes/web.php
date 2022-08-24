<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class,'index'])->name('index');
Route::get('/app', [IndexController::class,'indexApp'])->name('indexApp');
Route::get('/app-index', [IndexController::class,'fetchProducts']);
Route::get('/app-products', [IndexController::class,'fetchAllProducts'])->middleware('admin');
Route::get('/app-cart', [CartController::class,'cartProducts']);

Route::get('/cart', [CartController::class,'index'])->name('cart');
Route::get('/add-to-cart/{id}', [ProductController::class,'addToCart'])->name('addToCart');

Route::get('/app-add-cart/{id}', [ProductController::class,'addToCartApp']);
Route::get('/remove-from-cart/{id}', [ProductController::class,'removeFromCart'])->name('removeFromCart');
Route::get('/app-remove-cart/{id}', [ProductController::class,'removeFromCartApp']);

Route::get('/remove-from-cart/{id}', [ProductController::class,'removeFromCart'])->name('removeFromCart');

Route::post('/checkout', [CartController::class,'postCheckout'])->name('checkout');
Route::post('/checkoutApp', [CartController::class,'postCheckoutApp'])->name('checkoutApp');

Route::get('/register', [RegisterController::class,'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class,'store'])->name('register')->middleware('guest');

Route::get('/login', [LoginController::class,'create'])->name('login');
Route::get('/app-login-form', [LoginController::class,'createLoginForm']);
Route::post('/login', [LoginController::class,'store']);
Route::post('/loginApp', [LoginController::class,'store']);
Route::post('/logout', [LoginController::class,'destroy'])->name('logout')->middleware('auth');
Route::post('/logoutApp', [LoginController::class,'destroy'])->name('logout')->middleware('auth');

Route::get('/orders', [OrderController::class,'create'])->name('orders')->middleware('admin');

Route::get('/app-orders', [OrderController::class,'fetchOrders'])->middleware('admin');
Route::get('/order/{id}', [OrderController::class,'viewOrder'])->name('order/')->middleware('admin');
Route::get('/app-orderItems/{id}', [OrderController::class,'fetchOrder'])->middleware('admin');

Route::get('/products', [ProductController::class,'show'])->name('products')->middleware('admin');
Route::get('/product', [ProductController::class,'create'])->name('addProductForm')->middleware('admin');
Route::post('/product-add', [ProductController::class,'store'])->name('addProduct')->middleware('admin');
Route::post('/app-product-add', [ProductController::class,'store'])->name('addProduct')->middleware('admin');
Route::get('/product-edit/{product}', [ProductController::class,'edit'])->name('editProductForm')->middleware('admin');
Route::get('/app-edit-form/{product}', [ProductController::class,'appEditForm'])->middleware('admin');
Route::get('/app-add-form', [ProductController::class,'appAddForm'])->middleware('admin');

Route::patch('/product/{product}', [ProductController::class,'update'])->name('updateProduct')->middleware('admin');
Route::patch('/app-update-product/{product}', [ProductController::class,'appUpdate'])->middleware('admin');
Route::delete('/product/{product}', [ProductController::class,'destroy'])->name('deleteProduct')->middleware('admin');
Route::get('/app-delete-product/{product}', [ProductController::class,'deleteProduct'])->middleware('admin');


Route::get('/app#products')->middleware('admin');

Route::get('/order/{id}', [OrderController::class,'viewOrder'])->name('order/')->middleware('admin');

Route::get('/products', [ProductController::class,'show'])->name('products')->middleware('admin');
Route::get('/product', [ProductController::class,'create'])->name('addProductForm')->middleware('admin');
Route::post('/product-add', [ProductController::class,'store'])->name('addProduct')->middleware('admin');
Route::get('/product-edit/{product}', [ProductController::class,'edit'])->name('editProductForm')->middleware('admin');
Route::patch('/product/{product}', [ProductController::class,'update'])->name('updateProduct')->middleware('admin');
Route::delete('/product/{product}', [ProductController::class,'destroy'])->name('deleteProduct')->middleware('admin');

