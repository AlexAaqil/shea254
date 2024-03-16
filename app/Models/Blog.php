<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    public function getImageUrl()
    {
        if($this->image) {
            return asset($this->image);
        } else {
            return asset('assets/images/default_product.jpg');
        }
    }
}
