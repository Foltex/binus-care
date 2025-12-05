@extends('layouts.app')

@section('content')
<div class="p-5 mb-4 bg-light rounded-3 shadow-sm text-center" style="background: linear-gradient(135deg, #e0f7fa 0%, #ffffff 100%);">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-primary">Welcome to BinusCare</h1>
        <p class="col-md-8 fs-4 mx-auto text-muted">
            Your companion for mental and physical health at Binus. <br>
            Book sessions, join the community, and stay healthy.
        </p>
        @auth
            <a href="{{ route('booking.index') }}" class="btn btn-primary btn-lg px-4 gap-3">Book a Session</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3">Login to Start</a>
            <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">Register</a>
        @endauth
    </div>
</div>

<div class="row align-items-md-stretch">
    <div class="col-md-4 mb-4">
        <div class="h-100 p-4 text-white bg-success rounded-3 shadow-sm">
            <h2>🍎 Lifestyle</h2>
            <p>Read the latest tips on nutrition, sleep, and handling exam stress.</p>
            <a href="{{ route('articles.index') }}" class="btn btn-outline-light">Read Articles</a>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="h-100 p-4 bg-light border rounded-3 shadow-sm">
            <h2 class="text-primary">💬 Community</h2>
            <p>Feeling overwhelmed? You are not alone. Join the discussion.</p>
            <a href="{{ route('forum.index') }}" class="btn btn-outline-primary">Visit Forum</a>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="h-100 p-4 text-white bg-info rounded-3 shadow-sm" style="background-color: #0dcaf0;">
            <h2>🩺 Check-up</h2>
            <p>Schedule a meeting with a campus counselor or doctor.</p>
            @auth
                <a href="{{ route('booking.index') }}" class="btn btn-light text-dark">Book Now</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-light text-dark">Login First</a>
            @endauth
        </div>
    </div>
</div>

<div class="text-center mt-5 text-muted">
    <small>Binus Health Portal &copy; {{ date('Y') }}</small>
</div>
@endsection