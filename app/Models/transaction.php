<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $fillable = [
        'order_id',
        'paid_amount',
        'balance',
        'payment_method',
        'user_id',
        'transaction_date',
        'transaction_amount',
    ];
}
