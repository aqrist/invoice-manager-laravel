<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'billto',
        'billfrom',
        'invoice_number',
        'start_date',
        'due_date',
        'notes',
        'terms',
        'amount_paid',
        'discount',
        'status',
    ];

    // public function ticket()
    // {
    //     return $this->belongsTo(Ticket::class);
    // }
}
