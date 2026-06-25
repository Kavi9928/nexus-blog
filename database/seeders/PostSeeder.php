<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $categories = Category::all();
        $tags = Tag::all();

        $posts = [
            [
                'title' => 'The AI Revolution is Reshaping How We Build the Future',
                'excerpt' => 'From autonomous systems to generative intelligence, the technological transformation of 2026 is unlike anything humanity has witnessed.',
                'content' => 'Artificial intelligence is no longer a concept of the future — it is the defining force of our present. From the way we write code to how we diagnose diseases, AI has permeated every layer of modern life. In 2026, we stand at an inflection point where the technology is not just assisting human decisions but actively shaping the trajectory of civilization itself. The breakthroughs we are witnessing today in large language models, computer vision, and autonomous reasoning are setting the stage for a world that will look fundamentally different a decade from now.',
                'views' => 12400,
                'reading_time' => 8,
                'category' => 'Artificial Intelligence',
                'tags' => ['AI', 'Machine Learning', 'ChatGPT'],
            ],
            [
                'title' => 'Claude 4 Opus Breaks Every Benchmark in Reasoning Tasks',
                'excerpt' => 'Anthropic\'s latest model sets new standards in logical reasoning, coding, and multimodal understanding.',
                'content' => 'Anthropic has released Claude 4 Opus, and the results are nothing short of extraordinary. In comprehensive benchmark testing across reasoning, coding, mathematics, and multimodal tasks, Claude 4 Opus has surpassed all previous records set by competing models. The model demonstrates unprecedented ability to handle complex multi-step reasoning chains, write production-quality code, and analyze visual information with remarkable accuracy.',
                'views' => 9800,
                'reading_time' => 6,
                'category' => 'Artificial Intelligence',
                'tags' => ['AI', 'ChatGPT', 'Python'],
            ],
            [
                'title' => 'Post-Quantum Encryption Becomes Mandatory in EU Regulations',
                'excerpt' => 'European Union mandates quantum-resistant cryptography for all government and financial systems by 2027.',
                'content' => 'The European Union has passed landmark legislation requiring all government agencies and financial institutions to implement post-quantum cryptographic standards by the end of 2027. This regulatory shift comes in response to growing concerns about the threat posed by quantum computers to current encryption standards. Security experts have long warned that sufficiently powerful quantum computers could break RSA and elliptic curve cryptography.',
                'views' => 7200,
                'reading_time' => 5,
                'category' => 'Cybersecurity',
                'tags' => ['Cybersecurity', 'Quantum Computing', 'Blockchain'],
            ],
            [
                'title' => 'SpaceX Starship Completes First Crewed Mars Trajectory Test',
                'excerpt' => 'A historic milestone as SpaceX successfully tests Starship on a crewed Mars trajectory simulation.',
                'content' => 'SpaceX has achieved what many once thought impossible within this decade — a successful crewed test flight along a simulated Mars trajectory. The Starship vehicle, carrying a crew of four astronauts, completed a 72-hour mission that simulated the conditions of an actual Mars transit. The test validated life support systems, radiation shielding, and the psychological resilience of crew members during extended deep space travel.',
                'views' => 15600,
                'reading_time' => 7,
                'category' => 'Space Technology',
                'tags' => ['SpaceX', 'NASA', 'Robotics'],
            ],
            [
                'title' => 'CRISPR Gene Therapy Cures Hereditary Blindness in Clinical Trial',
                'excerpt' => 'Groundbreaking results from a Phase 3 clinical trial show complete vision restoration in 89% of patients.',
                'content' => 'In what scientists are calling one of the most significant medical breakthroughs of the decade, a Phase 3 clinical trial using CRISPR-based gene therapy has successfully restored vision in 89% of patients suffering from Leber congenital amaurosis, a hereditary form of blindness. The therapy works by precisely editing the mutated CEP290 gene directly within the photoreceptor cells of the eye.',
                'views' => 11300,
                'reading_time' => 9,
                'category' => 'Biotech & Health',
                'tags' => ['CRISPR', 'Biotech'],
            ],
            [
                'title' => 'Solar Panel Efficiency Hits 47% — A New World Record',
                'excerpt' => 'Scientists at MIT achieve a new world record in solar cell efficiency using perovskite-silicon tandem technology.',
                'content' => 'Researchers at the Massachusetts Institute of Technology have shattered the previous world record for solar panel efficiency, achieving a remarkable 47.3% conversion rate using a novel perovskite-silicon tandem cell design. This breakthrough could dramatically accelerate the transition to renewable energy by making solar power significantly more cost-effective per watt generated.',
                'views' => 8900,
                'reading_time' => 4,
                'category' => 'Green Technology',
                'tags' => ['Solar Energy', 'Climate Tech', 'Cloud'],
            ],
        ];

        foreach ($posts as $postData) {
            $category = $categories->where('name', $postData['category'])->first();

            $post = Post::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'excerpt' => $postData['excerpt'],
                'content' => $postData['content'],
                'status' => 'published',
                'views' => $postData['views'],
                'reading_time' => $postData['reading_time'],
                'published_at' => now(),
            ]);

            $postTags = $tags->whereIn('name', $postData['tags']);
            $post->tags()->attach($postTags->pluck('id'));
        }
    }
}