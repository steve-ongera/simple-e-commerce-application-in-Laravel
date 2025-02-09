@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="product-image">
                    <a href="{{ route('product.show', $product->id) }}">
                        <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    </a>
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-primary fw-bold">Ksh {{ number_format($product->price) }}</p>
                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>

<style>
    .product-image {
        overflow: hidden;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product-image img {
        transition: transform 0.3s ease-in-out;
        width: 100%; 
        height: auto; /* Ensures full image is displayed */
        max-height: 350px; /* Prevents it from being too large */
    }

    .product-image:hover img {
        transform: scale(1.05); /* Subtle zoom effect */
    }

    .card {
        transition: box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection
