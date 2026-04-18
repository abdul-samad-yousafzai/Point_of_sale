<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::resource('products', ProductController::class);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

Route::get('/checkout', [InvoiceController::class, 'checkoutForm'])->name('checkout.form');
Route::post('/checkout', [InvoiceController::class, 'generateInvoice'])->name('checkout.generate');

Route::get('/invoice/history', [InvoiceController::class, 'history'])->name('invoice.history');
Route::get('/invoice/{id}', [InvoiceController::class, 'viewInvoice'])->name('invoice.view');
Route::get('/invoice/{id}/download', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');
