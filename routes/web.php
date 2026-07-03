<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}', [HomeController::class, 'show'])->name('posts.show');

Route::get('/admin/posts', function () {
    return view('admin.posts');
})->middleware(['auth'])->name('admin.posts');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
