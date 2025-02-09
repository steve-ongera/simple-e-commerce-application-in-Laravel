@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Location</h2>
    <form action="{{ route('location.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Delivery Fee:</label>
            <input type="number" name="delivery_fee" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('location.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
