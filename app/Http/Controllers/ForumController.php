<?php

namespace App\Http\Controllers;

use App\Models\ForumThread;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a list of all forum threads.
     */
    public function index()
    {
        // Get threads, ordered by newest first. 
        // 'with' is used to preload the User to avoid N+1 query performance issues.
        $threads = ForumThread::with('user')->latest()->paginate(10);

        return view('forum.index', compact('threads'));
    }

    /**
     * Show the form for creating a new thread.
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created thread in the database.
     */
    public function store(Request $request)
    {
        // 1. Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // 2. Create the thread linked to the current user
        ForumThread::create([
            'user_id' => Auth::id(), // Gets the ID of the currently logged-in student
            'title' => $request->title,
            'body' => $request->body,
        ]);

        // 3. Redirect back to the forum list with a success message
        return redirect()->route('forum.index')->with('success', 'Thread created successfully!');
    }

    /**
     * Display the specified thread and its replies.
     */
    public function show($id)
    {
        // Find the thread by ID or fail (404) if not found.
        // We load: 
        // 1. The 'user' who created the thread.
        // 2. The 'replies' to this thread.
        // 3. The 'replies.user' (the authors of the replies).
        $thread = ForumThread::with(['user', 'replies.user'])->findOrFail($id);

        return view('forum.show', compact('thread'));
    }

    /**
     * Store a new reply to a specific thread.
     */
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