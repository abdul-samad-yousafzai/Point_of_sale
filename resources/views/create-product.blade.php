@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<h2>Add New Product</h2>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" name="price" value="{{ old('price') }}" step="0.01" class="form-control" required>
        @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', 0) }}" class="form-control" required>
        @error('stock') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Image (optional)</label>
        <input type="file" name="image" class="form-control">
        @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-success">Save Product</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">Cancel</a>
</form>
@endsection
