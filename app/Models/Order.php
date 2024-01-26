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
        'location',
        'area',
        'cart_items',
        'shipping_cost',
        'total_amount',
        'status',
        'paid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getPendingOrders()
    {
        return self::select('orders.*')
        ->where('status', '=', 'pending')
        ->get();
    }
}
