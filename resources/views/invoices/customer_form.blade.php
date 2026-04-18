<!DOCTYPE html>
<html>
<head>
    <title>Customer Details</title>
</head>
<body>
<h2>Enter Customer Details</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('invoice.storeCustomer') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="customer_name" required><br><br>

    <label>Email:</label>
    <input type="email" name="customer_email"><br><br>

    <label>Phone:</label>
    <input type="text" name="customer_phone" required><br><br>

    <button type="submit">Create Invoice</button>
</form>
</body>
</html>
