<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;

class ArticleFilter extends Component
{
    public $selectedCategory = 'all';

    public function setCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function render()
    {
        $query = Post::with(['user', 'category'])->published()->latest('published_at');

        if ($this->selectedCategory !== 'all') {
            $query->where('category_id', $this->selectedCategory);
        }

        $posts = $query->get();
        $categories = Category::withCount('posts')->get();

        return view('livewire.article-filter', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}