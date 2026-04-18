<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 6px; }
    </style>
</head>
<body>

<h1>INVOICE</h1>

<p><strong>Invoice Number:</strong> {{ $invoiceNumber }}</p>
<p><strong>Date:</strong> {{ $dateTime }}</p>

<h3>Customer Details</h3>
<p><strong>Name:</strong> {{ $customer_name }}</p>
<p><strong>Details:</strong> {{ $customer_details }}</p>

<h3>Items</h3>

<table width="100%">
    <tr>
        <th>Name</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total</th>
    </tr>

    @php $grandTotal = 0; @endphp

    @foreach ($cart as $id => $item)
        @php
            $total = $item['price'] * $item['quantity'];
            $grandTotal += $total;
        @endphp

        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ $item['price'] }}</td>
            <td>{{ $total }}</td>
        </tr>
    @endforeach

    <tr>
        <th colspan="3" style="text-align: right;">Grand Total</th>
        <th>{{ $grandTotal }}</th>
    </tr>
</table>

<br>

<button onclick="window.print()">Print Invoice</button>

</body>
</html>
