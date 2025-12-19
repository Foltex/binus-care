@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-danger text-white">✏️ Edit Article: {{ $article->title }}</div>
            <div class="card-body">
                <form action="{{ route('admin.articles.update', $article->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $article->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                            @php $selected = old('category', $article->category); @endphp
                            <option value="Mental Health" @selected($selected == 'Mental Health')>Mental Health</option>
                            <option value="Nutrition" @selected($selected == 'Nutrition')>Nutrition</option>
                            <option value="Medical" @selected($selected == 'Medical')>Medical</option>
                            <option value="Sleep" @selected($selected == 'Sleep')>Sleep</option>
                        </select>
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="10" required>{{ old('content', $article->content) }}</textarea>
                        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-danger">Update Article</button>
                    <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection