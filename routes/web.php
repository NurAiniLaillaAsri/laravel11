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
    // Eager loading, mengurangi penggunaan query
    // $post = Post::with(['author', 'category'])->latest()->get();        
    // return view('posts', [
    //     'title' => 'Blog',
    //     'posts' => $post
    // ]);

    $post = Post::latest()->get();
    return view('posts', [
        'title' => 'Blog',
        'posts' => $post,
    ]);
});

Route::get('/posts/{post:slug}', function (Post $post) {        // Eloquent models, customizing the key
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function (User $user) {  
    // Lazy eager loading, Sometimes you may need to eager load a relationship after the parent model has already been retrieved.
    // $post = $user->posts->load('category', 'author');           

    // return view('posts', ['title' => count($post) . ' Articles by ' . $user->name, 'posts' => $post]);

    return view('posts', ['title' => count($user->posts) . ' Articles by ' . $user->name, 'posts' => $user->posts]);
});

Route::get('/categories/{category:slug}', function (Category $category) {  
    // Lazy eager loading, Sometimes you may need to eager load a relationship after the parent model has already been retrieved.
    // $post = $category->posts->load('category', 'author');           

    // return view('posts', ['title' => 'Articles in ' . $category->name, 'posts' => $post]);

    return view('posts', ['title' => 'Articles in ' . $category->name, 'posts' => $category->posts]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});