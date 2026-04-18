@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Invoices</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $inv)
            <tr>
                <td>{{ $inv->invoice_number }}</td>
                <td>{{ $inv->customer_name }}</td>
                <td>{{ $inv->grand_total }}</td>
                <td>{{ $inv->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    <a href="{{ route('invoices.show', $inv->id) }}" class="btn btn-sm btn-primary">View</a>
                    <a href="{{ route('invoices.pdf', $inv->id) }}" class="btn btn-sm btn-secondary">PDF</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $invoices->links() }}
</div>
@endsection
