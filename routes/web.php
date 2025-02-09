<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Guest Routes
Route::middleware('guest')->group(function () {
    // Authentication Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post'); // ✅ Add name
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post'); // ✅ Add name
    
    // Redirect root to login for guests
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Home & Products
    Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    
    // Cart & Checkout
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::delete('/{id}', [CartController::class, 'remove'])->name('remove');
    });
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    
    // Auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



// Admin Routes
// Admin Routes
// Allow anyone to access admin pages (CRUD for products)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [AdminController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [AdminController::class, 'destroy'])->name('products.destroy');

    //category routes
     // Category Routes
     Route::get('categories', [AdminController::class, 'categoryIndex'])->name('categories.index');
     Route::get('categories/create', [AdminController::class, 'categoryCreate'])->name('categories.create');
     Route::post('categories', [AdminController::class, 'categoryStore'])->name('categories.store');
     Route::delete('categories/{id}', [AdminController::class, 'categoryDestroy'])->name('categories.destroy');

});