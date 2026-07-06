<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\NewsItem;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPost = Post::with(['user', 'category', 'tags'])
            ->published()
            ->latest('published_at')
            ->latest('id')
            ->first();

        $latestPosts = Post::with(['user', 'category'])
            ->published()
            ->when($featuredPost, fn ($query) => $query->where('id', '!=', $featuredPost->id))
            ->latest('published_at')
            ->latest('id')
            ->take(4)
            ->get();

        $newsItems = NewsItem::orderByDesc('published_at')
            ->take(12)
            ->get();

        $heroPosts = Post::with('category')
            ->published()
            ->latest('published_at')
            ->latest('id')
            ->take(12)
            ->get();

        $trendingPosts = Post::with(['user', 'category'])
            ->published()
            ->trending()
            ->take(4)
            ->get();

        $categories = Category::withCount('posts')->get();

        return view('home', compact(
            'featuredPost',
            'newsItems',
            'heroPosts',
            'latestPosts',
            'trendingPosts',
            'categories'
        ));
    }

    public function show(Post $post)
    {
        // Only show published posts
        if ($post->status !== 'published') {
            abort(404);
        }

        // Increment view count
        $post->increment('views');

        // Load relationships
        $post->load(['user', 'category', 'tags']);

        // Get related posts (same category, exclude current)
        $relatedPosts = Post::with(['user', 'category'])
            ->published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        // Most-read sidebar list
        $mostRead = Post::with('category')
            ->published()
            ->where('id', '!=', $post->id)
            ->orderByDesc('views')
            ->take(5)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts', 'mostRead'));
    }
}
