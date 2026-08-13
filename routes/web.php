<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/produk', [ProductController::class, 'index'])->name('products.index');

// Routes Cart (Dengan Login)
Route::middleware('auth')->group(function () {
    Route::get('cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('cart/items/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('cart/items/{cartItem}', [CartController::class, 'update'])->name('cart.update'); // <-- Nama ini dibiarkan
});

// Routes Cart (Tanpa Login)
// PERBAIKAN: Menambahkan prefix 'guest.' pada penamaan route agar tidak bentrok
Route::get('/guest-cart', [CartController::class, 'index'])->name('guest.cart.index');
Route::post('/guest-cart', [CartController::class, 'store'])->name('guest.cart.store');
Route::put('/guest-cart/{id}', [CartController::class, 'update'])->name('guest.cart.update'); // <-- PERBAIKAN NAMA DI SINI
Route::delete('/guest-cart/{id}', [CartController::class, 'destroy'])->name('guest.cart.destroy');

Route::get('/cara-pemesanan', function () {
    return view('home.order');
})->name('order.guide');
