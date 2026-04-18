@extends('layouts.app')

@section('content')
<h1>Product Details</h1>

<p><strong>ID:</strong> {{ $product->id }}</p>
<p><strong>Name:</strong> {{ $product->name }}</p>
<p><strong>Price:</strong> {{ $product->price }}</p>
<p><strong>Description:</strong> {{ $product->description }}</p>

<a href="{{ route('products.index') }}">Back to Products</a>
@endsection
