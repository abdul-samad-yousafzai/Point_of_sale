@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Success Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h2>Products</h2>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
            <a href="{{ route('cart.index') }}" class="btn btn-warning">
                View Cart ({{ count(session('cart', [])) }})
            </a>
        </div>
    </div>

    {{-- Search Form --}}
    <form action="{{ route('products.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by ID or Name...">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    {{-- Product Table --}}
    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
                <th>Add to Cart</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $product)
                <tr>
                    <td>{{ $serialStart + $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>₨ {{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>

                    {{-- Edit / Delete --}}
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>

                    {{-- Add to Cart --}}
                    <td>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex justify-content-center gap-1">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control form-control-sm" style="width:70px">
                            <button class="btn btn-success btn-sm" {{ $product->stock <= 0 ? 'disabled' : '' }}>Add</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $products->onEachSide(1)->links('pagination::simple-bootstrap-5') }}
    </div>
</div>

{{-- JS to auto-clear search input after page load --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            // Clear search input automatically
            searchInput.value = '';
        }
    });
</script>
@endsection
