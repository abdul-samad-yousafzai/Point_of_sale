@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Invoice</h1>

    <p><strong>Invoice Number:</strong> {{ $invoiceNumber }}</p>
    <p><strong>Date & Time:</strong> {{ $dateTime }}</p>
    <p><strong>Customer Name:</strong> {{ $customerName }}</p>

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
            @foreach($cart as $item)
                @php $total = $item['price'] * $item['quantity']; @endphp
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

    <button class="btn btn-primary" onclick="window.print()">Print Invoice</button>
    <a href="{{ route('cart.index') }}" class="btn btn-secondary">Back to Cart</a>
</div>
@endsection
