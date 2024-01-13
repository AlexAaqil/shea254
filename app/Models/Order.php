<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'additional_information',
        'city',
        'town',
        'cart_items',
        'shipping_cost',
        'total_amount',
    ];
}
