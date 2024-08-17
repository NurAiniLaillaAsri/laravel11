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

    // dump(request('search'));

    // $post = Post::latest();

    // if (request('search')) {
    //     $post->where('title', 'like', '%' . request('search') . '%');
    // }

    return view('posts', [
        'title' => 'Blog',
        'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(15)->withQueryString(),
    ]);
});

Route::get('/posts/{post:slug}', function (Post $post) {        // Eloquent models, customizing the key
    $posts = Post::inRandomOrder()->take(8)->get();
    return view('post', ['title' => 'Single Post', 'post' => $post, 'posts' => $posts]);
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

Route::get('/login', function () {
    return view('login', ['title' => 'Login']);
});