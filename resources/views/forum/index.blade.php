@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Community Forum</h1>
    <a href="{{ route('forum.create') }}" class="btn btn-primary">Start New Thread</a>
</div>

<div class="row">
    @foreach($threads as $thread)
        <div class="col-12 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('forum.show', $thread->id) }}" class="text-decoration-none text-dark">
                            {{ $thread->title }}
                        </a>
                    </h5>
                    <p class="card-text text-muted small">
                        Posted by <strong>{{ $thread->user->name }}</strong> • {{ $thread->created_at->diffForHumans() }}
                    </p>
                    <p class="card-text">{{ Str::limit($thread->body, 150) }}</p>
                    <a href="{{ route('forum.show', $thread->id) }}" class="btn btn-sm btn-outline-primary">Read & Reply</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {{ $threads->links() }}
</div>
@endsection