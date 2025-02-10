@extends('layouts.app')

@section('content')

<!-- Hero Carousel -->
<div id="heroCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/banners/banner-1.jpg" class="d-block w-100" alt="Special Offer">
            <div class="carousel-caption d-none d-md-block">
                <h2>Valentine's Day Special</h2>
                <p>Find the perfect gift for your loved ones</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="/banners/banner-2.jpg" class="d-block w-100" alt="Special Offer">
            <div class="carousel-caption d-none d-md-block">
                <h2>Valentine's Day Special</h2>
                <p>Find the perfect gift for your loved ones</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="/banners/banner-3.jpg" class="d-block w-100" alt="Special Offer">
            <div class="carousel-caption d-none d-md-block">
                <h2>Valentine's Day Special</h2>
                <p>Find the perfect gift for your loved ones</p>
            </div>
        </div>
        <!-- Add more carousel items here -->
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<div class="container">
    <!-- Top Selling Products -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="h4 mb-0">Top Selling Products</h3>
            <a href="{{ route('products.index') }}" class="btn btn-link text-decoration-none">View All →</a>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
            @foreach($topSellers as $product)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="position-relative">
                        <div class="badge bg-danger position-absolute top-0 start-0 m-2">Best Seller</div>
                        <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    </div>
                    <div class="card-body p-3">
                        <h5 class="card-title mb-1 fs-6">{{ Str::limit($product->name, 40) }}</h5>
                        <p class="card-text text-primary fw-bold mb-2">Ksh {{ number_format($product->price) }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary btn-sm w-100">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Sponsored Products -->
    <section class="mb-5 bg-light py-4 px-3 rounded">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="h4 mb-0">Featured Products</h3>
            <a href="{{ route('products.index', ['featured' => 1]) }}" class="btn btn-link text-decoration-none">View All →</a>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($sponsoredProducts as $product)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="position-relative">
                        <div class="badge bg-warning position-absolute top-0 start-0 m-2">Featured</div>
                        <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    </div>
                    <div class="card-body p-3">
                        <h5 class="card-title mb-1 fs-6">{{ Str::limit($product->name, 40) }}</h5>
                        <p class="card-text text-primary fw-bold mb-2">Ksh {{ number_format($product->price) }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary btn-sm w-100">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Valentine's Day Special -->
    <section class="mb-5">
        <div class="valentine-header text-center mb-4 p-4 rounded" style="background-color: #FFE6E6;">
            <h3 class="h4 mb-2">Valentine's Day Gifts</h3>
            <p class="text-muted mb-0">Make this Valentine's Day special with our curated selection</p>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            @foreach($valentineProducts as $product)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="position-relative">
                        <div class="badge bg-pink position-absolute top-0 start-0 m-2">Valentine's</div>
                        <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    </div>
                    <div class="card-body p-3">
                        <h5 class="card-title mb-1 fs-6">{{ Str::limit($product->name, 40) }}</h5>
                        <p class="card-text text-primary fw-bold mb-2">Ksh {{ number_format($product->price) }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary btn-sm w-100">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

<style>
.carousel-item img {
    height: 400px;
    object-fit: cover;
}

.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}

.badge.bg-pink {
    background-color: #FF69B4;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

/* Custom styles for smaller screens */
@media (max-width: 768px) {
    .carousel-item img {
        height: 200px;
    }
    
    .card-img-top {
        height: 150px;
    }
}

/* Loading effect for images */
.card-img-top {
    transition: opacity 0.3s;
}

.card-img-top.loading {
    opacity: 0.5;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lazy loading for images
    const images = document.querySelectorAll('.card-img-top');
    images.forEach(img => {
        img.classList.add('loading');
        img.onload = () => {
            img.classList.remove('loading');
        };
    });
});
</script>
@endsection