<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AfriMarket | 2025 </title>

     <!-- Favicon -->
     <link rel="icon" type="image/png" href="{{ asset('logo.png') }}" height=50 , width=50>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand fw-bold" href="{{ url('/home') }}">
                    AfriMarket
                </a>

                <!-- Toggle Button for Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Category Dropdown -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                @foreach(App\Models\Category::all() as $category)
                                    <li><a class="dropdown-item" href="{{ route('products.index', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>

                    <!-- Search Bar -->
                    <form class="d-flex mx-auto" action="{{ route('products.index') }}" method="GET">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search products..." aria-label="Search">
                        <button class="btn btn-warning" type="submit">Search</button>
                    </form>

                    <!-- Right Side Icons -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Cart Icon -->
                        
                        @php
                            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                        @endphp

                        <!-- Cart Icon -->
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('cart.index') }}">
                                🛒 Cart <span class="badge bg-danger">{{ $cartCount }}</span>
                            </a>
                        </li>



                        <!-- User Authentication -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
                            </li>
                        @else
                            <!-- Profile Dropdown -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('profile.jpg') }}" alt="Profile Picture" class="rounded-circle" width="30" height="30">
 
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">My Orders</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
