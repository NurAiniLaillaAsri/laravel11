<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MyArticleController extends Controller
{
    public function index(Post $post) {
        $article = Post::where('author_id', auth()->user()->id)->latest()->get();
        return view('myarticle', ['title' => 'My Article', 'posts' => $article]);
    }
}
