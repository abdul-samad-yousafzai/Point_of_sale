@forelse($products as $product)
<div class="col-md-3 col-sm-6 mb-3">
    <div class="card card-compact text-center">

        <h5 class="fw-bold mb-1">{{ $product->name }}</h5>
        <p class="text-success fw-bold mb-1">₨ {{ number_format($product->price, 2) }}</p>
        <p class="text-muted mb-2">Stock: {{ $product->stock }}</p>

        {{-- Actions --}}
        <div class="d-flex justify-content-between gap-1 flex-wrap">
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm btn-sm-custom w-48">✏ Edit</a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block w-48"
                  onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm btn-sm-custom w-100">🗑 Delete</button>
            </form>
        </div>

        {{-- Add to Cart --}}
        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-2 d-flex gap-1">
            @csrf
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                   class="form-control form-control-sm text-center w-50">
            <button class="btn btn-success btn-sm btn-sm-custom w-50" {{ $product->stock <= 0 ? 'disabled' : '' }}>➕ Add</button>
        </form>

    </div>
</div>
@empty
<div class="col-12 text-center text-muted">
    No products found.
</div>
@endforelse
