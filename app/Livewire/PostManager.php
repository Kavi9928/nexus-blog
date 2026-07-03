<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use App\Services\PostService;

class PostManager extends Component
{
    // Form fields
    public $title = '';
    public $excerpt = '';
    public $content = '';
    public $category_id = '';
    public $status = 'draft';

    // Track which post we're editing (null = creating new)
    public $editingPostId = null;

    // Show/hide the form
    public $showForm = false;

    // Validation rules
    protected $rules = [
        'title' => 'required|min:5',
        'excerpt' => 'required|min:10',
        'content' => 'required|min:20',
        'category_id' => 'required|exists:categories,id',
        'status' => 'required|in:draft,published',
    ];

    // Open the form to CREATE a new post
    public function create()
    {
        $this->reset(['title', 'excerpt', 'content', 'category_id', 'status', 'editingPostId']);
        $this->showForm = true;
    }

    // Open the form to EDIT an existing post
    public function edit($postId)
    {
        $post = Post::findOrFail($postId);
        $this->editingPostId = $post->id;
        $this->title = $post->title;
        $this->excerpt = $post->excerpt;
        $this->content = $post->content;
        $this->category_id = $post->category_id;
        $this->status = $post->status;
        $this->showForm = true;
    }

    // SAVE — handles both create and update
    public function save(PostService $postService)
    {
        $data = $this->validate();

        if ($this->editingPostId) {
            // Update existing
            $post = Post::findOrFail($this->editingPostId);
            $postService->updatePost($post, $data);
            session()->flash('message', 'Post updated successfully!');
        } else {
            // Create new
            $postService->createPost($data);
            session()->flash('message', 'Post created successfully!');
        }

        $this->reset(['title', 'excerpt', 'content', 'category_id', 'status', 'editingPostId']);
        $this->showForm = false;
    }

    // DELETE a post
    public function delete($postId, PostService $postService)
    {
        $post = Post::findOrFail($postId);
        $postService->deletePost($post);
        session()->flash('message', 'Post deleted successfully!');
    }

    // Cancel the form
    public function cancel()
    {
        $this->reset(['title', 'excerpt', 'content', 'category_id', 'status', 'editingPostId']);
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.post-manager', [
            'posts' => Post::with('category')->latest()->get(),
            'categories' => Category::all(),
        ]);
    }
}
