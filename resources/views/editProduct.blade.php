@extends('layouts.app')

@section('title', ' - Edit Product')

@section('content')
    <form class="m-4" method="POST" action="{{ route('updateProduct', $product->id) }}" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="ProductName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="ProductName" name="ProductName" value="{{ $product->ProductName }}">
            @error('ProductName')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ProductPrice" class="form-label">Product Price</label>
            <input type="number" class="form-control" id="ProductPrice" name="ProductPrice" value="{{ $product->ProductPrice }}">
            @error('ProductPrice')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="CategoryId" class="form-label">Product Category</label>
            <select name="CategoryId" id="CategoryId">
                <option value="{{ $product->category->id }}">{{ $product->category->CategoryName }}</option>
                @foreach($categories as $category)
                    @if ($product->category->id != $category->id)
                        <option value="{{ $category->id }}">{{ $category->CategoryName }}</option>
                    @endif
                @endforeach
            </select>
            @error('CategoryId')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ProductImage" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="ProductImage" name="ProductImage" value="{{ $product->ProductImage }}">
            @error('ProductImage')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection