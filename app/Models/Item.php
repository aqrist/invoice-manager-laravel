<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'name',
        'qty',
        'price',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
