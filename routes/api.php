<?php

use App\Http\Controllers\AuthenticationAPIController;
use App\Http\Controllers\ProductAPIController;
use App\Http\Middleware\IsAdminAPI;
use App\Http\Middleware\IsLoginAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ProductAPIController::class)->middleware(['auth:sanctum', IsAdminAPI::class])->group(function() {
    Route::get('/get-categories', 'getCategories');
    Route::get('/get-products', 'getProducts');
    Route::post('/create-product', 'createProduct');
    Route::post('/update-product/{productId}', 'updateProduct');
    Route::post('/delete-product/{productId}', 'deleteProduct');
});

Route::controller(AuthenticationAPIController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware([IsLoginAPI::class, 'auth:sanctum']);
});
