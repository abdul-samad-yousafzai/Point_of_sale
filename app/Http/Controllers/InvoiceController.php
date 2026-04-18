<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;

class InvoiceController extends Controller
{
    public function checkoutForm()
    {
        $cart = session()->get('cart', []);
        return view('checkout.form', compact('cart'));
    }

    public function generateInvoice(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        // Create invoice with a unique invoice number
        $invoice = Invoice::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'invoice_number' => 'INV-' . time(),
        ]);

        $grandTotal = 0;

        foreach ($cart as $product_id => $item) {

            $lineTotal = $item['price'] * $item['quantity'];
            $grandTotal += $lineTotal;

            // Save invoice item
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $lineTotal,
            ]);

            // Decrease stock
            $product = Product::find($product_id);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }

        // SAVE TOTAL IN INVOICE TABLE
        $invoice->total = $grandTotal;
        $invoice->save();

        session()->forget('cart');

        return redirect()->route('invoice.view', $invoice->id)
            ->with('success', 'Invoice generated.');
    }

    public function history()
    {
        $invoices = Invoice::with('items')->orderBy('created_at', 'desc')->get();
        return view('invoices.history', compact('invoices'));
    }

    public function viewInvoice($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);

        // CALCULATE GRAND TOTAL for the UI
        $grandTotal = $invoice->items->sum('total');

        return view('invoices.view', compact('invoice', 'grandTotal'));
    }

    public function downloadInvoice($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);

        $grandTotal = $invoice->items->sum('total');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoices.pdf', compact('invoice', 'grandTotal'));

        return $pdf->download('invoice_' . $invoice->invoice_number . '.pdf');
    }
}
