@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Locations</h2>
    <a href="{{ route('location.create') }}" class="btn btn-primary mb-3">Add Location</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Delivery Fee</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locations as $location)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $location->name }}</td>
                    <td>Ksh {{ number_format($location->delivery_fee, 2) }}</td>
                    <td>
                        <a href="{{ route('location.edit', $location->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('location.destroy', $location->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this location?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
