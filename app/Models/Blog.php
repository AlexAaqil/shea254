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
        $image_path = $this->image ? 'blog-thumbnails/' . $this->image : 'default_blog.jpg';

        // Check if the image exists in storage, otherwise return the default image path
        if (Storage::disk('public')->exists($image_path)) {
            return Storage::url($image_path);
        } else {
            return asset('assets/images/default_product.jpg');
        }
    }
}
