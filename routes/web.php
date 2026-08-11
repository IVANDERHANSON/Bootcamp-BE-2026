<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsLogin;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function() {
    Route::get('/', 'getProduct')->name('home');
    Route::post('/search-product/', 'searchProduct')->name('search');

    Route::middleware([IsLogin::class, IsAdmin::class])->group(function() {
        Route::get('/create-product', 'getCreateProduct')->name('createProduct');
        Route::post('/insert-product', 'insertProduct')->name('insertProduct');
        Route::get('/edit-product/{productId}', 'getEditProduct')->name('getEditProduct');
        Route::post('/update-product/{productId}', 'updateProduct')->name('updateProduct');
        Route::post('/delete-product/{productId}', 'deleteProduct')->name('deleteProduct');
    });
});

Route::controller(AuthenticationController::class)->group(function() {
    Route::get('/register', 'getRegister')->name('getRegister');
    Route::post('/register', 'postRegister')->name('postRegister');
    Route::get('/login', 'getLogin')->name('getLogin');
    Route::post('/login', 'postLogin')->name('postLogin');
    Route::post('/logout', 'logout')->name('logout');
});
