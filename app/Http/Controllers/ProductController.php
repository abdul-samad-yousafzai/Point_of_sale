<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->query('search', ''));
        $perPage = 10;

        if ($search !== '') {
            if (is_numeric($search)) {
                // Search by ID exactly
                $productsQuery = Product::where('id', $search);
            } else {
                // Search by Name, merge duplicates
                $productsQuery = Product::selectRaw('MIN(id) as id, name, price, SUM(stock) as stock')
                    ->where('name', 'like', "%{$search}%")
                    ->groupBy('name', 'price');
            }
        } else {
            // No search, show all grouped products
            $productsQuery = Product::selectRaw('MIN(id) as id, name, price, SUM(stock) as stock')
                ->groupBy('name', 'price');
        }

        $productsQuery->orderBy('id', 'asc');

        $products = $productsQuery->paginate($perPage)->withQueryString();

        $serialStart = ($request->query('page', 1) - 1) * $perPage;

        return view('products.index', compact('products', 'search', 'serialStart', 'perPage'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($request->only(['name', 'price', 'stock']));
        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'price', 'stock']));

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
            if ($cart[$id]['quantity'] > $product->stock) {
                $cart[$id]['quantity'] = $product->stock;
            }
        } else {
            $cart[$id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => min($quantity, $product->stock),
                'stock'    => $product->stock
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $product->name . ' added to cart.');
    }
}
