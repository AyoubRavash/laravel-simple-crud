<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::get('/create-product', [ProductController::class, 'create'])->name('product.create');
Route::get('/deleted-products', [ProductController::class, 'showDestroyed'])->name('product.show-deleted');

Route::get('products/{id}/restore', [ProductController::class, 'restore'])->name('product.restore');

Route::delete('products/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
Route::delete('products/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');

Route::put('products/{id}/edit', [ProductController::class, 'update'])->name('product.update');

Route::post('store-product', [ProductController::class, 'store'])->name('product.store');
