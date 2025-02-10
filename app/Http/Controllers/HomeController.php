<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $topSellers = Product::where('sales_count', '>', 0)
                            ->orderBy('sales_count', 'desc')
                            ->take(5)
                            ->get();
                            
        $sponsoredProducts = Product::where('is_sponsored', true)
                                  ->take(4)
                                  ->get();
                                  
        $valentineProducts = Product::where('is_valentine', true)
                                  ->take(8)
                                  ->get();
                                  
        $banners = Banner::where('is_active', true)
                        ->orderBy('order')
                        ->get();

        return view('home', compact(
            'topSellers', 
            'sponsoredProducts', 
            'valentineProducts', 
            'banners'
        ));
    }
}
