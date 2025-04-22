@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <!-- Left side - Form -->
        <div class="col-lg-6">
            <div class="pe-lg-5">
                <h1 class="display-5 fw-bold mb-4">RESET PASSWORD</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <input type="hidden" name="email" value="{{ $request->email }}">

                    <div class="mb-4">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control form-control-lg bg-light border-0" 
                            name="password" required autocomplete="new-password">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control form-control-lg bg-light border-0" 
                            name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg text-white">
                            <i class="fas fa-save me-2"></i> Reset Password
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
