<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/register', [ProductController::class, 'register'])->name('products.register');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::put('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

// Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
// Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
// Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');