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
            'whipped body butter',
            'raw butter',
            'liquid soap',
            'solid soap',
            'hair care',
            'body oil',
            'essential oil',
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
