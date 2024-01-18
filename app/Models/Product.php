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
        'order',
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

        return $this;
    }
}
