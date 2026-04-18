@extends('layouts.app')

@section('content')
<style>
    .checkout-card {
        border-radius: 15px;
        box-shadow: 0 4px 25px rgba(0,0,0,0.1);
        background: #ffffff;
    }
    .section-title {
        font-weight: 700;
        font-size: 22px;
    }
    .form-control, .form-select {
        border-radius: 12px !important;
        padding: 10px 14px;
    }
    .total-box {
        background: #f8f9fa;
        padding: 18px;
        border-radius: 12px;
        font-size: 17px;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="checkout-card p-4">

                <h3 class="text-center mb-3">🧾 Checkout</h3>
                <p class="text-center text-muted mb-4">Confirm your details & review your cart items</p>

                {{-- Customer Info --}}
                <h5 class="section-title mb-3">👤 Customer Information</h5>
                <form action="{{ route('checkout.generate') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" required placeholder="Enter full name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Customer Email</label>
                        <input type="email" name="customer_email" class="form-control" required placeholder="example@gmail.com">
                    </div>

                    <hr class="my-4">

                    {{-- Cart Items --}}
                    <h5 class="section-title mb-3">🛒 Order Summary</h5>

                    @php
                        $grandTotal = 0;
                    @endphp

                    @foreach($cart as $id => $item)
                        @php $grandTotal += $item['price'] * $item['quantity']; @endphp

                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                            <div>
                                <strong>{{ $item['name'] }}</strong>
                                <div class="text-muted">Qty: {{ $item['quantity'] }}</div>
                            </div>
                            <span class="fw-bold">Rs {{ number_format($item['price'] * $item['quantity']) }}</span>
                        </div>
                    @endforeach

                    {{-- Totals --}}
                    <div class="total-box mt-3">
                        <div class="d-flex justify-content-between">
                            <strong>Subtotal:</strong>
                            <span>Rs {{ number_format($grandTotal) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mt-1">
                            <strong>Tax (0%):</strong>
                            <span>Rs 0</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between total fw-bold fs-5">
                            <strong>Grand Total:</strong>
                            <span>Rs {{ number_format($grandTotal) }}</span>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button class="btn btn-primary w-100 mt-4 py-2" style="border-radius:12px; font-size:18px;">
                        ✅ Generate Invoice
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
