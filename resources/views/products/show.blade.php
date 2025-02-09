
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p>Category: {{ $product->category->name }}</p>
            <p>Price: ksh{{ $product->price }}</p>
            <p>{{ $product->description }}</p>
            
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
            <a href="{{ route('home') }}" class="btn btn-secondary mt-2">Continue Shopping</a>
        </div>
    </div>
</div>
@endsection