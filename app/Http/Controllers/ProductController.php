<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Mail\NewProductNotif;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function insertProduct(Request $request) {
        $validated = $request->validate([
            'ProductName' => 'required',
            'ProductPrice' => 'required|numeric|min:100',
            'CategoryId' => 'required',
            'ProductImage' => 'required|image'
        ], [
            'ProductName.required' => 'ProductName harus diisi.',
            'ProductPrice.min' => 'ProductPrice tidak boleh kurang dari 100.',
            'CategoryId.required' => 'CategoryName tidak boleh kosong.',
            'ProductImage.required' => 'ProductImage tidak boleh kosong.',
            'ProductImage.image' => 'ProductImage harus gambar.'
        ]);

        $now = now()->format('YmdHis');
        $filename = $now.'_'.$request->file('ProductImage')->getClientOriginalName();
        $validated['ProductImage'] = $filename;
        $newProduct = Product::create($validated);
        $request->file('ProductImage')->storeAs($filename);

        Mail::to('ivanderhansonset@gmail.com')->send(new NewProductNotif($newProduct));

        return redirect(route('home'))->with('success', 'Produk berhasil dibuat!');
    }

    function getProduct() {
        $products = Product::paginate(5);
        return view('welcome', compact('products'));
    }

    function getEditProduct(Request $request, $productId) {
        $product = Product::findOrFail($productId);
        $categories = Category::all();
        return view('editProduct', compact('product', 'categories'));
    }

    function updateProduct(Request $request, $productId) {
        $validated = $request->validate([
            'ProductName' => 'required',
            'ProductPrice' => 'required|numeric|min:100',
            'CategoryId' => 'required'
        ], [
            'ProductName.required' => 'ProductName harus diisi.',
            'ProductPrice.min' => 'ProductPrice tidak boleh kurang dari 100.',
            'CategoryId.required' => 'CategoryName tidak boleh kosong.'
        ]);

        $product = Product::findOrFail($productId);
        Storage::delete($product->ProductImage);
        $now = now()->format('YmdHis');
        $filename = $now.'_'.$request->file('ProductImage')->getClientOriginalName();
        $validated['ProductImage'] = $filename;
        $request->file('ProductImage')->storeAs($filename);
        $product->update($validated);

        return redirect(route('home'))->with('success', 'Produk berhasil diupdate!');
    }

    function deleteProduct($productId) {
        $product = Product::findOrFail($productId);
        Storage::delete($product->ProductImage);
        Product::destroy($productId);
        return redirect(route('home'))->with('success', 'Produk berhasil dihapus!');
    }

    function searchProduct(Request $request) {
        $products = Product::select('id', 'ProductName', 'ProductPrice')->where('ProductName', $request->SearchQuery)->orderBy('ProductPrice', 'desc')->limit(1)->get();
        return view("welcome", compact('products'))->with('success', 'Ditemukan!');
    }

    function getCreateProduct() {
        $categories = Category::all();
        return view('createProduct', compact('categories'));
    }
}
