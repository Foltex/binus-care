<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(9);
        return view('articles.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        if (!Auth::user()->isDoctor()) { abort(403); }
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isDoctor()) { abort(403); }

        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:articles,title',
            'category' => 'required|string|max:50',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('article-images', 'public');
        }

        $validated['user_id'] = Auth::id();

        Article::create($validated);

        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    public function edit(Article $article)
    {
        if (!Auth::user()->isDoctor()) { abort(403); }
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        if (!Auth::user()->isDoctor()) { abort(403); }

        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:articles,title,' . $article->id,
            'category' => 'required|string|max:50',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($article->image_path) {
                Storage::disk('public')->delete($article->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('article-images', 'public');
        }

        $article->update($validated);

        return redirect()->route('articles.show', $article->slug)->with('success', 'Article updated successfully!');
    }

    public function destroy(Article $article)
    {
        if (!Auth::user()->isDoctor()) { abort(403); }

        if ($article->image_path) {
            Storage::disk('public')->delete($article->image_path);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }
}