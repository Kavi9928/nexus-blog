<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

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

        // Popular tags — tags with most posts
        $popularTags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        // Top author — user with most posts
        $topAuthor = User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->first();

        return view('home', compact(
            'featuredPost',
            'latestPosts',
            'trendingPosts',
            'categories',
            'popularTags',
            'topAuthor'
        ));
    }
}