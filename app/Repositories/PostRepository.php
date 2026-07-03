<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    // Get all posts (newest first)
    public function getAll()
    {
        return Post::with(['user', 'category'])
            ->latest()
            ->get();
    }

    // Find one post by its ID
    public function findById($id)
    {
        return Post::findOrFail($id);
    }

    // Create a new post
    public function create(array $data)
    {
        return Post::create($data);
    }

    // Update an existing post
    public function update(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }

    // Delete a post
    public function delete(Post $post)
    {
        return $post->delete();
    }
}
