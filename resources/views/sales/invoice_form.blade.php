<!DOCTYPE html>
<html>
<head>
    <title>Invoice Form</title>
</head>
<body>

<h2>Customer Information</h2>

<form action="{{ route('invoice.generate') }}" method="POST">
    @csrf

    <label>Customer Name:</label><br>
    <input type="text" name="customer_name" required><br><br>

    <label>Customer Details (Phone / Address):</label><br>
    <textarea name="customer_details" required></textarea><br><br>

    <button type="submit">Generate Invoice</button>
</form>

</body>
</html>
