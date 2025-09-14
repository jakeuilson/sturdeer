<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Restrict creating posts to verified and authenticated users ^w^
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [PostController::class, 'index'])
        ->name('dashboard');

    Route::get('/post/create', [PostController::class, 'create'])
        ->name('post.create');

    Route::post('/post', [PostController::class,'store'])
        ->name('post.store');

    // Post routes
    Route::get('/posts/{post}', [PostController::class, 'show'])
        ->name('posts.show');
    
    // Comment routes
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
        ->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])
        ->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])
        ->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
