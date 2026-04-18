@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Invoice #{{ $invoice->id }}</h2>

    <form action="{{ route('invoice.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $invoice->customer_name }}">
        </div>
        <div class="mb-3">
            <label for="customer_email" class="form-label">Customer Email</label>
            <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ $invoice->customer_email }}">
        </div>
        <div class="mb-3">
            <label for="customer_phone" class="form-label">Customer Phone</label>
            <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ $invoice->customer_phone }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Invoice</button>
    </form>
</div>
@endsection
