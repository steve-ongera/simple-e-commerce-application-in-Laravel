@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Sales Count</th>
                        <th>Featured</th>
                        <th>Valentine</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                                 class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>Ksh {{ number_format($product->price) }}</td>
                        <td>{{ $product->sales_count }}</td>
                        <td>
                            <span class="badge {{ $product->is_sponsored ? 'bg-success' : 'bg-secondary' }}">
                                {{ $product->is_sponsored ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $product->is_valentine ? 'bg-danger' : 'bg-secondary' }}">
                                {{ $product->is_valentine ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.products.edit', $product->id) }}" 
                                   class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="d-flex justify-content-center mt-4">
                {{ $products->links('vendor.pagination.bootstrap-5') }}
     </div>
</div>
@endsection