<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SalesController extends Controller
{
    // -------------------------
    // View Cart
    // -------------------------
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('sales.cart', compact('cart'));
    }

    // -------------------------
    // Add to Cart
    // -------------------------
    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Product added to cart!');
    }

    // -------------------------
    // Remove From Cart
    // -------------------------
    public function removeFromCart(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Product removed from cart!');
    }

    // -------------------------
    // Update Cart
    // -------------------------
    public function updateCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Cart updated!');
    }

    // -------------------------
    // Invoice Form
    // -------------------------
    public function invoiceForm()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty!');
        }

        return view('sales.invoice-form');
    }

    // -------------------------
    // Generate Invoice
    // -------------------------
    public function generateInvoice(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_details' => 'required'
        ]);

        $cart = session()->get('cart', []);

        $invoiceNumber = "INV-" . rand(10000, 99999);
        $dateTime = now()->format('Y-m-d H:i:s');

        return view('sales.invoice-preview', [
            'customer_name'    => $request->customer_name,
            'customer_details' => $request->customer_details,
            'cart'             => $cart,
            'invoiceNumber'    => $invoiceNumber,
            'dateTime'         => $dateTime
        ]);
    }
}
