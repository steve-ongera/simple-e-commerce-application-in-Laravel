@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Product</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category_id" id="category" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price (Ksh)</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" 
                               id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image">
                        @if($product->image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($product->image) }}" alt="Current Image" 
                                     class="img-thumbnail" style="height: 100px;">
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" 
                                  rows="3">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_sponsored" 
                                   name="is_sponsored" value="1" 
                                   {{ old('is_sponsored', $product->is_sponsored) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_sponsored">
                                Mark as Featured Product
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_valentine" 
                                   name="is_valentine" value="1" 
                                   {{ old('is_valentine', $product->is_valentine) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_valentine">
                                Valentine's Day Product
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="sales_count" class="form-label">Sales Count</label>
                        <input type="number" class="form-control" id="sales_count" 
                               name="sales_count" value="{{ old('sales_count', $product->sales_count) }}">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection