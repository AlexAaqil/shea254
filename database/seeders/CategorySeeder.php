<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            'carrier oil',
            'essential oil',
            'liquid black soap',
            'raw black soap',
            'raw cocoa butter',
            'raw shea butter',
            'soaps',
            'whipped cocoa',
            'whipped shea & cocoa',
        ];

        foreach($titles as $title)
        {
            Category::create([
                'title' => $title,
                'slug' => Str::slug($title),
            ]);
        }
    }
}
