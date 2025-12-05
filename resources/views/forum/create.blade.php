@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Create New Discussion</div>
            <div class="card-body">
                <form action="{{ route('forum.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="body" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Publish Thread</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection