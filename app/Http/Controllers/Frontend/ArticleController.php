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
}
