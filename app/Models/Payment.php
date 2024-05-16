<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'payment_gateway',
        'merchant_request_id',
        'checkout_request_id',
        'transaction_reference',
        'response_code',
        'response_description',
        'customer_message',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Sale::class, 'order_id');
    }
}
