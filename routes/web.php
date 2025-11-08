<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MetricsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Monitoring & Health Check Routes
Route::controller(MetricsController::class)->group(function () {
    Route::get('/metrics', 'metrics')->name('metrics')->withoutMiddleware('web');
    Route::get('/health', 'health')->name('health');
    Route::get('/ready', 'ready')->name('ready');
    Route::get('/alive', 'alive')->name('alive');
});

// Authentication
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', fn() => view('auth.register'))->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Password Reset
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('/forgot-password', 'showForm')->name('password.request');
        Route::post('/forgot-password', 'sendResetLink')->name('password.email');
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
        Route::post('/reset-password', 'updatePassword')->name('password.update');
    });
});


// Google OAuth
Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect']);
Route::get('/auth-google-callback', [AuthController::class, 'google_callback']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (Authenticated)
Route::middleware(['auth', 'check_role:admin'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard.index');
    Route::resource('products', ProductController::class);
});

// Product Routes
// Route::get('/products', [ProductController::class, 'index'])->name('dashboard-index');
// Route::get('/create-product', [ProductController::class, 'create'])->name('products.create');
// Route::post('/create-product', [ProductController::class, 'store'])->name('products.store');
// Route::put('/edit-product/{id}', [ProductController::class, 'update'])->name('products.edit');
// Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('products.delete');

Route::prefix('customer')->controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('customer.home');
    Route::get('/products', 'products')->name('customer.products');
});


