@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar with filters - 1/4 width -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-3">Filter Products</h5>
                    
                    <form>
                        <h6 class="mb-3">Price Range</h6>
                        <div class="mb-3">
                            <label class="form-label">Min Price (Ksh)</label>
                            <input type="number" class="form-control form-control-sm" name="min_price" value="{{ request('min_price') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Max Price (Ksh)</label>
                            <input type="number" class="form-control form-control-sm" name="max_price" value="{{ request('max_price') }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Apply Filter</button>
                        @if(request('min_price') || request('max_price'))
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm ms-2">Clear</a>
                        @endif
                    </form>

                    <h6 class="mb-3 mt-4">Sort By</h6>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('products.index', ['sort' => 'price_asc']) }}" 
                           class="list-group-item list-group-item-action {{ request('sort') === 'price_asc' ? 'active' : '' }}">
                            Price: Low to High
                        </a>
                        <a href="{{ route('products.index', ['sort' => 'price_desc']) }}" 
                           class="list-group-item list-group-item-action {{ request('sort') === 'price_desc' ? 'active' : '' }}">
                            Price: High to Low
                        </a>
                        <a href="{{ route('products.index', ['sort' => 'newest']) }}" 
                           class="list-group-item list-group-item-action {{ request('sort') === 'newest' ? 'active' : '' }}">
                            Newest First
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid - 3/4 width -->
        <div class="col-md-9">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
                @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="product-image">
                            <a href="{{ route('product.show', $product->id) }}">
                                <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1">{{ Str::limit($product->name, 40) }}</h6>
                            <p class="card-text text-primary fw-bold mb-1">Ksh {{ number_format($product->price) }}</p>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary btn-sm w-100">View</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<style>
    .product-image {
        overflow: hidden;
        border-radius: 8px 8px 0 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product-image img {
        transition: transform 0.3s ease-in-out;
        width: 100%;
        height: 150px; /* Fixed height for consistency */
        object-fit: cover;
    }

    .product-image:hover img {
        transform: scale(1.05);
    }

    .card {
        transition: box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
    }

    /* Make the layout more compact on smaller screens */
    @media (max-width: 768px) {
        .product-image img {
            height: 120px;
        }
    }
</style>
@endsection