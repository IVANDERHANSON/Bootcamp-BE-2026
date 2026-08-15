<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductAPIController extends Controller
{
    function getCategories() {
        $categories = Category::all();

        return response()->json([
            'status' => 200,
            'message' => 'Get categories berhasil.',
            'data' => $categories
        ], 200);
    }

    function getProducts() {
        $products = Product::all();

        return response()->json([
            'status' => 200,
            'message' => 'Get products berhasil.',
            'data' => $products
        ], 200);
    }

    function createProduct(Request $request) {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Create product gagal.',
                'error' => $validator->customMessages
            ], 400);
        }

        $now = now()->format('YmdHis');
        $filename = $now.'_'.$request->file('ProductImage')->getClientOriginalName();
        $newProduct = Product::create([
            'ProductName' => $request->ProductName,
            'ProductPrice' => $request->ProductPrice,
            'CategoryId' => $request->CategoryId,
            'ProductImage' => $filename
        ]);
        $request->file('ProductImage')->storeAs($filename);

        return response()->json([
            'status' => 200,
            'message' => 'Create product berhasil.',
            'data' => $newProduct
        ], 200);
    }

    function updateProduct(Request $request, $productId) {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Update product gagal.',
                'error' => $validator->customMessages
            ], 400);
        }

        $product = Product::findOrFail($productId);
        Storage::delete($product->ProductImage);
        $now = now()->format('YmdHis');
        $filename = $now.'_'.$request->file('ProductImage')->getClientOriginalName();
        $product->update([
            'ProductName' => $request->ProductName,
            'ProductPrice' => $request->ProductPrice,
            'CategoryId' => $request->CategoryId,
            'ProductImage' => $filename
        ]);
        $request->file('ProductImage')->storeAs($filename);

        return response()->json([
            'status' => 200,
            'message' => 'Update product berhasil.',
            'data' => $product
        ], 200);
    }

    function deleteProduct($productId) {
        $product = Product::find($productId);

        if($product == null) {
            return response()->json([
                'status' => 400,
                'message' => 'Product tidak ditemukan.'
            ], 400);
        }

        Storage::delete($product->ProductImage);
        Product::destroy($productId);

        return response()->json([
            'status' => 200,
            'message' => 'Delete product berhasil.'
        ], 200);
    }
}
