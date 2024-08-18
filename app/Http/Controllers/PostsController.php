<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts', [
            'title' => 'Blog',
            'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(15)->withQueryString(),
        ]);
    }

    public function slug(Post $post)
    {
        $posts = Post::inRandomOrder()->take(8)->get();
        return view('post', ['title' => 'Single Post', 'post' => $post, 'posts' => $posts]);
    }
}
