<?php

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'Lailla Asri']);
});

Route::get('/posts', function () {
    $post = Post::with(['author', 'category'])->latest()->get();        // Eager loading, mengurangi penggunaan query
    return view('posts', [
        'title' => 'Blog',
        'posts' => $post
    ]);
});

Route::get('/posts/{post:slug}', function (Post $post) {        // Eloquent models, customizing the key
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function (User $user) {  
    $post = $user->posts->load('category', 'author');           // Lazy eager loading, Sometimes you may need to eager load a relationship after the parent model has already been retrieved.

    return view('posts', ['title' => count($post) . ' Articles by ' . $user->name, 'posts' => $post]);
});

Route::get('/categories/{category:slug}', function (Category $category) {  
    $post = $category->posts->load('category', 'author');           // Lazy eager loading, Sometimes you may need to eager load a relationship after the parent model has already been retrieved.

    return view('posts', ['title' => 'Articles in ' . $category->name, 'posts' => $post]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});