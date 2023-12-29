<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Item;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            # code...
            $query = Invoice::orderBy('created_at', 'DESC');

            // Check if the 'status' filter is set
            if (request('status') !== null) {
                $query->where('status', request('status'));
            }

            return Datatables::of($query)
                ->addColumn('total_amount', function ($item) {
                    $total_amount = Item::where('invoice_id', $item->id)->sum('price');
                    return $total_amount;
                })
                ->addColumn('balance_due', function ($item) {
                    $subtotal = Item::where('invoice_id', $item->id)->sum('price');
                    $discount = $item->discount;
                    $amount_paid = Payment::where('invoice_id', $item->id)->sum('amount_paid');
                    $balance_due = ($subtotal - $discount) - $amount_paid;

                    return $balance_due;
                })
                ->editColumn('amount_paid', function ($item) {
                    $def = $item->amount_paid;
                    $total_payment = Payment::where('invoice_id', $item->id)->sum('amount_paid');
                    $grand_total = $def + $total_payment;

                    return $grand_total;
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == '0') {
                        # code...
                        return '<i class="fas fa-fw fa-times"></i>';
                    } elseif ($item->status == '1') {
                        # code...
                        return '<i class="fas fa-fw fa-check"></i>';
                    }
                })
                ->addColumn('action', function ($item) {
                    return '
                    <a class="btn btn-info m-1" href="' . route('invoices.show', $item->id)  . '">
                        <i class="fas fa-fw fa-book"></i>
                    </a>
                    <a class="btn btn-warning m-1" href="' . route('items.index', $item->id)  . '">
                        <i class="fas fa-fw fa-bookmark"></i>
                    </a>
                    <a class="btn btn-danger m-1" href="' . route('payments.index', $item->id)  . '">
                        <i class="fas fa-fw fa-dollar-sign"></i>
                    </a>
                            ';
                })
                ->rawColumns(['action', 'total_amount', 'status', 'balance_due'])
                ->make(true);
        }
        return view('pages.invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation logic goes here
        $validatedData = $request->validate([
            'billto' => 'required|string',
            'billfrom' => 'required|string',
            'start_date' => 'required|string',
            'due_date' => 'required|string',
            'notes' => 'required|string',
            'terms' => 'required|string',
            'discount' => 'nullable|string',
            'invoice_number' => 'string',
            'description' => 'string',
        ]);


        $validatedData['invoice_number'] = $this->generateInvoiceNumber();

        Invoice::create($validatedData);

        if ($request->has('save_only')) {
            # code to back and save
            return back()->with('success', 'Invoice added Succesfully!');
        } elseif ($request->has('save_and_back')) {
            # code to exit and save
            return redirect()->route('invoices.index')->with('success', 'Invoice added Succesfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $items = Item::where('invoice_id', $id)->get();
        $subtotal = Item::where('invoice_id', $id)->sum('price');
        $paid = Payment::where('invoice_id', $id)->sum('amount_paid');

        $payments = Payment::where('invoice_id', $id)->get();

        return view('pages.invoices.show')->with([
            'invoice' => $invoice,
            'items' => $items,
            'subtotal' => $subtotal,
            'paid' => $paid,
            'payments' => $payments,
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
        //
    }

    public function generateInvoiceNumber()
    {
        // Get the current year
        $year = date('Y');

        // Get the last invoice number from the database
        $lastInvoice = DB::table('invoices')->latest()->first();

        // Extract the sequential part of the last invoice number
        $lastSequential = $lastInvoice ? intval(substr($lastInvoice->invoice_number, -5)) : 0;

        // Increment the sequential part
        $newSequential = $lastSequential + 1;

        // Pad the sequential part with leading zeros
        $paddedSequential = str_pad($newSequential, 5, '0', STR_PAD_LEFT);

        // Create the new invoice number
        $invoiceNumber = "INV-$year-$paddedSequential";

        return $invoiceNumber;
    }

    public function markasdone($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->status = true;
        $invoice->save();
        return back()->with('success', 'succesfully completed!');
    }
}
