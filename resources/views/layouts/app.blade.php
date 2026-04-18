<!DOCTYPE html>
<html>
<head>
    <title>POS System - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('products.index') }}">POS System</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Cart</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('invoice.history') }}">Invoices</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
