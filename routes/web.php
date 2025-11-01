<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use phpseclib3\File\ASN1\Maps\AdministrationDomainName;

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('products', ProductController::class);
// Route::get('/products', [ProductController::class, 'index'])->name('dashboard-index');
// Route::get('/create-product', [ProductController::class, 'create'])->name('products.create');
// Route::post('/create-product', [ProductController::class, 'store'])->name('products.store');
Route::resource('products', ProductController::class);
// Route::put('/edit-product/{id}', [ProductController::class, 'update'])->name('products.edit');
// Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('products.delete');

//middleware
Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard.index');
});

// login register
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

// google auth
Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect']);
Route::get('/auth-google-callback', [AuthController::class, 'google_callback']);

