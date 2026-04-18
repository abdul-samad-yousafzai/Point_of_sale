<table class="table table-bordered table-striped text-center">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Total Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
            <tr>
                <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                <td>{{ $product->name }}</td>
                <td>₨ {{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <form action="{{ route('products.destroy', $product->min_id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No products found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $products->links() }}
