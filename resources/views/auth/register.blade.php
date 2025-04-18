<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Register - {{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Custom CSS -->
        <style>
            :root {
                --primary-color: #F7941D;
                --secondary-color: #333333;
                --light-gray: #f8f9fa;
                --dark-gray: #6c757d;
            }

            body {
                font-family: 'Figtree', sans-serif;
                background-color: var(--light-gray);
            }

            .top-bar {
                background-color: var(--secondary-color);
                color: white;
                padding: 0.5rem 0;
                position: relative;
                z-index: 1000;
            }

            .navbar {
                background-color: white;
                padding: 1rem 0;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }

            .form-control {
                padding: 1rem;
            }
            .form-control:focus {
                box-shadow: none;
                background-color: #f8f9fa;
            }
            .form-control::placeholder {
                color: #6c757d;
                opacity: 0.8;
            }
            .btn-danger {
                background-color: #dc3545;
                border: none;
                padding: 1rem;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            .btn-danger:hover {
                background-color: #bb2d3b;
                transform: translateY(-1px);
            }
            .form-check-input:checked {
                background-color: #dc3545;
                border-color: #dc3545;
            }
            .form-label {
                font-weight: 500;
                margin-bottom: 0.5rem;
            }
            .alert {
                border-radius: 0.5rem;
            }
            .alert ul {
                padding-left: 1rem;
            }
            @media (max-width: 991.98px) {
                .pe-lg-5 {
                    padding-right: 0 !important;
                }
            }
        </style>
    </head>
    <body>
        <!-- Top Bar -->
        <div class="top-bar bg-dark text-white py-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        @if(isset($settings))
                            <span class="me-3"><i class="fas fa-envelope"></i> {{ $settings->email }}</span>
                            <span><i class="fas fa-phone"></i> {{ $settings->phone }}</span>
                        @endif
                    </div>
                    <div class="col-md-6 text-end">
                        @auth
                            <a href="{{ route('profile.edit') }}" class="text-white me-3">Profile</a>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link text-white p-0">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-white me-3">Login</a>
                            <a href="{{ route('register') }}" class="text-white">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <header class="main-header py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        @if(isset($settings) && $settings->site_logo)
                            <a href="{{ route('home') }}">
                                <img src="{{ Storage::url($settings->site_logo) }}" alt="{{ $settings->site_title }}" class="img-fluid" style="max-height: 60px;">
                            </a>
                        @else
                            <a href="{{ route('home') }}" class="text-decoration-none">
                                <h1 class="h3 mb-0">{{ isset($settings) ? $settings->site_title : config('app.name') }}</h1>
                            </a>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                                    </li>
                                    @auth
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('cart.*') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                                                <i class="fas fa-shopping-cart"></i> Cart
                                            </a>
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container py-5">
            <div class="row align-items-center">
                <!-- Left side - Form -->
                <div class="col-lg-6">
                    <div class="pe-lg-5">
                        <h1 class="display-5 fw-bold mb-4">REGISTRATION FORM</h1>
                        
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
                                <button type="submit" class="btn btn-danger btn-lg">
                                    REGISTER NOW
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right side - Image -->
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad" 
                        alt="Friends together" class="img-fluid rounded-3">
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        @if(isset($settings))
                            <h5>{{ $settings->site_title }}</h5>
                            <p class="mb-3">
                                <i class="fas fa-envelope me-2"></i> {{ $settings->email }}<br>
                                <i class="fas fa-phone me-2"></i> {{ $settings->phone }}
                            </p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}" class="text-white">Home</a></li>
                            <li><a href="{{ route('contact') }}" class="text-white">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Follow Us</h5>
                        <div class="social-links">
                            @if(isset($settings))
                                @if($settings->facebook_url)
                                    <a href="{{ $settings->facebook_url }}" class="text-white me-3" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                @endif
                                @if($settings->twitter_url)
                                    <a href="{{ $settings->twitter_url }}" class="text-white me-3" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                @endif
                                @if($settings->instagram_url)
                                    <a href="{{ $settings->instagram_url }}" class="text-white me-3" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                @endif
                                @if($settings->linkedin_url)
                                    <a href="{{ $settings->linkedin_url }}" class="text-white me-3" target="_blank">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                @endif
                                @if($settings->youtube_url)
                                    <a href="{{ $settings->youtube_url }}" class="text-white" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <p class="mb-0">&copy; {{ date('Y') }} {{ isset($settings) ? $settings->site_title : config('app.name') }}. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
