@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Generate Invoice</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(count($cart) > 0)
        <form action="{{ route('invoice.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="customer_phone" class="form-label">Customer Phone</label>
                <input type="text" name="customer_phone" id="customer_phone" class="form-control">
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php
                            $total = $item['price'] * $item['quantity'];
                            $grandTotal += $total;
                        @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>Grand Total: {{ $grandTotal }}</h4>
            <button type="submit" class="btn btn-success">Create Invoice</button>
        </form>
    @else
        <p>No items in the cart.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Products</a>
    @endif
</div>
@endsection
