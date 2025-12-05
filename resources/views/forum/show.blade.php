@extends('layouts.app')

@section('content')
<a href="{{ route('forum.index') }}" class="btn btn-outline-secondary mb-3">&larr; Back to Forum</a>

<div class="card mb-4 border-primary">
    <div class="card-body">
        <h2 class="card-title">{{ $thread->title }}</h2>
        <h6 class="card-subtitle mb-3 text-muted">
            By {{ $thread->user->name }} • {{ $thread->created_at->format('d M Y') }}
        </h6>
        <p class="card-text lead" style="font-size: 1.1rem;">{{ $thread->body }}</p>
    </div>
</div>

<hr>

<h4>Replies ({{ $thread->replies->count() }})</h4>

@foreach($thread->replies as $reply)
    <div class="card mb-3 bg-light">
        <div class="card-body py-2">
            <div class="d-flex justify-content-between">
                <strong>{{ $reply->user->name }}</strong>
                <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
            </div>
            <p class="mb-0 mt-1">{{ $reply->body }}</p>
        </div>
    </div>
@endforeach

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Leave a Reply</h5>
        <form action="{{ route('forum.reply.store', $thread->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="body" class="form-control" rows="3" required placeholder="Type your supportive message here..."></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post Reply</button>
        </form>
    </div>
</div>
@endsection