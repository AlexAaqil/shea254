<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    use HasFactory;

    protected $fillable =[
        'order_id',
        'full_name',
        'email',
        'phone_number',
        'address',
        'additional_information',
        'location',
        'area',
        'shipping_cost',
        'delivery_status',
    ];

    public function order()
    {
        return $this->belongsTo(Sale::class, 'order_id');
    }
}
