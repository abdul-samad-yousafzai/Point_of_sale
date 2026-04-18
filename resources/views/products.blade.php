@extends('layouts.app')

@section('title','Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Products Dashboard</h2>
    <div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">+ Add Product</a>
        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary ms-2">Cart ({{ count(session('cart', [])) }})</a>
    </div>
</div>

{{-- Search & Filter --}}
<form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search products...">
    </div>
    <div class="col-auto">
        <select name="category" class="form-select">
            <option value="">All categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-auto">
        <button class="btn btn-secondary">Filter</button>
        <a href="{{ route('products.index') }}" class="btn btn-link">Reset</a>
    </div>
</form>

@if($products->isEmpty())
    <div class="alert alert-info">No products found.</div>
@else
    <div class="row g-3">
        @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    @if($product->image && file_exists(public_path('images/products/'.$product->image)))
                        <img src="{{ asset('images/products/' . $product->image) }}" class="card-img-top" style="height:160px; object-fit:cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height:160px;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted" style="flex:1;">{{ $product->description ?? 'No description' }}</p>
                        <p class="mb-1 fw-bold">Price: ${{ number_format($product->price,2) }}</p>
                        <p class="mb-2">Stock: {{ $product->stock }}</p>

                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete product?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>

                            {{-- Add to cart --}}
                            <form action="{{ route('cart.add') }}" method="POST" class="d-flex ms-auto">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm me-1" style="width:70px;">
                                <button class="btn btn-sm btn-success">Add</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
