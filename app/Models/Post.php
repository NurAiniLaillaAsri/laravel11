<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model {          // otomatis terhubung dengan tabel posts
    use HasFactory;
    protected $fillable = ['title', 'author', 'slug', 'body'];
    
}