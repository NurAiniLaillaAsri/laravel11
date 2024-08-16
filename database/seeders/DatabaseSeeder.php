<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $admin = User::create([
        //     'name' => 'Lailla Asri',
        //     'username' => 'laillaAsri',
        //     'email' => 'example@mail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'remember_token' => Str::random(10),
        // ]);

        // Post::factory(100)->recycle([
        //     Category::factory(3)->create(),
        //     User::factory(5)->create(),
        //     $admin
        // ])->create();

        $this->call([UserSeeder::class, CategorySeeder::class]);
        Post::factory(100)->recycle([
            Category::all(),
            User::all()
        ])->create();
    }
}
