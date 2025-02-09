<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\Location;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{

    public function index()
    {
        // Fetch orders for the logged-in user
        $orders = Order::where('user_id', Auth::id())->get();

        // Return the view with orders
        return view('orders.index', compact('orders'));
    }

    // Show checkout page
    public function showCheckout()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $totalAmount = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $locations = Location::all(); // Get available locations

        return view('checkout.index', compact('cartItems', 'totalAmount', 'locations'));
    }

    // Process the checkout form
    public function processCheckout(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|digits:10',
            'id_number' => 'required|numeric',
            'delivery_address' => 'required|exists:locations,id',
        ]);

        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $totalAmount = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'id_number' => $request->id_number,
            'location_id' => $request->delivery_address,
            'amount' => $totalAmount,
            'status' => 'pending',
        ]);

        return redirect()->route('checkout.show')->with('success', 'Order placed successfully!');
    }
}
