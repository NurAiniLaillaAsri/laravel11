<?php 

namespace App\Models;

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
}