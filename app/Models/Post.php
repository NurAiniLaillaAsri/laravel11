<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {          // otomatis terhubung dengan tabel posts
    protected $fillable = ['title', 'author', 'slug', 'body'];
    
}