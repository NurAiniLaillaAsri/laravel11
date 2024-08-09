<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

// class Post {
//     public static function all() {
//         return [
//             [
//                 'id' => 1,
//                 'slug' => 'judul-artikel-1',
//                 'title' => 'Judul Artikel 1',
//                 'author' => 'Nur Aini',
//                 'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid tenetur quia iste alias. Nam, dolore dolor minima nesciunt alias rerum quis a accusamus et. Quos blanditiis amet magnam tenetur nobis.'
//             ],
//             [
//                 'id' => 2,
//                 'slug' => 'judul-artikel-2',
//                 'title' => 'Judul Artikel 2',
//                 'author' => 'Lailla Asri',
//                 'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid tenetur quia iste alias. Nam, dolore dolor minima nesciunt alias rerum quis a accusamus et. Quos blanditiis amet magnam tenetur nobis.'
//             ],
//         ];
//     }
// }

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'Lailla Asri']);
});

Route::get('/posts', function () {
    return view('posts', [
        'title' => 'Blog',
        'posts' => Post::all()
    ]);
});

Route::get('/posts/{slug}', function ($slug) {
    $post = Arr::first(Post::all(), function($post) use($slug) {       // use($id) digunakan untuk memanggil id global agar bisa masuk
        return $post['slug'] == $slug;                              // menggunakan == karena apapun yang ada di url adalah string
    });

    // dd($post);

    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});