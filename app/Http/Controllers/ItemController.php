<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Invoice;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $items = Item::where('invoice_id', $id)->get();
        $invoice = Invoice::findOrFail($id);

        return view('pages.items.index')->with([
            'items' => $items,
            'invoice' => $invoice,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('pages.items.create')->with([
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
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);

        // Create a new item record
        Item::create([
            'invoice_id' => $request->input('invoice_id'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'qty' => $request->input('qty'),
        ]);

        return redirect()->route('items.index', $request->input('invoice_id'))->with('success', 'Item created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
