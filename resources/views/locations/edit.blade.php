@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Location</h2>
    <form action="{{ route('location.update', $location->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $location->name }}" required>
        </div>
        <div class="mb-3">
            <label>Delivery Fee:</label>
            <input type="number" name="delivery_fee" class="form-control" value="{{ $location->delivery_fee }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('location.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
