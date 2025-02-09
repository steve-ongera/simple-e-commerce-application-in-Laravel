@extends('layouts.admin')

@section('content')
<h1>Add Product</h1>
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="name">Product Name:</label>
    <input type="text" name="name" required>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>

    <label for="price">Price:</label>
    <input type="number" name="price" step="0.01" required>

    <label for="category_id">Category:</label>
    <select name="category_id" required>
        <option value="">Select a category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <label for="image">Product Image:</label>
    <input type="file" name="image" required>

    <button type="submit">Add Product</button>
</form>

@endsection
