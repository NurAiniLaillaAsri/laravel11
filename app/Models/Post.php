<?php 

namespace App\Models;
use Illuminate\Support\Arr;

class Post {
    public static function all() {
        return [
            [
                'id' => 1,
                'slug' => 'judul-artikel-1',
                'title' => 'Judul Artikel 1',
                'author' => 'Nur Aini',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid tenetur quia iste alias. Nam, dolore dolor minima nesciunt alias rerum quis a accusamus et. Quos blanditiis amet magnam tenetur nobis.'
            ],
            [
                'id' => 2,
                'slug' => 'judul-artikel-2',
                'title' => 'Judul Artikel 2',
                'author' => 'Lailla Asri',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid tenetur quia iste alias. Nam, dolore dolor minima nesciunt alias rerum quis a accusamus et. Quos blanditiis amet magnam tenetur nobis.'
            ],
        ];
    }

    public static function find($slug): array {
        // callback
        // return Arr::first(static::all(), function($post) use($slug) {       // use($id) digunakan untuk memanggil id global agar bisa masuk, static untuk memanggil function di class yang sama
        //     return $post['slug'] == $slug;                              // menggunakan == karena apapun yang ada di url adalah string
        // });

        // arrow function
        $post = Arr::first(static::all(), fn($post) => $post['slug'] == $slug);

        if (!$post) {
            abort(404);
        }

        return $post;
    }
}