<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPost = Post::with(['user', 'category', 'tags'])
            ->published()
            ->latest('published_at')
            ->first();

        $latestPosts = Post::with(['user', 'category'])
            ->published()
            ->latest('published_at')
            ->skip(1)
            ->take(4)
            ->get();

        $trendingPosts = Post::with(['user', 'category'])
            ->published()
            ->trending()
            ->take(3)
            ->get();

        $categories = Category::withCount('posts')->get();

        return view('home', compact(
            'featuredPost',
            'latestPosts',
            'trendingPosts',
            'categories'
        ));
    }
}