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
        $validatedArticle = $request->validate([
            'author_id' => 'required',
            'title' => 'required|min:3|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'body' => 'required|min:10',
        ]);

        $validatedArticle['body'] = Str::limit(strip_tags($request->body));

        Post::create($validatedArticle);

        $request->session()->flash('success', 'Publish article was successful!');
        
        return redirect('/myarticle');
    }

    public function checkSlug(Request $request) {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function destroy(Post $post) {
        Post::destroy($post->id);
        
        return redirect('/myarticle')->with('success', 'The Article has been deleted');
    }

    public function edit(Post $post) {
        // dd($post->id);
        return view('editArticle', [
            'title' => 'Edit Article', 
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Post $post) {
        $rules = [
            'author_id' => 'required',
            'title' => 'required|min:3|max:255',
            'category_id' => 'required',
            'body' => 'required|min:10',
        ];

        if($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        };

        $validatedArticle = $request->validate($rules);

        $validatedArticle['body'] = Str::limit(strip_tags($request->body));

        Post::where('id', $post->id)->update($validatedArticle);
        
        return redirect('/myarticle')->with('success', 'Update was successful!');
    }
}

