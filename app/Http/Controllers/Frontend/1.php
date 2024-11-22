<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Show the form to create a new article
    public function create()
    {
        return view('articles.create');
    }

    public function details()
    {
        // echo "hello" die;
        return ".................hello...............";
        // $article = Article::getByUserId(1);
        // return view('frontend.user.article.getArticle', compact('article'));
    }

    // Store the article data in the database
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug',
            'content' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Optional image
            'meta_description' => 'required|string',
        ]);

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        // Create a new article
        Article::create([
            'title' => $request->title,
            'author' => $request->author,
            'slug' => $request->slug,
            'content' => $request->content,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $imageName ?? null, // Store the image name if uploaded
            'meta_description' => $request->metaDescription,
        ]);

        // Redirect to the articles list or show success message
        return redirect()->route('article.create')->with('success', 'Article created successfully!');
    }
}
