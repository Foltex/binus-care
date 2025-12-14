@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Join BinusCare</h2>
                <p class="text-muted">Start your health journey with us today.</p>
            </div>

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold text-secondary small">FULL NAME</label>
                            <input id="name" type="text" class="form-control form-control-lg bg-light border-0" 
                                   name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                            @error('name')
                                <span class="text-danger small mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold text-secondary small">EMAIL ADDRESS</label>
                            <input id="email" type="email" class="form-control form-control-lg bg-light border-0" 
                                   name="email" value="{{ old('email') }}" required autocomplete="username">
                            @error('email')
                                <span class="text-danger small mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold text-secondary small">PASSWORD</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control form-control-lg bg-light border-0" 
                                       name="password" required autocomplete="new-password">
                                <button class="btn btn-light border-0 text-secondary" type="button" onclick="toggleInput('password')">
                                    Show
                                </button>
                            </div>
                            @error('password')
                                <span class="text-danger small mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold text-secondary small">CONFIRM PASSWORD</label>
                            <div class="input-group">
                                <input id="password_confirmation" type="password" class="form-control form-control-lg bg-light border-0" 
                                       name="password_confirmation" required autocomplete="new-password">
                                <button class="btn btn-light border-0 text-secondary" type="button" onclick="toggleInput('password_confirmation')">
                                    Show
                                </button>
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger small mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold shadow-sm">
                                Register
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-muted small mb-0">Already registered?</p>
                            <a href="{{ route('login') }}" class="fw-bold text-primary text-decoration-none">Login here</a>
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