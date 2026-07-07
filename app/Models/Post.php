<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug',
        'excerpt', 'content', 'featured_image',
        'status', 'views', 'reading_time', 'published_at',
    ];

    protected $casts = ['published_at' => 'datetime'];

    protected static function booted(): void
    {
        static::saving(function (Post $post) {
            // Auto-slug from title (kept unique), and estimate reading time from content.
            if ($post->isDirty('title') || blank($post->slug)) {
                $post->slug = static::uniqueSlug($post->title, $post->id);
            }
            if ($post->isDirty('content')) {
                $post->reading_time = max(1, (int) ceil(str_word_count(strip_tags((string) $post->content)) / 200));
            }
            // Stamp publish time the first moment a post goes live.
            if ($post->status === 'published' && blank($post->published_at)) {
                $post->published_at = now();
            }
        });
    }

    protected static function uniqueSlug(string $title, $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'post';
        $slug = $base;
        $i = 1;

        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . (++$i);
        }

        return $slug;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeTrending($query)
    {
        return $query->orderBy('views', 'desc');
    }
}