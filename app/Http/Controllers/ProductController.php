<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function insertProduct(Request $request) {
        $validated = $request->validate([
            'ProductName' => 'required',
            'ProductPrice' => 'required|numeric|min:100'
        ], [
            'ProductName.required' => 'ProductName harus diisi.',
            'ProductPrice.min' => 'ProductPrice tidak boleh kurang dari 100.'
        ]);

        Product::create($validated);

        return redirect(route('home'))->with('success', 'Produk berhasil dibuat!');
    }

    function getProduct() {
        $products = Product::all();
        return view('welcome', compact('products'));
    }
}
