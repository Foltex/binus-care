<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // READ (Public)
    public function index()
    {
        $articles = Article::latest()->paginate(9);
        return view('articles.index', compact('articles'));
    }

    // READ (Public)
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }

    // CREATE (Admin Only)
    public function create()
    {
        if (!Auth::user()->isDoctor()) { abort(403); }
        return view('admin.articles.create');
    }

    // STORE (Admin Only)
    public function store(Request $request)
    {
        if (!Auth::user()->isDoctor()) { abort(403); }

        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:articles,title',
            'category' => 'required|string|max:50',
            'content' => 'required|string',
        ]);

        Article::create($validated);

        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    // EDIT (Admin Only)
    public function edit(Article $article)
    {
        if (!Auth::user()->isDoctor()) { abort(403); }
        return view('admin.articles.edit', compact('article'));
    }

    // UPDATE (Admin Only)
    public function update(Request $request, Article $article)
    {
        if (!Auth::user()->isDoctor()) { abort(403); }

        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:articles,title,' . $article->id,
            'category' => 'required|string|max:50',
            'content' => 'required|string',
        ]);

        $article->update($validated);

        return redirect()->route('articles.show', $article->slug)->with('success', 'Article updated successfully!');
    }

    // DELETE (Admin Only)
    public function destroy(Article $article)
    {
        if (!Auth::user()->isDoctor()) { abort(403); }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }
}