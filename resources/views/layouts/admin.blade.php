<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin | AfriMarket</title>

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
    <nav>
        <ul>
            <li><a href="{{ route('admin.products.index') }}">Products</a></li>
            <li><a href="{{ route('home') }}">Home</a></li>
        </ul>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
