@extends('layouts.admin')

@section('content')
    <h1>Add New Category</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <label for="name">Category Name:</label>
        <input type="text" name="name" required>
        <button type="submit">Add Category</button>
    </form>

    <a href="{{ route('admin.categories.index') }}">Back to Categories</a>
@endsection
