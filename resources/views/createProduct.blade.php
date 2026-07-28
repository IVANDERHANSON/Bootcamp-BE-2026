@extends('layouts.app')

@section('title', ' - Create Product')

@section('content')
    <form class="m-4" method="POST" action="{{ route('insertProduct') }}">
        @csrf
        
        <div class="mb-3">
            <label for="ProductName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="ProductName" name="ProductName">
            @error('ProductName')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ProductPrice" class="form-label">Product Price</label>
            <input type="number" class="form-control" id="ProductPrice" name="ProductPrice">
            @error('ProductPrice')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection