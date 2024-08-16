<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model {          // otomatis terhubung dengan tabel posts
    use HasFactory;
    protected $fillable = ['title', 'author', 'slug', 'body'];

    // Eager Loading by Default
    protected $with = ['author', 'category'];
    
    public function author():BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function category():BelongsTo {
        return $this->belongsTo(Category::class);
    }
}