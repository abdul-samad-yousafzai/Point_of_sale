<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }
        .invoice-box {
            background: white;
            border-radius: 15px;
            padding: 35px;
            box-shadow: 0px 5px 18px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        .invoice-header {
            border-bottom: 2px solid #e1e1e1;
            padding-bottom: 20px;
        }
        .title {
            font-size: 35px;
            font-weight: bold;
            color: #2c3e50;
        }
        .info-label {
            font-size: 13px;
            color: #555;
        }
        .total-box {
            background: #f1f8ff;
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #cce5ff;
        }
        .btn-rounded {
            border-radius: 25px;
            padding-left: 25px;
            padding-right: 25px;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
            }
        }
    </style>

</head>

<body>

<div class="container">

    <div class="invoice-box">

        <!-- Header -->
        <div class="invoice-header d-flex justify-content-between align-items-center">

            <div>
                <div class="title">INVOICE</div>
                <div class="info-label">Invoice No: <b>{{ $invoice->invoice_number }}</b></div>
                <div class="info-label">Date: {{ $invoice->created_at->format('d M, Y') }}</div>
            </div>

            <div class="text-end">
                <h5 class="fw-bold">Store Name</h5>
                <p class="m-0 text-muted">Your Business Address</p>
                <p class="m-0 text-muted">Phone: 0300-0000000</p>
            </div>

        </div>

        <!-- Customer Info -->
        <div class="row mt-4">

            <div class="col-md-6">
                <h6 class="fw-bold">Billing To:</h6>
                <p class="mb-1">{{ $invoice->customer_name }}</p>
                <p class="mb-1">{{ $invoice->customer_email }}</p>
                <p class="mb-1">{{ $invoice->customer_phone }}</p>
            </div>

            <div class="col-md-6 text-end">
                <h6 class="fw-bold">Payment Status:</h6>
                <span class="badge bg-success px-3 py-2">PAID</span>
            </div>

        </div>

        <!-- Items Table -->
        <div class="mt-4">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th width="15%">Price</th>
                        <th width="10%">Qty</th>
                        <th width="15%">Total</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($invoice->items as $item)
                    <tr>
                        <td class="fw-bold">{{ $item->product_name }}</td>
                        <td>Rs {{ number_format($item->price) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td class="fw-bold text-success">Rs {{ number_format($item->total) }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!-- Total Section -->
        <div class="d-flex justify-content-end">
            <div class="total-box w-25">
                <h5 class="fw-bold m-0">Grand Total:</h5>
                <h3 class="fw-bold text-success">
                    Rs {{ number_format($invoice->total) }}
                </h3>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-4 text-end no-print">

            <button onclick="window.print()" class="btn btn-outline-dark btn-rounded me-2">
                🖨 Print Invoice
            </button>

            <a href="{{ route('invoice.download', $invoice->id) }}"
               class="btn btn-danger btn-rounded">
                📄 Download PDF
            </a>

        </div>

    </div>

</div>

</body>
</html>
