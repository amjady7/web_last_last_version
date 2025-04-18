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