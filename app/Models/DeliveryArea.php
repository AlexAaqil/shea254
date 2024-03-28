<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'area_name',
        'price',
    ];

    public function location()
    {
        return $this->belongsTo(DeliveryLocation::class, 'location_id');
    }
}
