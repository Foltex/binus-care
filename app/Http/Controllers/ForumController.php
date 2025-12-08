<?php

namespace App\Http\Controllers;

use App\Models\ForumThread;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $threads = ForumThread::with('user')->latest()->paginate(10);

        return view('forum.index', compact('threads'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        // 1. Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // 2. Create the thread linked to the current user
        ForumThread::create([
            'user_id' => Auth::id(), 
            'title' => $request->title,
            'body' => $request->body,
        ]);

        // 3. Redirect back to the forum list with a success message
        return redirect()->route('forum.index')->with('success', 'Thread created successfully!');
    }

    public function show($id)
    {
        $thread = ForumThread::with(['user', 'replies.user'])->findOrFail($id);

        return view('forum.show', compact('thread'));
    }


    public function storeReply(Request $request, $id)
    {
        // 1. Validate the reply body
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // 2. Find the thread just to make sure it exists
        $thread = ForumThread::findOrFail($id);

        // 3. Create the reply
        ForumReply::create([
            'forum_thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        // 4. Redirect back to the specific thread page
        return redirect()->route('forum.show', $thread->id)->with('success', 'Reply posted!');
    }
}