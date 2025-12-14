@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">BinusCare 🩺</h2>
                <p class="text-muted">Welcome back! Please login to continue.</p>
            </div>

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    
                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-secondary small">EMAIL ADDRESS</label>
                            <input id="email" type="email" class="form-control form-control-lg bg-light border-0" 
                                   name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                            @error('email')
                                <span class="text-danger small mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold text-secondary small">PASSWORD</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control form-control-lg bg-light border-0" 
                                       name="password" required autocomplete="current-password">
                                <button class="btn btn-light border-0 text-secondary" type="button" onclick="toggleInput('password')">
                                    Show
                                </button>
                            </div>
                            @error('password')
                                <span class="text-danger small mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label text-muted small">Remember me</label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold shadow-sm">
                                Log in
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-muted small mb-0">Don't have an account?</p>
                            <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none">Create BinusCare Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleInput(id) {
        var input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>
@endsection