<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Laravel', 'Livewire', 'PHP', 'JavaScript',
            'AI', 'Machine Learning', 'ChatGPT', 'Python',
            'Cybersecurity', 'Blockchain', 'Web3', 'Cloud',
            'SpaceX', 'NASA', 'Quantum Computing', 'Robotics',
            'CRISPR', 'Biotech', 'Climate Tech', 'Solar Energy',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
            ]);
        }
    }
}