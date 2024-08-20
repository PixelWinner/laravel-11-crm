<?php

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

    Route::get('/users', [UserController::class, 'index'])->name('getUsers');

    Route::view('/products/create', 'createProduct')->name('createProductPage');

    Route::post('/products', [ProductController::class, 'createProduct'])->name('createProduct');

    Route::get('/products', [ProductController::class, 'getProducts'])->name('products');
});

Route::middleware('guest')->group(function () {
    Route::view('/login', 'login')->name('login');

    Route::view('/register', 'register')->name('register');

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/register', [AuthController::class, 'register']);
});
