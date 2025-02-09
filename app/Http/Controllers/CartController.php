<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;




class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        Cart::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $product->id],
            ['quantity' => DB::raw('quantity + 1')]
        );
        return redirect()->back()->with('success', 'Product added to cart');
    }

    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();
        return view('cart.index', compact('cartItems'));
    }

    public function remove($id)
    {
        Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->delete();
        return redirect()->back()->with('success', 'Item removed from cart');
    }
}
