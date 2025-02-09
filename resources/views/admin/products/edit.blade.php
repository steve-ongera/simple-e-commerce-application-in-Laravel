@extends('layouts.admin')

@section('content')
<h1>Edit Product</h1>
<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ $product->name }}" required>

    <label>Description:</label>
    <textarea name="description">{{ $product->description }}</textarea>

    <label>Price:</label>
    <input type="number" name="price" value="{{ $product->price }}" step="0.01" required>

    <label>Category:</label>
    <select name="category_id" required>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </select>

    <label>Image:</label>
    <input type="file" name="image">
    @if($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" width="100">
    @endif

    <button type="submit">Update Product</button>
</form>
@endsection
