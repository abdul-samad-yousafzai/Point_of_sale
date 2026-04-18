@extends('layouts.app')

@section('content')
<h2>Invoice History</h2>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>#</th>
            <th>Invoice ID</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Grand Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $index => $invoice)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $invoice->id }}</td>
            <td>{{ $invoice->customer_name }}</td>
            <td>{{ $invoice->created_at->format('d M, Y') }}</td>
            <td>{{ number_format($invoice->items->sum('total'), 2) }}</td>
            <td>
                <a href="{{ route('invoice.view', $invoice->id) }}">View</a>
                <a href="{{ route('invoice.download', $invoice->id) }}">PDF</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
