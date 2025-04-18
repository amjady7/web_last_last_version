@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="container py-5">
    <div class="row align-items-center">
        <!-- Left side - Form -->
        <div class="col-lg-6">
            <div class="pe-lg-5">
                <h1 class="display-5 fw-bold mb-4">REGISTER FORM</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control form-control-lg bg-light border-0" 
                            name="name" value="{{ old('name') }}" 
                            placeholder="Enter your full name" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control form-control-lg bg-light border-0" 
                            name="email" value="{{ old('email') }}" 
                            placeholder="Enter your email" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control form-control-lg bg-light border-0" 
                            name="password" placeholder="Create a password" required>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control form-control-lg bg-light border-0" 
                            name="password_confirmation" placeholder="Confirm your password" required>
                    </div>

                    <!-- Terms -->
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                I accept the Terms of Use & Privacy Policy
                            </label>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg text-white">
                            REGISTER NOW
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="position-relative my-4">
                    <hr class="text-muted">
                    <span class="position-absolute top-50 start-50 translate-middle px-3 bg-white text-muted">
                        OR
                    </span>
                </div>

                <!-- Social Login -->
                <div class="d-grid gap-2">
                    <a href="{{ route('login.google') }}" class="btn btn-outline-dark btn-lg">
                        <i class="fab fa-google me-2"></i> Continue with Google
                    </a>
                </div>
            </div>
        </div>

        <!-- Right side - Image -->
        <div class="col-lg-6 d-none d-lg-block">
            <img src="{{ asset('storage/thumbs/main_fashion-website-design-cover.webp') }}" 
                alt="Fashion Website Design" class="img-fluid rounded-3">
        </div>
    </div>
</div>
@endsection
