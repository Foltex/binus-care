@extends('layouts.app')

@section('content')
<div class="p-5 mb-5 bg-light rounded-4 shadow-sm text-center position-relative overflow-hidden" 
     style="background: linear-gradient(135deg, #e0f7fa 0%, #ffffff 100%);">
    
    <div class="container-fluid py-5">
        <h1 class="display-4 fw-bold text-primary mb-3">Welcome to BinusCare</h1>
        <p class="col-md-8 fs-5 mx-auto text-muted mb-4">
            Your companion for mental and physical health at Binus.<br>
            Book sessions, join the community, and stay healthy together.
        </p>

        <div class="d-flex justify-content-center gap-2">
            @auth
                @if(Auth::user()->isDoctor())
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('booking.index') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                        Book a Session
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 shadow-sm">Login to Start</a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">Register</a>
            @endauth
        </div>
    </div>
</div>

<div class="row align-items-stretch g-4">
    
    <div class="col-md-4">
        <div class="h-100 p-5 text-white bg-success rounded-4 shadow-sm position-relative overflow-hidden">
            <h2 class="fw-bold">🍎 Lifestyle</h2>
            <p class="opacity-75">Read the latest tips on nutrition, sleep, and handling exam stress.</p>
            <a href="{{ route('articles.index') }}" class="btn btn-light text-success fw-bold stretched-link mt-2">
                Read Articles
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="h-100 p-5 bg-white border rounded-4 shadow-sm">
            <h2 class="fw-bold text-primary">💬 Community</h2>
            <p class="text-muted">Feeling overwhelmed? You are not alone. Join the discussion.</p>
            <a href="{{ route('forum.index') }}" class="btn btn-outline-primary mt-2">
                Visit Forum
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="h-100 p-5 text-white bg-info rounded-4 shadow-sm" style="background-color: #0dcaf0;">
            <h2 class="fw-bold text-dark">🩺 Check-up</h2>
            <p class="text-dark opacity-75">Schedule a meeting with a campus counselor or doctor.</p>
            
            @auth
                @if(Auth::user()->isDoctor())
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-light text-dark fw-bold mt-2 shadow-sm">
                        View Requests
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-dark text-white fw-bold mt-2 shadow-sm">
                        Go to Dashboard
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-light text-dark fw-bold mt-2">
                    Login First
                </a>
            @endauth
        </div>
    </div>
</div>

<div class="text-center mt-5 text-muted py-3">
    <small>BinusCare Health Portal &copy; {{ date('Y') }}</small>
</div>
@endsection