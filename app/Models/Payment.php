<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'description',
        'transfer_date',
        'image',
        'amount_paid',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
