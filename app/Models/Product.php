<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'in_stock',
        'featured',
        'description',
        'size',
        'price',
        'discount_price',
        'product_size_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product_size()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }

    public function getProductImages() {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('order_by', 'asc');
    }

    public function getTranslatedInStock()
    {
        return $this->in_stock == 1 ? 'Yes' : 'No';
    }

    public function getTranslatedFeatured()
    {
        return $this->featured == 1 ? 'Yes' : 'No';
    }

    public function getFirstImage() {
        $productImages = $this->getProductImages;
        $imagePath = $productImages->isNotEmpty()
            ? $productImages->first()->image_name
            : '/assets/images/default_product.jpg';

        return url('storage/' . $imagePath); // Include url() generation here
    }
}
