<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Str;

class AddArticleController extends Controller
{
    public function index() {
        return view('addArticle', [
            'title' => 'Write Your Best Article Here', 
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request) {
        // $slug = str_replace(' ', '-', $request->title);

        // dd($slug);
        // dd($request->author_id);
        // return $request;

        $validatedArticle = $request->validate([
            'author_id' => 'required',
            'title' => 'required|min:3|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'body' => 'required|min:10',
        ]);

        $validatedArticle['body'] = Str::limit(strip_tags($request->body));

        Post::create($validatedArticle);

        $request->session()->flash('success', 'Registration was successful!');
        
        return redirect('/myarticle');
    }

    public function checkSlug(Request $request) {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
