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

    <div>
        @forelse ($products as $product)
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->ProductName }}</h5>
                    <p class="card-text">Product Price: {{ $product->ProductPrice }}</p>
                </div>
                <div>
                    <a href="{{ route('getEditProduct', $product->id) }}"><button class="btn btn-primary">Edit Product</button></a>
                    <form action="{{ route('deleteProduct', $product->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger">Delete Product</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Data produk kosong.</p>
        @endforelse
    </div>
@endsection