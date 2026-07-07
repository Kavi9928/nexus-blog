<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Support\Str;

class PostService
{
    protected $postRepository;

    // Laravel automatically gives us the Repository (dependency injection)
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    // Get all posts
    public function getAllPosts()
    {
        return $this->postRepository->getAll();
    }

    // Get one post
    public function getPost($id)
    {
        return $this->postRepository->findById($id);
    }

    // Create a post — with business logic
    public function createPost(array $data)
    {
        $data['slug'] = $this->makeSlug($data['title']);
        $data['reading_time'] = $this->calculateReadingTime($data['content']);
        $data['user_id'] = auth()->id();

        return $this->postRepository->create($data);
    }

    // Update a post — with business logic
    public function updatePost(Post $post, array $data)
    {
        $data['slug'] = $this->makeSlug($data['title']);
        $data['reading_time'] = $this->calculateReadingTime($data['content']);

        return $this->postRepository->update($post, $data);
    }

    // Delete a post
    public function deletePost(Post $post)
    {
        return $this->postRepository->delete($post);
    }

    // --- Private helper methods (business rules) ---

    // Turn "My First Post" into "my-first-post"
    private function makeSlug($title)
    {
        return Str::slug($title) . '-' . Str::random(5);
    }

    // Estimate reading time: ~200 words per minute
    private function calculateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        return max(1, ceil($wordCount / 200));
    }
}
