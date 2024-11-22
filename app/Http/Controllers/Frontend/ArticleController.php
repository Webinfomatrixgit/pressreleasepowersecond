<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function details()
    {
        $article = Article::getByUserId(auth()->user()->id);
        // dd($article);
        return view('frontend.user.article.getArticle', compact('article'));
    }

    public function addArticle()
    {
        return view('frontend.user.article.addArticle');
    }

    public function addArticleF(Request $request)
    {
        // Validate the incoming request data
        $validate = $request->validate([
            'category' => 'required|integer',                  // Ensure category is an integer
            'title' => 'required|string|max:255',               // Title is required and should be a string with max length 255
            'meta_title' => 'nullable|string|max:255',          // Meta title is optional
            'description' => 'nullable|string',                 // Description is optional
            'meta_description' => 'nullable|string',            // Meta description is optional
            'meta_keywords' => 'nullable|string',               // Meta keywords are optional
            'content' => 'required|string',                     // Content is required for the article
        ]);
    
        // Create a new article instance
        $article = new Article();
        
        // Set the article's properties from the validated request data
        $article->user_id = auth()->id();
        $article->category_id = (int) $validate['category'];        // Ensure category is cast to integer
        $article->title = $validate['title'];                    // Save the title
        $article->meta_title = $validate['meta_title'];          // Save the meta_title (optional)
        $article->description = $validate['description'];        // Save the description (optional)
        $article->meta_description = $validate['meta_description']; // Save the meta_description (optional)
        $article->meta_keywords = $validate['meta_keywords'];    // Save meta_keywords (optional)
        $article->content = $validate['content'];                // Save the content of the article
        
        // Optionally, you may want to set the user_id for the article
        // $article->user_id = auth()->user()->id; // Uncomment this line if you need to save the user_id
    
        try {
            // Attempt to save the article to the database
            $article->save();
    
            // Notify user of success
            notifyEvs('success', 'Article created successfully.');
    
            // Redirect back with success message
            return redirect()->back()->with('success', 'Article created successfully!');
        } catch (\Exception $e) {
            // Handle errors during saving, you can log the error message if needed
            notifyEvs('error', 'An error occurred while creating the article.');
    
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while creating the article. Please try again.');
        }
    }
    

}
