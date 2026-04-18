@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Invoice #{{ $invoice->id }} - Print</h2>

    <p><strong>Customer:</strong> {{ $invoice->customer_name }}</p>
    <p><strong>Email:</strong> {{ $invoice->customer_email }}</p>
    <p><strong>Phone:</strong> {{ $invoice->customer_phone }}</p>
    <p><strong>Total:</strong> ${{ $invoice->total }}</p>

    <h4>Items:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ $item->price }}</td>
                <td>${{ $item->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button onclick="window.print()" class="btn btn-success mt-3">Print</button>
</div>
@endsection
