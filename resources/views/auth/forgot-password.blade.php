@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <!-- Left side - Form -->
        <div class="col-lg-6">
            <div class="pe-lg-5">
                <h1 class="display-5 fw-bold mb-4">RESET PASSWORD</h1>
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control form-control-lg bg-light border-0" 
                            name="email" value="{{ old('email') }}" 
                            placeholder="Enter your email" required autofocus>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg text-white">
                            <i class="fas fa-paper-plane me-2"></i> Send Reset Link
                        </button>
                    </div>
                </form>
                
                <div class="mt-4 text-center">
                    <p class="text-muted">
                        Remember your password?
                        <a href="{{ route('login') }}" class="text-decoration-none text-warning">
                            Back to login
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
