<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'Lailla Asri']);
});

Route::get('/posts', function () {
    return view('posts', [
        'title' => 'Blog',
        'posts' => [
            [
                'id' => 1,
                'title' => 'Judul Artikel 1',
                'author' => 'Nur Aini',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid tenetur quia iste alias. Nam, dolore dolor minima nesciunt alias rerum quis a accusamus et. Quos blanditiis amet magnam tenetur nobis.'
            ],
            [
                'id' => 2,
                'title' => 'Judul Artikel 2',
                'author' => 'Lailla Asri',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid tenetur quia iste alias. Nam, dolore dolor minima nesciunt alias rerum quis a accusamus et. Quos blanditiis amet magnam tenetur nobis.'
            ],
        ]
    ]);
});

Route::get('/posts/{id}', function ($id) {
    $posts = [
        [
            'id' => 1,
            'title' => 'Judul Artikel 1',
            'author' => 'Nur Aini',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid tenetur quia iste alias. Nam, dolore dolor minima nesciunt alias rerum quis a accusamus et. Quos blanditiis amet magnam tenetur nobis.'
        ],
        [
            'id' => 2,
            'title' => 'Judul Artikel 2',
            'author' => 'Lailla Asri',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid tenetur quia iste alias. Nam, dolore dolor minima nesciunt alias rerum quis a accusamus et. Quos blanditiis amet magnam tenetur nobis.'
        ],
    ];

    $post = Arr::first($posts, function($post) use($id) {       // use($id) digunakan untuk memanggil id global agar bisa masuk
        return $post['id'] == $id;                              // menggunakan == karena apapun yang ada di url adalah string
    });

    // dd($post);

    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});