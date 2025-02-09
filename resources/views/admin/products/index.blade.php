@extends('layouts.admin')

@section('content')
<h1>Manage Products</h1>
<a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>

<table>
    <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category->name ?? 'No Category' }}</td>
        <td>{{ $product->price }}</td>
        <td>
            <a href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
