<?php

namespace Database\Seeders;

use App\Models\ProductSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            '15 ml',
            '30 ml',
            '100 ml',
            '200 g',
            '250 g',
            '400 g',
            '1 kg',
            '1 liter',
        ];

        foreach($sizes as $size)
        {
            ProductSize::create([
                'product_size' => $size,
            ]);
        }
    }
}
