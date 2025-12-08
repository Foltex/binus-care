@extends('layouts.app')

@section('content')
<div class="py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold text-primary">👋 Welcome Back, {{ Auth::user()->name }}!</h1>
            <p class="lead text-muted">A snapshot of your health and community activity.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">Waiting for Confirmation</h5>
                    <h1 class="display-4 fw-bold">{{ $pendingAppointments }}</h1>
                    <p class="card-text">
                        <a href="{{ route('booking.history') }}" class="text-warning text-decoration-none">View Details &rarr;</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <h5 class="card-title text-success">Confirmed Sessions</h5>
                    <h1 class="display-4 fw-bold">{{ $confirmedAppointments }}</h1>
                    <p class="card-text">
                        <a href="{{ route('booking.history') }}" class="text-success text-decoration-none">Book New Session &rarr;</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-info">
                <div class="card-body">
                    <h5 class="card-title text-info">Total Forum Threads</h5>
                    <h1 class="display-4 fw-bold">{{ $totalThreads }}</h1>
                    <p class="card-text">
                        <a href="{{ route('forum.index') }}" class="text-info text-decoration-none">Go to Forum &rarr;</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <hr>
    
    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Recent Community Posts</h3>
            <p class="text-muted">Your last 3 threads in the BeeWell forum.</p>
            
            @forelse($latestThreads as $thread)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('forum.show', $thread->id) }}" class="text-primary text-decoration-none">
                                {{ $thread->title }}
                            </a>
                        </h5>
                        <p class="card-text small text-muted">
                            Posted {{ $thread->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="alert alert-secondary">
                    You haven't started any threads yet. <a href="{{ route('forum.create') }}">Start your first discussion!</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection