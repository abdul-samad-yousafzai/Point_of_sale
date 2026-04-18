@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shopping Cart</h1>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach(session('cart') as $id => $details)
                    @php
                        $total = $details['price'] * $details['quantity'];
                        $grandTotal += $total;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ number_format($details['price'], 2) }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control" style="width:80px; display:inline-block;">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                        <td>{{ number_format($total, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right"><strong>Grand Total:</strong></td>
                    <td colspan="2"><strong>{{ number_format($grandTotal, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4">
            <form action="{{ route('cart.clear') }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" class="btn btn-warning">Clear Cart</button>
            </form>

            <form action="{{ route('checkout.form') }}" method="GET" style="display:inline-block;">
                <button type="submit" class="btn btn-success">Proceed to Checkout</button>
            </form>
        </div>
    @else
        <p>Your cart is empty.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Products</a>
    @endif
</div>
@endsection
