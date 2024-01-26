<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'town_id',
        'area_name',
        'price',
    ];

    public function city()
    {
        return $this->belongsTo(Town::class, 'town_id');
    }
}
