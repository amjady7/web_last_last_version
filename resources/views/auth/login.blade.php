@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <!-- Left side - Form -->
        <div class="col-lg-6">
            <div class="pe-lg-5">
                <h1 class="display-5 fw-bold mb-4">LOGIN FORM</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
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
                            name="password" placeholder="Enter your password" required>
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                            <label class="form-check-label" for="remember-me">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <!-- Forgot Password -->
                    <div class="mb-4">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">
                            Forgot password?
                        </a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg text-white">
                            LOGIN NOW
                        </button>
                    </div>
                </form>
                
                <div class="mt-4 text-center">
                    <p class="text-muted">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-decoration-none">
                            Sign up
                        </a>
                    </p>
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

