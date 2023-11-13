<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Item;
use App\Models\Payment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $earning = Item::all()->sum('price');
        $payment = Payment::all()->sum('amount_paid');

        $totalinvoice = Invoice::count();
        $doneinvoice = Invoice::where('status', 1)->count();
        $tasks = ceil(($doneinvoice / $totalinvoice) * 100);

        $balance_due = $earning - $payment;

        $items = Item::all()->count();

        return view('home')->with([
            'earning' => $earning,
            'balance_due' => $balance_due,
            'tasks' => $tasks,
            'items' => $items,
        ]);
    }
}
