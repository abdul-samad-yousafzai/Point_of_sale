@extends('layouts.app')
@section('title','Customer Form')

@section('content')
<h3>Customer Details (Optional)</h3>
<form action="{{ route('cart.checkout') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="customer_name" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="customer_email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="customer_phone" class="form-control">
    </div>
    <button class="btn btn-success">Generate Invoice</button>
</form>
@endsection
