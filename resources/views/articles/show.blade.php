@extends('layouts.app')

@section('content')
<div class="container py-5">
    <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary mb-4">&larr; Back to Articles</a>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4 text-center">
                <span class="badge bg-success fs-6 mb-2">{{ $article->category }}</span>
                <h1 class="fw-bold display-5">{{ $article->title }}</h1>
                <p class="text-muted">
                    Published on {{ $article->created_at->format('d M Y') }}
                </p>
            </div>

            <img src="https://via.placeholder.com/800x400?text={{ urlencode($article->title) }}" class="img-fluid rounded shadow mb-5 w-100" alt="Cover Image">

            <div class="article-content fs-5 lh-lg text-dark">
                {!! nl2br(e($article->content)) !!}
            </div>
        </div>
    </div>
</div>
@endsection