<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes

// Login
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect']);
Route::get('/auth-google-callback', [AuthController::class, 'google_callback']);


// Protected Routes (Authenticated)
Route::middleware(['auth', 'check_role:admin'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard.index');
});

// Product Routes

// Route::get('/products', [ProductController::class, 'index'])->name('dashboard-index');
// Route::get('/create-product', [ProductController::class, 'create'])->name('products.create');
// Route::post('/create-product', [ProductController::class, 'store'])->name('products.store');
// Route::put('/edit-product/{id}', [ProductController::class, 'update'])->name('products.edit');
// Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('products.delete');

Route::resource('products', ProductController::class);
