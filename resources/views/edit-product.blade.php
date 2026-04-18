@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<h2>Edit Product</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
        @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" class="form-control" required>
        @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control" required>
        @error('stock') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Change Image (optional)</label>
        <input type="file" name="image" class="form-control">
        @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    @if($product->image && file_exists(public_path('images/products/'.$product->image)))
        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            <img src="{{ asset('images/products/' . $product->image) }}" style="max-width:200px; height:auto;" class="img-thumbnail">
        </div>
    @endif

    <button class="btn btn-primary">Update Product</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">Cancel</a>
</form>
@endsection
