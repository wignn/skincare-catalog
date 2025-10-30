<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('products', ProductController::class);
// Route::get('/products', [ProductController::class, 'index'])->name('dashboard-index');
Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard.index');
// Route::get('/create-product', [ProductController::class, 'create'])->name('products.create');
// Route::post('/create-product', [ProductController::class, 'store'])->name('products.store');
Route::resource('products', ProductController::class);
// Route::put('/edit-product/{id}', [ProductController::class, 'update'])->name('products.edit');
// Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('products.delete');