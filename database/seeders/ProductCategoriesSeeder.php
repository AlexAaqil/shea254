<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            'body butter',
            'carrier oil',
            'essential oil',
            'gel',
            'hair care',
            'liquid black soap',
            'raw black soap',
            'raw butter',
            // 'raw shea butter',
            'scrub',
            'toners & serums',
            'soap',
            'whipped cocoa',
            'whipped Butters',
            'creams & gels',
        ];

        foreach($titles as $title)
        {
            ProductCategory::create([
                'title' => $title,
                'slug' => Str::slug($title),
            ]);
        }
    }
}
