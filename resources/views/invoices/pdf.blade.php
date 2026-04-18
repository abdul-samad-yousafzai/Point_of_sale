<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            width: 100%;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }

        h1, h2, h3 {
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 24px;
            color: #4CAF50;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .company-details {
            text-align: right;
        }

        .customer-details {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: left;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        table tr.total-row td {
            border-top: 2px solid #4CAF50;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            color: #888;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table width="100%">
            <tr>
                <td>
                    <h1>POS Invoice</h1>
                </td>
                <td class="company-details">
                    <strong>Company Name</strong><br>
                    Email: info@company.com<br>
                    Phone: +123 456 7890
                </td>
            </tr>
        </table>

        <hr>

        <div class="customer-details">
            <strong>Invoice #: </strong> {{ $invoice->invoice_number }}<br>
            <strong>Date: </strong> {{ $invoice->created_at->format('d M, Y') }}<br>
            <strong>Customer: </strong> {{ $invoice->customer_name }}<br>
            <strong>Email: </strong> {{ $invoice->customer_email }}
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th class="text-right">Price</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($invoice->items as $index => $item)
                    @php $grandTotal += $item->total; @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td class="text-right">Rs {{ number_format($item->price, 2) }}</td>
                        <td class="text-right">{{ $item->quantity }}</td>
                        <td class="text-right">Rs {{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach

                <tr class="total-row">
                    <td colspan="4" class="text-right">Grand Total</td>
                    <td class="text-right">Rs {{ number_format($grandTotal, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            Thank you for your purchase!<br>
            Powered by Your POS System
        </div>
    </div>
</body>
</html>
