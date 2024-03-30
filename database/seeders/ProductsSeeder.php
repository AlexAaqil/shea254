<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                "title" => "1 Liter Liquid black soap with tea tree essential oil",
                "product_code" => 10102,
                "selling_price" => 2250.00,
                "buying_price" => 1200.00,
            ],
            [
                "title" => "1 Litre Black soap",
                "product_code" => 10058,
                "selling_price" => 1400.00,
                "buying_price" => 650,
            ],
            [
                "title" => "100ml Aloe Vera",
                "product_code" => 63,
                "selling_price" => 600,
                "buying_price" => 240,
            ],
            [
                "title" => "1kg Black Soap",
                "product_code" => 27,
                "selling_price" => 1700.00,
                "buying_price" => 860,
            ],
            [
                "title" => "200g (Strawberry) whipped",
                "product_code" => 10072,
                "selling_price" => 750,
                "buying_price" => 250,
            ],
            [
                "title" => "200g SheaNCocoa",
                "product_code" => 56,
                "selling_price" => 750,
                "buying_price" => 405,
            ],
            [
                "title" => "200g unscented (new)",
                "product_code" => 58,
                "selling_price" => 750,
                "buying_price" => 353,
            ],
            [
                "title" => "200g Whipped Shea(Vanilla)",
                "product_code" => 10090,
                "selling_price" => 750,
                "buying_price" => 320,
            ],
            [
                "title" => "250g Black Soap",
                "product_code" => 1,
                "selling_price" => 500,
                "buying_price" => 200,
            ],
            [
                "title" => "350g Black Soap",
                "product_code" => 29,
                "selling_price" => 550,
                "buying_price" => 400,
            ],
            [
                "title" => "3in1 Clay Mask",
                "product_code" => 10115,
                "selling_price" => 500,
                "buying_price" => 155,
            ],
            [
                "title" => "400g - Shea&cocoa (Sweet Orange)",
                "product_code" => 54,
                "selling_price" => 1150.00,
                "buying_price" => 400,
            ],
            [
                "title" => "400g (Strawberry) whipped",
                "product_code" => 10068,
                "selling_price" => 1150.00,
                "buying_price" => 480,
            ],
            [
                "title" => "400g Unscented",
                "product_code" => 62,
                "selling_price" => 1150.00,
                "buying_price" => 500,
            ],
            [
                "title" => "5 Liter Liquid Soap",
                "product_code" => 10071,
                "selling_price" => 8000.00,
                "buying_price" => 3250.00,
            ],
            [
                "title" => "500g Black Soap",
                "product_code" => 28,
                "selling_price" => 1150.00,
                "buying_price" => 359,
            ],
            [
                "title" => "Activated Charcoal soap",
                "product_code" => 10093,
                "selling_price" => 350,
                "buying_price" => 115,
            ],
            [
                "title" => "Atlas Cedarwood",
                "product_code" => 14,
                "selling_price" => 700,
                "buying_price" => 343,
            ],
            [
                "title" => "Avocado oil",
                "product_code" => 35,
                "selling_price" => 400,
                "buying_price" => 159,
            ],
            [
                "title" => "Baby butter",
                "product_code" => 74,
                "selling_price" => 750,
                "buying_price" => 425,
            ],
            [
                "title" => "Baby Soap",
                "product_code" => 10103,
                "selling_price" => 350,
                "buying_price" => 110,
            ],
            [
                "title" => "Baobab oil 60ml (new)",
                "product_code" => 34,
                "selling_price" => 700,
                "buying_price" => 400,
            ],
            [
                "title" => "Black Castor Oil",
                "product_code" => 64,
                "selling_price" => 650,
                "buying_price" => 470,
            ],
            [
                "title" => "Body Elixir( Stretchmarks oil) 100ml",
                "product_code" => 10096,
                "selling_price" => 1000.00,
                "buying_price" => 600,
            ],
            [
                "title" => "Castor oil",
                "product_code" => 33,
                "selling_price" => 450,
                "buying_price" => 122,
            ],
            [
                "title" => "Citronella",
                "product_code" => 16,
                "selling_price" => 700,
                "buying_price" => 304,
            ],
            [
                "title" => "Cocoa 1kg",
                "product_code" => 23,
                "selling_price" => 2000.00,
                "buying_price" => 1000.00,
            ],
            [
                "title" => "Cocoa 250g",
                "product_code" => 10104,
                "selling_price" => 750,
                "buying_price" => 470,
            ],
            [
                "title" => "Cocoa 500g",
                "product_code" => 10005,
                "selling_price" => 1250.00,
                "buying_price" => 400,
            ],
            [
                "title" => "Coconut oil 60ml",
                "product_code" => 10007,
                "selling_price" => 400,
                "buying_price" => 180,
            ],
            [
                "title" => "Coffee Scrub",
                "product_code" => 10101,
                "selling_price" => 1000.00,
                "buying_price" => 390,
            ],
            [
                "title" => "Eucalyptus",
                "product_code" => 10112,
                "selling_price" => 700,
                "buying_price" => 400,
            ],
            [
                "title" => "Frankincense",
                "product_code" => 10111,
                "selling_price" => 700,
                "buying_price" => 400,
            ],
            [
                "title" => "Geranium",
                "product_code" => 10113,
                "selling_price" => 700,
                "buying_price" => 400,
            ],
            [
                "title" => "Ghana 500g",
                "product_code" => 10122,
                "selling_price" => 1000.00,
                "buying_price" => 500,
            ],
            [
                "title" => "Goat Milk soap",
                "product_code" => 10082,
                "selling_price" => 350,
                "buying_price" => 100,
            ],
            [
                "title" => "Grapeseed 30ml",
                "product_code" => 10087,
                "selling_price" => 450,
                "buying_price" => 350,
            ],
            [
                "title" => "Grapeseed Oil 100ml",
                "product_code" => 10088,
                "selling_price" => 950,
                "buying_price" => 500,
            ],
            [
                "title" => "Hair Growth butter 200g",
                "product_code" => 10097,
                "selling_price" => 1000.00,
                "buying_price" => 690,
            ],
            [
                "title" => "Hair Oil",
                "product_code" => 10054,
                "selling_price" => 750,
                "buying_price" => 230,
            ],
            [
                "title" => "Hair Shampoo",
                "product_code" => 10099,
                "selling_price" => 800,
                "buying_price" => 450,
            ],
            [
                "title" => "Honey Liquid Black soap",
                "product_code" => 81,
                "selling_price" => 400,
                "buying_price" => 222,
            ],
            [
                "title" => "Hyaluronic Serum",
                "product_code" => 10106,
                "selling_price" => 1000.00,
                "buying_price" => 380,
            ],
            [
                "title" => "Jojoba oil 100ml",
                "product_code" => 10084,
                "selling_price" => 950,
                "buying_price" => 550,
            ],
            [
                "title" => "Jojoba oil 30ml",
                "product_code" => 10083,
                "selling_price" => 450,
                "buying_price" => 350,
            ],
            [
                "title" => "Kojic soap 100g",
                "product_code" => 10094,
                "selling_price" => 350,
                "buying_price" => 80,
            ],
            [
                "title" => "Lavender",
                "product_code" => 86,
                "selling_price" => 750,
                "buying_price" => 230,
            ],
            [
                "title" => "Lavender 200g (Whipped Body Butter)",
                "product_code" => 10117,
                "selling_price" => 750,
                "buying_price" => 250,
            ],
            [
                "title" => "Lavender 400g (Whipped Body Butter)",
                "product_code" => 10116,
                "selling_price" => 1150.00,
                "buying_price" => 450,
            ],
            [
                "title" => "LAVENDER FOAMING SCRUB",
                "product_code" => 10120,
                "selling_price" => 750,
                "buying_price" => 380,
            ],
            [
                "title" => "Leave-in Conditioner",
                "product_code" => 10100,
                "selling_price" => 1000.00,
                "buying_price" => 505,
            ],
            [
                "title" => "Lemon",
                "product_code" => 13,
                "selling_price" => 700,
                "buying_price" => 315.92,
            ],
            [
                "title" => "Lemongrass",
                "product_code" => 18,
                "selling_price" => 750,
                "buying_price" => 289.47,
            ],
            [
                "title" => "Lemongrass 200g (Whipped Body Butter)",
                "product_code" => 10119,
                "selling_price" => 750,
                "buying_price" => 250,
            ],
            [
                "title" => "Lemongrass 400g (Whipped Body Butter)",
                "product_code" => 10118,
                "selling_price" => 1150.00,
                "buying_price" => 450,
            ],
            [
                "title" => "Lip balm",
                "product_code" => 79,
                "selling_price" => 200,
                "buying_price" => 40,
            ],
            [
                "title" => "Liquid black soap - Tea Tree",
                "product_code" => 3,
                "selling_price" => 650,
                "buying_price" => 248,
            ],
            [
                "title" => "Niacinamide Serum",
                "product_code" => 10107,
                "selling_price" => 1000.00,
                "buying_price" => 380,
            ],
            [
                "title" => "Peppermint",
                "product_code" => 10114,
                "selling_price" => 700,
                "buying_price" => 400,
            ],
            [
                "title" => "PEPPERMINT FOAMING SCRUB",
                "product_code" => 10121,
                "selling_price" => 750,
                "buying_price" => 380,
            ],
            [
                "title" => "Retinol Serum",
                "product_code" => 10109,
                "selling_price" => 1000.00,
                "buying_price" => 380,
            ],
            [
                "title" => "Rice Soap 100g",
                "product_code" => 10081,
                "selling_price" => 350,
                "buying_price" => 150,
            ],
            [
                "title" => "Rose Water",
                "product_code" => 60,
                "selling_price" => 300,
                "buying_price" => 150,
            ],
            [
                "title" => "Rosehip oil 100ml",
                "product_code" => 10086,
                "selling_price" => 950,
                "buying_price" => 550,
            ],
            [
                "title" => "Rosehip oil 30ml",
                "product_code" => 10085,
                "selling_price" => 450,
                "buying_price" => 350,
            ],
            [
                "title" => "Rosemary",
                "product_code" => 19,
                "selling_price" => 700,
                "buying_price" => 234,
            ],
            [
                "title" => "Salicylic Serum",
                "product_code" => 10108,
                "selling_price" => 1000.00,
                "buying_price" => 380,
            ],
            [
                "title" => "Scented Mango Butter",
                "product_code" => 10067,
                "selling_price" => 900,
                "buying_price" => 300,
            ],
            [
                "title" => "Shea 1 kg Ghana",
                "product_code" => 10077,
                "selling_price" => 1700.00,
                "buying_price" => 800,
            ],
            [
                "title" => "Shea 1kg Nilotica",
                "product_code" => 10002,
                "selling_price" => 1200.00,
                "buying_price" => 700,
            ],
            [
                "title" => "Shea 350g Nilotica",
                "product_code" => 10003,
                "selling_price" => 550,
                "buying_price" => 319,
            ],
            [
                "title" => "Shea Lotion",
                "product_code" => 10098,
                "selling_price" => 650,
                "buying_price" => 390,
            ],
            [
                "title" => "Shea Vanilla 400g",
                "product_code" => 10089,
                "selling_price" => 1150.00,
                "buying_price" => 450,
            ],
            [
                "title" => "Sweet Myrrh",
                "product_code" => 10110,
                "selling_price" => 700,
                "buying_price" => 400,
            ],
            [
                "title" => "Sweet orange",
                "product_code" => 17,
                "selling_price" => 700,
                "buying_price" => 274,
            ],
            [
                "title" => "Tea tree",
                "product_code" => 15,
                "selling_price" => 700,
                "buying_price" => 337,
            ],
            [
                "title" => "Tumeric & honey soap",
                "product_code" => 10105,
                "selling_price" => 350,
                "buying_price" => 115,
            ],
            [
                "title" => "Vitamin C serum",
                "product_code" => 10095,
                "selling_price" => 1000.00,
                "buying_price" => 308,
            ],
            [
                "title" => "Vitamin E",
                "product_code" => 30,
                "selling_price" => 400,
                "buying_price" => 200,
            ]
        ];

        foreach($products as $product) {
            Product::create([
                'title' => $product['title'],
                'slug' => Str::slug($product['title']),
                'product_code' =>$product['product_code'],
                'selling_price' => $product['selling_price'],
                'buying_price' => $product['buying_price'],
            ]);
        }
    }
}
