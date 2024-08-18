<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AddArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyArticleController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterController;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Route::get('/posts', [PostsController::class, 'index'])->middleware('auth');
Route::get('/posts/{post:slug}', [PostsController::class, 'slug'])->middleware('auth');

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

Route::get('/about', [AboutController::class, 'index'])->middleware('auth');

Route::get('/contact', [ContactController::class, 'index'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/myarticle', [MyArticleController::class, 'index'])->name('myarticle');

Route::get('/addArticle', [AddArticleController::class, 'index'])->name('addArticle');
Route::post('/addArticle', [AddArticleController::class, 'store']);
Route::get('/addArticle/checkSlug', [AddArticleController::class, 'checkSlug']);