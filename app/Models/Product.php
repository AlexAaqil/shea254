<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'category_id',
        'order',
    ];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function getProductImages() {
        return $this->hasMany(ProductImages::class, 'product_id')->orderBy('order', 'asc');
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
            : 'default_image.jpg';

        // Check if the image exists in storage, otherwise return the default image path
        if ($productImages->isNotEmpty() && Storage::disk('public')->exists($imagePath)) {
            return Storage::url($imagePath);
        } else {
            return asset('assets/images/default_image.jpg');
        }
    }

    public function calculateDiscount()
    {
        if ($this->discount_price && $this->discount_price < $this->price) {
            // Calculate the discount percentage
            $discountPercentage = (($this->price - $this->discount_price) / $this->price) * 100;

            // Set the new price and percentage in the model
            $this->new_price = $this->discount_price;
            $this->discount_percentage = round($discountPercentage, 0);
        } else {
            // If no discount, set the new price as the regular price
            $this->new_price = $this->price;
            $this->discount_percentage = 0;
        }

        return $this->discount_percentage;
    }
}
