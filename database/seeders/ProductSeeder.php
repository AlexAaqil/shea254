<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'title' => 'Aloe Vera',
                'slug',
                'price' => 600,
                'product_size' => null,
                'category_id' => null,
            ],
            [
                'title' => 'Liquid Black Soap 5L',
                'slug',
                'price' => 8000,
                'product_size' => '5 L',
                'category_id' => null,
            ],
            [
                'title' => 'Rose Water',
                'slug',
                'price' => 300,
                'product_size' => null,
                'category_id' => null,
            ],
            [
                'title' => 'Liquid Black Soap 1L',
                'slug',
                'price' => 1400,
                'product_size' => '1 L',
                'category_id' => null,
            ],
            [
                'title' => 'Baby Butter',
                'slug',
                'price' => 750,
                'product_size' => '200 g',
                'category_id' => null,
            ],
            [
                'title' => 'Hair Growth Oil',
                'slug',
                'price' => 750,
                'product_size' => '100 ml',
                'category_id' => null,
            ],
            [
                'title' => 'Vitamin C Serum',
                'slug',
                'price' => 1000,
                'product_size' => '30 ml',
                'category_id' => null,
            ],
            [
                'title' => 'Cedarwood Essential Oil',
                'slug',
                'price' => 700,
                'product_size' => '15 ml',
                'category_id' => 2,
            ],
            [
                'title' => 'Raw Black Soap',
                'slug',
                'price' => 1600,
                'product_size' => '1 Kg',
                'category_id' => null,
            ],
            [
                'title' => 'African Black Soap',
                'slug',
                'price' => 380,
                'product_size' => '200 g',
                'category_id' => null,
            ],
            [
                'title' => 'Lavender Essential Oil',
                'slug',
                'price' => 700,
                'product_size' => '15 ml',
                'category_id' => 2,
            ],
            [
                'title' => 'Rosemary Essential Oil',
                'slug',
                'price' => 700,
                'product_size' => '15 ml',
                'category_id' => 2,
            ],
            [
                'title' => 'Ghananian Shea',
                'slug',
                'price' => 1600,
                'product_size' => '1 Kg',
                'category_id' => null,
            ],
            [
                'title' => 'Raw Cocoa Butter',
                'slug',
                'price' => 1800,
                'product_size' => null,
                'category_id' => null,
            ],
            [
                'title' => 'Sweet Orange Scented Shea & Cocoa 200g',
                'slug',
                'price' => 750,
                'product_size' => '200 g',
                'category_id' => null,
            ],
            [
                'title' => 'Vanilla Scented Whipped Body Butter 200g',
                'slug',
                'price' => 750,
                'product_size' => '200 g',
                'category_id' => null,
            ],
            [
                'title' => 'Strawberry Scented Whipped Body Butter 200g',
                'slug',
                'price' => 750,
                'product_size' => '200 g',
                'category_id' => null,
            ],
            [
                'title' => 'Unscented Whipped Body Butter',
                'slug',
                'price' => 1150,
                'product_size' => '400 g',
                'category_id' => null,
            ],
            [
                'title' => 'Sweet Orange Scented Shea & Cocoa 400g',
                'slug',
                'price' => 1150,
                'product_size' => '400 g',
                'category_id' => null,
            ],
            [
                'title' => 'Vanilla Scented Whipped Body Butter 400g',
                'slug',
                'price' => 1150,
                'product_size' => '400 g',
                'category_id' => null,
            ],
            [
                'title' => 'Strawberry Scented Whipped Body Butter 400g',
                'slug',
                'price' => 1150,
                'product_size' => '400 g',
                'category_id' => null,
            ],
            [
                'title' => 'Body Elixir (Anti-Stretchmarks)',
                'slug',
                'price' => 1000,
                'product_size' => '100 ml',
                'category_id' => null,
            ],
            [
                'title' => 'Avocado Oil',
                'slug',
                'price' => 400,
                'product_size' => '100 ml',
                'category_id' => null,
            ],
            [
                'title' => 'Baobab Oil',
                'slug',
                'price' => 700,
                'product_size' => '60 ml',
                'category_id' => null,
            ],
            [
                'title' => 'Black Castor Oil',
                'slug',
                'price' => 650,
                'product_size' => '100 ml',
                'category_id' => null,
            ],
            [
                'title' => 'Sweet Orange Essential Oil',
                'slug',
                'price' => 700,
                'product_size' => '15 ml',
                'category_id' => 2,
            ],
            [
                'title' => 'Tea Tree Essential Oil',
                'slug',
                'price' => 700,
                'product_size' => '15 ml',
                'category_id' => 2,
            ],
            [
                'title' => 'Lemongrass Essential Oil',
                'slug',
                'price' => 750,
                'product_size' => '15 ml',
                'category_id' => 2,
            ],
            [
                'title' => 'Citronella Essential Oil',
                'slug',
                'price' => 500,
                'product_size' => '15 ml',
                'category_id' => 2,
            ],
            [
                'title' => 'Vitamin E Oil',
                'slug',
                'price' => 400,
                'product_size' => '30 ml',
                'category_id' => null,
            ],
            [
                'title' => 'Raw Ugandan',
                'slug',
                'price' => 550,
                'product_size' => '350 g',
                'category_id' => null,
            ],
            [
                'title' => 'Moisturizing Hair Shampoo',
                'slug',
                'price' => 800,
                'product_size' => '250 g',
                'category_id' => null,
            ],
            [
                'title' => 'Leave-in Hair Conditioner',
                'slug',
                'price' => 1000,
                'product_size' => '250 g',
                'category_id' => null,
            ],
            [
                'title' => 'Shea lotion (Rasberry)',
                'slug',
                'price' => 650,
                'product_size' => '250 g',
                'category_id' => null,
            ],
            [
                'title' => 'Hair Growth Butter',
                'slug',
                'price' => 1000,
                'product_size' => null,
                'category_id' => null,
            ],
            [
                'title' => 'Scented Mango Butter',
                'slug',
                'price' => 900,
                'product_size' => '500 g',
                'category_id' => null,
            ],
            [
                'title' => 'Grapeseed Oil',
                'slug',
                'price' => 950,
                'product_size' => null,
                'category_id' => null,
            ],
            [
                'title' => 'Hair Growth Butter 100ml',
                'slug',
                'price' => 950,
                'product_size' => '100 ml',
                'category_id' => null,
            ],
            [
                'title' => 'Rosehip Oil',
                'slug',
                'price' => 950,
                'product_size' => null,
                'category_id' => null,
            ],
            [
                'title' => 'Liquid Black Soap with Honey',
                'slug',
                'price' => 400,
                'product_size' => '100 ml',
                'category_id' => null,
            ],
            [
                'title' => 'Lip Balm',
                'slug',
                'price' => 150,
                'product_size' => null,
                'category_id' => null,
            ],
            [
                'title' => 'Shea Butter',
                'slug',
                'price' => 1200,
                'product_size' => '1 Kg',
                'category_id' => null,
            ],
            [
                'title' => 'Liquid Soap',
                'slug',
                'price' => 650,
                'product_size' => '250 g',
                'category_id' => null,
            ],
        ];

        foreach($products as $product) {
            Product::create([
                'title' => $product['title'],
                'slug' => Str::slug($product['title']),
                'price' => $product['price'],
                'product_size' => $product['product_size'],
                'category_id' => $product['category_id'],
            ]);
        }
    }
}
