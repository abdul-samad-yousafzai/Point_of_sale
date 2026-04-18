<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Show cart
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Add product to cart
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return redirect()->back()->with('error', 'Product not found.');

        $cart = session()->get('cart', []);

        // If product already in cart, increase quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity ?? 1; // Increase quantity
        } else {
            // Add new product to cart
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity ?? 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    // Update product quantity in cart
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, $request->quantity);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated.');
        }
        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    // Remove product
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed from cart.');
        }
        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    // Clear cart
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared.');
    }
}
