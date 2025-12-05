@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">Healthy Lifestyle & Tips</h1>
        <p class="text-muted">Curated articles for a better student life.</p>
    </div>

    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/400x250?text=Health+Topic" class="card-img-top" alt="Article Image">
                    
                    <div class="card-body">
                        <span class="badge bg-success mb-2">{{ $article->category }}</span>
                        <h5 class="card-title fw-bold">{{ $article->title }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($article->content, 100) }}...
                        </p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-outline-primary w-100">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h3 class="text-muted">No articles found yet.</h3>
                <p>Check back later for updates!</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection