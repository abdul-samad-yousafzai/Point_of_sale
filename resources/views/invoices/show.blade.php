@extends('layouts.app')
@section('title','Invoice')

@section('content')
<h3>Invoice {{ $invoice->invoice_number }}</h3>
<p>Customer: {{ $invoice->customer_name ?? 'Walk-in' }}</p>
<p>Email: {{ $invoice->customer_email ?? '-' }}</p>
<p>Phone: {{ $invoice->customer_phone ?? '-' }}</p>

<table class="table table-bordered">
<thead class="table-light">
<tr>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
</tr>
</thead>
<tbody>
@foreach($invoice->items as $item)
<tr>
<td>{{ $item->product_name }}</td>
<td>{{ number_format($item->price,2) }}</td>
<td>{{ $item->quantity }}</td>
<td>{{ number_format($item->total,2) }}</td>
</tr>
@endforeach
<tr>
<th colspan="3" class="text-end">Grand Total:</th>
<th>{{ number_format($invoice->total,2) }}</th>
</tr>
</tbody>
</table>

<a href="{{ route('invoice.print',$invoice->id) }}" class="btn btn-primary" target="_blank">Print</a>
<a href="{{ route('invoice.download',$invoice->id) }}" class="btn btn-success">Download PDF</a>
<a href="{{ route('invoice.history') }}" class="btn btn-secondary">Back to History</a>
@endsection
