<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $payments = Payment::where('invoice_id', $id)->get();
        $invoice = Invoice::findOrFail($id);

        return view('pages.payments.index')->with([
            'payments' => $payments,
            'invoice' => $invoice,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('pages.payments.create')->with([
            'invoice' => $invoice
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'description' => 'required|string',
            'transfer_date' => 'required|date',
            'amount_paid' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('payment_images', 'public');

        // Create a new payment record
        Payment::create([
            'invoice_id' => $request->input('invoice_id'),
            'description' => $request->input('description'),
            'transfer_date' => $request->input('transfer_date'),
            'amount_paid' => $request->input('amount_paid'),
            'image' => $imagePath,
        ]);

        return redirect()->route('payments.index', $request->input('invoice_id'))->with('success', 'Payment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::findOrFail($id);

        return view('pages.payments.show')->with([
            'payment' => $payment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::find($id);

        // Delete the payment
        $payment->delete();

        return redirect()->route('payments.index', $payment->invoice_id)->with('success', 'Payment deleted successfully.');
    }
}
