@extends('layouts.app')

@section('title', ' - Home')

@section('content')
    <form class="m-4" method="POST" action="{{ route('search') }}">
        @csrf

        <div class="mb-3">
            <label for="SearchQuery" class="form-label">Search</label>
            <input type="text" class="form-control" id="SearchQuery" name="SearchQuery" value="{{ old('SearchQuery') }}">
            @error('SearchQuery')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    @if (session('success') != null)
        <p>{{ session('success') }}</p>
    @endif

    <div class="m-4">
        @forelse ($products as $product)
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('/storage/'.$product->ProductImage) }}" class="card-img-top" alt="{{ $product->ProductImage }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->ProductName }}</h5>
                    <p class="card-text">Product Price: {{ $product->ProductPrice }}</p>
                    <p class="card-text">Product Category: {{ $product->category->CategoryName }}</p>
                </div>
                <div class="m-4">
                    <a href="{{ route('getEditProduct', $product->id) }}"><button class="btn btn-primary">Edit Product</button></a>
                    <br><br>
                    <form action="{{ route('deleteProduct', $product->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger">Delete Product</button>
                    </form>
                    <br><br>
                </div>
            </div>
            <br><br>
        @empty
            <p>Data produk kosong.</p>
        @endforelse
    </div>

    {{ $products->onEachSide(5)->links() }}
@endsection