@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Checkout</h2>

    <div class="row">
        <div class="col-md-8">
            <h4>Order Summary</h4>
            <ul class="list-group mb-4">
                @foreach($cartItems as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>{{ $item->product->name }}</strong>
                        <span>x{{ $item->quantity }}</span>
                        <span>Ksh {{ number_format($item->product->price * $item->quantity, 2) }}</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Total Amount:</strong>
                    <strong>Ksh {{ number_format($totalAmount, 2) }}</strong>
                </li>
            </ul>

            <h4>Billing Details</h4>
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>ID Number</label>
                    <input type="text" name="id_number" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Delivery Address</label>
                    <select name="delivery_address" class="form-control">
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }} (Ksh {{ $location->delivery_fee }})</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-3">Confirm Order & Pay</button>
            </form>
        </div>
    </div>
</div>
@endsection
