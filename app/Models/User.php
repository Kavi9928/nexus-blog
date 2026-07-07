<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'title',
        'bio',
        'avatar',
        'twitter',
        'linkedin',
        'website',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if (blank($user->username)) {
                $user->username = static::makeUsername($user->name ?: 'author');
            }
        });
    }

    // POST
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Resolved public URL for the avatar (falls back to a generated initials image).
     */
    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->avatar
                ? Storage::disk('public')->url($this->avatar)
                : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=0f1115&color=fff&size=200',
        );
    }

    public function getRouteKeyName(): string
    {
        return 'username';
    }

    public static function makeUsername(string $name): string
    {
        $base = Str::slug($name) ?: 'author';
        $username = $base;
        $i = 1;

        while (static::where('username', $username)->exists()) {
            $username = $base . '-' . (++$i);
        }

        return $username;
    }
}
