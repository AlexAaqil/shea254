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
                'product_size' => ''
            ],
            [
                'title' => 'Liquid Black Soap 5L',
                'slug',
                'price' => 8000,
                'product_size' => '5 L'
            ],
            [
                'title' => 'Rose Water',
                'slug',
                'price' => 300,
                'product_size' => ''
            ],
            [
                'title' => 'Liquid Black Soap 1L',
                'slug',
                'price' => 1400,
                'product_size' => '1 L'
            ],
            [
                'title' => 'Baby Butter',
                'slug',
                'price' => 750,
                'product_size' => '200 g'
            ],
            [
                'title' => 'Hair Growth Oil',
                'slug',
                'price' => 750,
                'product_size' => '100 ml'
            ],
            [
                'title' => 'Vitamin C Serum',
                'slug',
                'price' => 1000,
                'product_size' => '30 ml'
            ],
            [
                'title' => 'Cedarwood Essential Oil',
                'slug',
                'price' => 700,
                'product_size' => '15 ml'
            ],
            [
                'title' => 'Raw Black Soap',
                'slug',
                'price' => 1600,
                'product_size' => '1 Kg'
            ],
            [
                'title' => 'African Black Soap',
                'slug',
                'price' => 380,
                'product_size' => '200 g'
            ],
            [
                'title' => 'Lavender Essential Oil',
                'slug',
                'price' => 700,
                'product_size' => '15 ml'
            ],
            [
                'title' => 'Rosemary Essential Oil',
                'slug',
                'price' => 700,
                'product_size' => '15 ml'
            ],
            [
                'title' => 'Ghananian Shea',
                'slug',
                'price' => 1600,
                'product_size' => '1 Kg'
            ],
            [
                'title' => 'Raw Cocoa Butter',
                'slug',
                'price' => 1800,
                'product_size' => ''
            ],
            [
                'title' => 'Sweet Orange Scented Shea & Cocoa 200g',
                'slug',
                'price' => 750,
                'product_size' => '200 g'
            ],
            [
                'title' => 'Vanilla Scented Whipped Body Butter 200g',
                'slug',
                'price' => 750,
                'product_size' => '200 g'
            ],
            [
                'title' => 'Strawberry Scented Whipped Body Butter 200g',
                'slug',
                'price' => 750,
                'product_size' => '200 g'
            ],
            [
                'title' => 'Unscented Whipped Body Butter',
                'slug',
                'price' => 1150,
                'product_size' => '400 g'
            ],
            [
                'title' => 'Sweet Orange Scented Shea & Cocoa 400g',
                'slug',
                'price' => 1150,
                'product_size' => '400 g'
            ],
            [
                'title' => 'Vanilla Scented Whipped Body Butter 400g',
                'slug',
                'price' => 1150,
                'product_size' => '400 g'
            ],
            [
                'title' => 'Strawberry Scented Whipped Body Butter 400g',
                'slug',
                'price' => 1150,
                'product_size' => '400 g'
            ],
            [
                'title' => 'Body Elixir (Anti-Stretchmarks)',
                'slug',
                'price' => 1000,
                'product_size' => '100 ml'
            ],
            [
                'title' => 'Avocado Oil',
                'slug',
                'price' => 400,
                'product_size' => '100 ml'
            ],
            [
                'title' => 'Baobab Oil',
                'slug',
                'price' => 700,
                'product_size' => '60 ml'
            ],
            [
                'title' => 'Black Castor Oil',
                'slug',
                'price' => 650,
                'product_size' => '100 ml'
            ],
            [
                'title' => 'Sweet Orange Essential Oil',
                'slug',
                'price' => 700,
                'product_size' => '15 ml'
            ],
            [
                'title' => 'Tea Tree Essential Oil',
                'slug',
                'price' => 700,
                'product_size' => '15 ml'
            ],
            [
                'title' => 'Lemongrass Essential Oil',
                'slug',
                'price' => 750,
                'product_size' => '15 ml'
            ],
            [
                'title' => 'Citronella Essential Oil',
                'slug',
                'price' => 500,
                'product_size' => '15 ml'
            ],
            [
                'title' => 'Vitamin E Oil',
                'slug',
                'price' => 400,
                'product_size' => '30 ml'
            ],
            [
                'title' => 'Raw Ugandan',
                'slug',
                'price' => 550,
                'product_size' => '350 g'
            ],
            [
                'title' => 'Moisturizing Hair Shampoo',
                'slug',
                'price' => 800,
                'product_size' => '250 g'
            ],
            [
                'title' => 'Leave-in Hair Conditioner',
                'slug',
                'price' => 1000,
                'product_size' => '250 g'
            ],
            [
                'title' => 'Shea lotion (Rasberry)',
                'slug',
                'price' => 650,
                'product_size' => '250 g'
            ],
            [
                'title' => 'Hair Growth Butter',
                'slug',
                'price' => 1000,
                'product_size' => ''
            ],
            [
                'title' => 'Scented Mango Butter',
                'slug',
                'price' => 900,
                'product_size' => '500 g'
            ],
            [
                'title' => 'Grapeseed Oil',
                'slug',
                'price' => 950,
                'product_size' => ''
            ],
            [
                'title' => 'Hair Growth Butter 100ml',
                'slug',
                'price' => 950,
                'product_size' => '100 ml'
            ],
            [
                'title' => 'Rosehip Oil',
                'slug',
                'price' => 950,
                'product_size' => ''
            ],
            [
                'title' => 'Liquid Black Soap with Honey',
                'slug',
                'price' => 400,
                'product_size' => '100 ml'
            ],
            [
                'title' => 'Lip Balm',
                'slug',
                'price' => 150,
                'product_size' => ''
            ],
            [
                'title' => 'Shea Butter',
                'slug',
                'price' => 1200,
                'product_size' => '1 Kg'
            ],
            [
                'title' => 'Liquid Soap',
                'slug',
                'price' => 650,
                'product_size' => '250 g'
            ],
        ];

        foreach($products as $product) {
            Product::create([
                'title' => $product['title'],
                'slug' => Str::slug($product['title']),
                'price' => $product['price'],
                'product_size' => $product['product_size'],
            ]);
        }
    }
}
