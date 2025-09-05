<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get("categories", [CategoryController::class, 'index'])->name('category.index');
Route::get('categories/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::get('/create-category', [CategoryController::class, 'create'])->name('category.create');
Route::get('/deleted-categories', [CategoryController::class, 'showDestroyed'])->name('category.show-deleted');
Route::get('categories/{id}/restore', [CategoryController::class, 'restore'])->name('category.restore');

Route::delete('categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::delete('categories/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');

Route::put('categories/{id}/edit', [CategoryController::class, 'update'])->name('category.update');

Route::post('store-category', [CategoryController::class, 'store'])->name('category.store');