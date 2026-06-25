<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Artificial Intelligence', 'color' => '#D4AF37'],
            ['name' => 'Cybersecurity', 'color' => '#C0392B'],
            ['name' => 'Space Technology', 'color' => '#2980B9'],
            ['name' => 'Biotech & Health', 'color' => '#27AE60'],
            ['name' => 'Innovation', 'color' => '#8E44AD'],
            ['name' => 'Green Technology', 'color' => '#16A085'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => 'Latest news and insights about ' . $category['name'],
                'color' => $category['color'],
            ]);
        }
    }
}