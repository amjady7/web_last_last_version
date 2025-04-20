@php
use App\Facades\Cart;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

        <!-- Custom CSS -->
        <style>
            :root {
                --primary-color: #F7941D;
                --secondary-color: #000000;
                --light-gray: #2d2d2d;
                --dark-gray: #6c757d;
                --text-color: #ffffff;
                --card-bg: #333333;
                --border-color: #404040;
            }

            .top-bar {
                background-color: var(--secondary-color);
                color: var(--text-color);
                padding: 0.5rem 0;
            }

            .top-bar a {
                color: var(--text-color);
                text-decoration: none;
            }

            .top-bar a:hover {
                color: var(--primary-color);
            }

            .navbar {
                background-color: #ffffff !important;
                padding: 1rem 0;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .navbar-brand img {
                height: 25px;
                width: 25px;
                max-width: 25px;
                object-fit: contain;
                transition: all 0.3s ease;
            }

            .nav-link {
                color: var(--secondary-color) !important;
                font-weight: 500;
                padding: 0.5rem 1rem !important;
            }

            .nav-link:hover {
                color: var(--primary-color) !important;
            }

            .nav-link.active {
                color: var(--primary-color) !important;
                font-weight: 600;
            }

            .cart-badge {
                background-color: var(--secondary-color);
                color: var(--text-color);
                border-radius: 50%;
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
                position: absolute;
                top: -5px;
                right: -5px;
            }

            .nav-logo {
                height: 25px;
                width: auto;
                max-width: 100px;
                object-fit: contain;
                transition: all 0.3s ease;
            }

            /* Responsive Styles */
            @media (max-width: 768px) {
                .top-bar {
                    padding: 0.5rem 0;
                }

                .top-bar .container {
                    padding: 0 1rem;
                }

                .top-bar-contact {
                    margin-bottom: 0.5rem;
                }

                .top-bar-auth {
                    justify-content: flex-start !important;
                }

                .navbar {
                    padding: 0.5rem 0;
                }

                .navbar-brand img {
                    height: 20px;
                    max-width: 80px;
                }

                .navbar-collapse {
                    background-color: var(--primary-color);
                    padding: 1rem;
                    margin-top: 0.5rem;
                    border-radius: 0.25rem;
                }

                .nav-link {
                    padding: 0.5rem 0 !important;
                }

                .navbar-toggler {
                    border-color: var(--text-color);
                }

                .navbar-toggler-icon {
                    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
                }

                .nav-logo {
                    height: 20px;
                    max-width: 80px;
                }
            }
        </style>

        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 top-bar-contact">
                            <div class="d-flex flex-wrap gap-4">
                                @if(isset($settings))
                                    <span><i class="fas fa-envelope me-2"></i> {{ $settings->email }}</span>
                                    <span><i class="fas fa-phone me-2"></i> {{ $settings->phone }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 top-bar-auth">
                            <div class="d-flex flex-wrap justify-content-end gap-3">
                                @auth
                                    @if(auth()->user()->is_admin)
                                        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
                                    @endif
                                    <a href="{{ route('profile.edit') }}"><i class="fas fa-user me-1"></i> Profile</a>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                                        </a>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
                                    <a href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i> Register</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="nav-brand" href="{{ route('home') }}">
                        @if(isset($settings) && $settings->site_logo)
                            <img src="{{ Storage::url($settings->site_logo) }}" alt="{{ $settings->site_title }}" class="nav-logo">
                        @else
                            <h1 class="nav-title">{{ isset($settings) ? $settings->site_title : config('app.name') }}</h1>
                        @endif
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
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
                                <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="cart-badge">{{ Cart::count() }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            <!-- Toast Container -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="cartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Cart Update</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Item added to cart successfully!
                    </div>
                </div>
            </div>

            @include('layouts.partials.footer')
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Owl Carousel JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        @stack('scripts')
    </body>
</html>
