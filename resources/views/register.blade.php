@extends('layouts.app')

@section('title', ' - Register')

@section('content')
    <form class="m-4" method="POST" action="{{ route('postRegister') }}">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        @if (session('failed'))
            <p class="text-danger">{{ session('failed') }}</p>
        @endif

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection