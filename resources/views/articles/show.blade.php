@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary mb-4">
                &larr; Back to Articles
            </a>

            <article class="card shadow-sm border-0">
                @if($article->image_path && str_starts_with($article->image_path, 'http'))
                    <img src="{{ $article->image_path }}" 
                         class="card-img-top" 
                         alt="{{ $article->title }}"
                         style="width: 100%; max-height: 500px; object-fit: cover;">
                @elseif($article->image_path)
                    <img src="{{ asset('storage/' . $article->image_path) }}" 
                         class="card-img-top" 
                         alt="{{ $article->title }}"
                         style="width: 100%; max-height: 500px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/800x400?text=No+Image" 
                         class="card-img-top" 
                         alt="No Image"
                         style="width: 100%; max-height: 500px; object-fit: cover;">
                @endif

                <div class="card-body p-4">
                    <div class="mb-3">
                        <span class="badge bg-success">{{ $article->category }}</span>
                        <span class="text-muted ms-2 small">{{ $article->created_at->format('d M Y') }}</span>
                    </div>

                    <h1 class="fw-bold mb-4">{{ $article->title }}</h1>

                    <div class="article-content lh-lg">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>

                @auth
                    @if(Auth::user()->isDoctor())
                        <div class="card-footer bg-white border-top-0 p-4">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-warning">
                                    Edit Article
                                </a>
                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endauth

            </article>
        </div>
    </div>
</div>
@endsection