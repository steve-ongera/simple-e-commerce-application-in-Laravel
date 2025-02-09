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
use App\Models\Cart;
use App\Models\Location;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;




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

    public function processCheckout(Request $request)
    {
        // Validate user input
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|digits:10',
            'id_number' => 'required|numeric',
            'delivery_address' => 'required|exists:locations,id',
        ]);

        // Get user cart items
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Calculate total amount
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            if (!$item->product) {
                return redirect()->back()->with('error', 'Product not found in cart.');
            }
            $totalAmount += $item->product->price * $item->quantity;
        }

        DB::beginTransaction();

        try {
            // Save transaction
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

            if (!$transaction) {
                throw new \Exception("Transaction could not be created.");
            }

            // Clear cart after successful order
            Cart::where('user_id', auth()->id())->delete();

            DB::commit(); // Commit transaction

            return redirect()->route('checkout.show')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback if something goes wrong
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

}
