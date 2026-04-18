@extends('layouts.app')
@section('title','Checkout')
@section('content')
<h2>Checkout</h2>

<form action="{{ route('checkout.process') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <h5>Customer</h5>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="customer_name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input name="customer_phone" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Tax</label>
                <input name="tax" type="number" step="0.01" class="form-control" value="0">
            </div>
            <div class="mb-3">
                <label class="form-label">Discount</label>
                <input name="discount" type="number" step="0.01" class="form-control" value="0">
            </div>
        </div>

        <div class="col-md-6">
            <h5>Order Summary</h5>
            <ul class="list-group mb-3">
                @foreach($cart as $item)
                    <li class="list-group-item d-flex justify-content-between">
                        <div>{{ $item['name'] }} x {{ $item['quantity'] }}</div>
                        <div>${{ number_format($item['line_total'],2) }}</div>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Subtotal</strong>
                    <strong>${{ number_format($subtotal,2) }}</strong>
                </li>
            </ul>

            <button class="btn btn-primary" type="submit">Complete Sale</button>
            <a href="{{ route('cart.index') }}" class="btn btn-link">Back to Cart</a>
        </div>
    </div>
</form>
@endsection
