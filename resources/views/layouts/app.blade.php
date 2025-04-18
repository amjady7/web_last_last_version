@php
use App\Facades\Cart;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite('resources/css/app.css')

        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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

            .text-orange-400 {
                color: var(--primary-color) !important;
            }

            .bg-orange-400 {
                background-color: var(--primary-color) !important;
            }

            .bg-orange-50 {
                background-color: #FFF8F0 !important;
            }

            .hover\:bg-orange-500:hover {
                background-color: var(--secondary-color) !important;
            }

            body {
                font-family: 'Figtree', sans-serif;
                margin: 0;
                padding: 0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            /* Navigation Styles */
            .main-nav {
                background: #fff;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                position: relative;
                z-index: 1000;
                height: 70px;
            }

            .nav-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 1rem;
                height: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .nav-brand {
                text-decoration: none;
                color: #333;
                display: flex;
                align-items: center;
            }

            .nav-logo {
                max-height: 60px;
                width: auto;
            }

            .nav-title {
                margin: 0;
                font-size: 1.5rem;
            }

            .menu-toggle {
                display: none;
                background: none;
                border: none;
                cursor: pointer;
                padding: 0.5rem;
            }

            .menu-icon {
                display: block;
                width: 25px;
                height: 2px;
                background: #333;
                position: relative;
                transition: background 0.3s;
            }

            .menu-icon::before,
            .menu-icon::after {
                content: '';
                position: absolute;
                width: 100%;
                height: 100%;
                background: #333;
                transition: transform 0.3s;
            }

            .menu-icon::before {
                transform: translateY(-8px);
            }

            .menu-icon::after {
                transform: translateY(8px);
            }

            .menu-toggle.active .menu-icon {
                background: transparent;
            }

            .menu-toggle.active .menu-icon::before {
                transform: rotate(45deg);
            }

            .menu-toggle.active .menu-icon::after {
                transform: rotate(-45deg);
            }

            .nav-menu {
                display: flex;
                align-items: center;
            }

            .nav-list {
                list-style: none;
                margin: 0;
                padding: 0;
                display: flex;
                gap: 2rem;
            }

            .nav-link {
                text-decoration: none;
                color: #333;
                font-weight: 500;
                transition: color 0.3s;
            }

            .nav-link:hover,
            .nav-link.active {
                color: var(--primary-color);
            }

            .cart-badge {
                background: var(--primary-color);
                color: white;
                padding: 0.2rem 0.5rem;
                border-radius: 50%;
                font-size: 0.8rem;
                margin-left: 0.5rem;
            }

            /* Main Content */
            .main-content {
                position: relative;
                z-index: 1;
                width: 100%;
                background: var(--light-gray);
                min-height: calc(100vh - 110px);
            }

            /* Top Bar Styles */
            .top-bar {
                background-color: var(--secondary-color);
                color: white;
                padding: 0.5rem 0;
                position: relative;
                z-index: 1001;
                height: auto;
                min-height: 40px;
            }

            .top-bar-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 1rem;
                height: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .top-bar-contact {
                display: flex;
                gap: 1.5rem;
                align-items: center;
            }

            .top-bar-contact span {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 0.9rem;
            }

            .top-bar-contact i {
                color: var(--primary-color);
            }

            .top-bar-auth {
                display: flex;
                gap: 1rem;
                align-items: center;
            }

            .top-bar-btn {
                padding: 0.25rem 1rem;
                border-radius: 20px;
                text-decoration: none;
                font-size: 0.9rem;
                transition: all 0.3s;
            }

            .top-bar-btn-outline {
                border: 1px solid white;
                color: white;
            }

            .top-bar-btn-outline:hover {
                background: white;
                color: var(--secondary-color);
            }

            .top-bar-btn-primary {
                background: var(--primary-color);
                color: white;
            }

            .top-bar-btn-primary:hover {
                background: #e67e00;
            }

            /* Mobile Styles */
            @media (max-width: 768px) {
                .top-bar-container {
                    flex-direction: column;
                    gap: 0.5rem;
                    padding: 0.5rem 1rem;
                }

                .top-bar-contact {
                    flex-direction: column;
                    gap: 0.5rem;
                    width: 100%;
                    text-align: center;
                }

                .top-bar-contact span {
                    justify-content: center;
                }

                .top-bar-auth {
                    width: 100%;
                    justify-content: center;
                    gap: 0.5rem;
                }

                .top-bar-btn {
                    padding: 0.5rem 1rem;
                    font-size: 0.8rem;
                }

                .main-nav {
                    height: 60px;
                }

                .nav-container {
                    padding: 0 1rem;
                    height: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }

                .menu-toggle {
                    display: block;
                    order: 2;
                }

                .nav-brand {
                    order: 1;
                }

                .nav-menu {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    background: white;
                    padding: 1rem;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    display: none;
                }

                .nav-menu.active {
                    display: block;
                }

                .nav-list {
                    flex-direction: column;
                    gap: 1rem;
                }

                .nav-item {
                    width: 100%;
                }

                .nav-link {
                    display: block;
                    padding: 0.5rem 0;
                }
            }

            /* Additional mobile adjustments for very small screens */
            @media (max-width: 480px) {
                .top-bar-btn {
                    padding: 0.4rem 0.8rem;
                    font-size: 0.75rem;
                }

                .top-bar-contact span {
                    font-size: 0.8rem;
                }

                .nav-container {
                    padding: 0 0.5rem;
                }

                .main-nav {
                    height: 50px;
                }
            }

            /* Toast Notification */
            .toast-header {
                background-color: var(--primary-color) !important;
                color: white !important;
            }

            .btn-warning {
                background-color: var(--primary-color) !important;
                border-color: var(--primary-color) !important;
                color: white !important;
            }

            .btn-warning:hover {
                background-color: var(--dark-gray) !important;
                border-color: var(--dark-gray) !important;
                color: white !important;
            }

            .btn-outline-warning {
                color: var(--primary-color) !important;
                border-color: var(--primary-color) !important;
            }

            .btn-outline-warning:hover {
                background-color: var(--primary-color) !important;
                color: white !important;
            }
        </style>

        @stack('styles')
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="top-bar-container">
                    <div class="top-bar-contact">
                        @if(isset($settings))
                            <span><i class="fas fa-envelope"></i> {{ $settings->email }}</span>
                            <span><i class="fas fa-phone"></i> {{ $settings->phone }}</span>
                        @endif
                    </div>
                    <div class="top-bar-auth">
                        @guest
                            <a href="{{ route('login') }}" class="top-bar-btn top-bar-btn-outline">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                            <a href="{{ route('register') }}" class="top-bar-btn top-bar-btn-primary">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        @else
                            <div class="user-dropdown">
                                <button class="top-bar-btn top-bar-btn-outline dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    @php
                                        $isAdmin = Auth::user()->isAdmin();
                                        $isAdminValue = Auth::user()->is_admin;
                                    @endphp
                                    <!-- Debug info - remove after fixing -->
                                    <li><hr class="dropdown-divider"></li>
                                    @if($isAdmin)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                        </a>
                                    </li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ $isAdmin ? route('admin.orders.index') : route('client.orders.index') }}"><i class="fas fa-shopping-bag me-2"></i> Orders</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>

           <!-- Navigation -->
           <nav class="main-nav">
    <div class="nav-container">
        <!-- Logo/Brand -->
        <a class="nav-brand" href="{{ route('home') }}">
            @if(isset($settings) && $settings->site_logo)
                <img src="{{ Storage::url($settings->site_logo) }}" alt="{{ $settings->site_title }}" class="nav-logo">
            @else
                <h1 class="nav-title">{{ isset($settings) ? $settings->site_title : config('app.name') }}</h1>
            @endif
        </a>

        <!-- Mobile Menu Toggle -->
        <button class="menu-toggle" aria-label="Toggle Menu">
            <span class="menu-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="nav-menu">
            <ul class="nav-list">
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
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart.*') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count" data-cart-count="{{ Cart::count() }}">{{ Cart::count() }}</span>
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

            <!-- Page Content -->
            <main class="main-content bg-white">
                @yield('content')
            </main>

            <!-- Toast Notification Container -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="cartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-primary text-orange">
                        <i class="fas fa-shopping-cart me-2"></i>
                        <strong class="me-auto">Cart Notification</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Product added to cart successfully!
                    </div>
                </div>
            </div>

            @include('layouts.partials.footer')
        </div>

        <!-- Initialize Bootstrap components -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize all tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });

                // Initialize all popovers
                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl)
                });

                // Initialize dropdowns
                var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
                dropdownElementList.forEach(function (dropdownToggleEl) {
                    new bootstrap.Dropdown(dropdownToggleEl, {
                        autoClose: true
                    })
                });
                
                // Initialize toast
                const toastEl = document.getElementById('cartToast');
                const toast = new bootstrap.Toast(toastEl, {
                    autohide: true,
                    delay: 3000
                });
                
                // Handle add to cart forms
                document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        const formData = new FormData(this);
                        const submitButton = this.querySelector('button[type="submit"]');
                        const originalText = submitButton.textContent;
                        
                        // Disable button and show loading state
                        submitButton.disabled = true;
                        submitButton.textContent = 'Adding...';
                        
                        fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => {
                            if (response.status === 401) {
                                // Store the current URL to redirect back after login
                                sessionStorage.setItem('intended_url', window.location.href);
                                window.location.href = '/login';
                                return;
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (!data) return; // Handle the case where we redirected to login
                            
                            // Update cart count in the UI
                            const cartBadge = document.querySelector('.badge.bg-primary');
                            if (cartBadge) {
                                cartBadge.textContent = data.cartCount;
                            }
                            
                            // Update toast message and show it
                            const toastBody = document.querySelector('#cartToast .toast-body');
                            if (toastBody) {
                                toastBody.textContent = data.message;
                            }
                            toast.show();
                            
                            // Reset button
                            submitButton.disabled = false;
                            submitButton.textContent = originalText;
                        })
                        .catch(error => {
                            // Reset button on error
                            submitButton.disabled = false;
                            submitButton.textContent = originalText;
                            
                            // Show error message
                            const toastBody = document.querySelector('#cartToast .toast-body');
                            if (toastBody) {
                                toastBody.textContent = 'An error occurred. Please try again.';
                            }
                            toast.show();
                        });
                    });
                });
            });
        </script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Owl Carousel JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <!-- Isotope -->
        <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

        <!-- Wow JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

        <!-- Initialize Bootstrap Dropdown -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize dropdowns
                var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
                var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                    return new bootstrap.Dropdown(dropdownToggleEl)
                });
            });
        </script>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const navMenu = document.querySelector('.nav-menu');
            
            menuToggle.addEventListener('click', function() {
                menuToggle.classList.toggle('active');
                navMenu.classList.toggle('active');
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!menuToggle.contains(event.target) && !navMenu.contains(event.target)) {
                    menuToggle.classList.remove('active');
                    navMenu.classList.remove('active');
                }
            });
        });
        </script>
    </body>
</html>
