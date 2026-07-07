<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPostsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin/posts')->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_admin_posts_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/posts');

        $response->assertOk();
        $response->assertSeeLivewire(\App\Livewire\PostManager::class);
    }
}
