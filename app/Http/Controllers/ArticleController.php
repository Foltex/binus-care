<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // Get articles, newest first, 9 per page
        $articles = Article::latest()->paginate(9);
        
        return view('articles.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        
        return view('articles.show', compact('article'));
    }
}