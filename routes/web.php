<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'getProduct'])->name('home');

Route::get('/create-product', function () {
    return view('createProduct');
})->name('createProduct');

Route::post('/insert-product', [ProductController::class, 'insertProduct'])->name('insertProduct');
