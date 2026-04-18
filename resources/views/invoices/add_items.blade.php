@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Add Items to Invoice #{{ $invoice->id }}</h2>

    <form action="{{ route('invoice.storeItems', $invoice->id) }}" method="POST">
        @csrf
        <div id="items-container">
            <div class="item-row mb-3">
                <input type="text" name="product_name[]" placeholder="Product Name" required>
                <input type="number" name="quantity[]" placeholder="Quantity" required>
                <input type="number" step="0.01" name="price[]" placeholder="Price" required>
            </div>
        </div>

        <button type="button" id="add-item" class="btn btn-secondary mb-3">Add Another Item</button>
        <button type="submit" class="btn btn-primary">Save Items</button>
    </form>
</div>

<script>
    document.getElementById('add-item').addEventListener('click', function() {
        let container = document.getElementById('items-container');
        let newRow = document.createElement('div');
        newRow.classList.add('item-row', 'mb-3');
        newRow.innerHTML = `<input type="text" name="product_name[]" placeholder="Product Name" required>
                            <input type="number" name="quantity[]" placeholder="Quantity" required>
                            <input type="number" step="0.01" name="price[]" placeholder="Price" required>`;
        container.appendChild(newRow);
    });
</script>
@endsection
