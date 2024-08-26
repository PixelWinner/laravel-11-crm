<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//TODO roles security

Route::middleware('auth')->group(function () {
    Route::view('/', 'home')->name('home');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::get('/products', [ProductController::class, 'index'])->name('products');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::view('/products/store', 'products.store')->name('storeProductPage');
    Route::post('/products', [ProductController::class, 'store'])->name('storeProduct');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('editProduct');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('updateProduct');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('destroyProduct');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('storeCategory');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('destroyCategory');
});

Route::middleware('guest')->group(function () {
    Route::view('/login', 'login')->name('login');

    Route::view('/register', 'register')->name('register');

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/register', [AuthController::class, 'register']);
});
