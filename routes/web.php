<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'getProduct'])->name('home');

Route::get('/create-product', function () {
    return view('createProduct');
})->name('createProduct');

Route::post('/insert-product', [ProductController::class, 'insertProduct'])->name('insertProduct');
Route::get('/edit-product/{productId}', [ProductController::class, 'getEditProduct'])->name('getEditProduct');
Route::post('/update-product/{productId}', [ProductController::class, 'updateProduct'])->name('updateProduct');
Route::post('/delete-product/{productId}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
Route::post('/search-product/', [ProductController::class, 'searchProduct'])->name('search');
