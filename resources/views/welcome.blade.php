@extends('layouts.app')

@section('title', ' - Home')

@section('content')
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
            </div>
        @empty
            <p>Data produk kosong.</p>
        @endforelse
    </div>
@endsection