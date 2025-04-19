<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            transition: all 0.3s ease;
            position: fixed;
            z-index: 40;
            width: 16rem;
        }
        .sidebar-item {
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.1);
            border-left: 3px solid #4f46e5;
        }
        .sidebar-item.active {
            background: rgba(255, 255, 255, 0.1);
            border-left: 3px solid #4f46e5;
        }
        .content-wrapper {
            background: #f3f4f6;
            margin-left: 16rem;
            transition: all 0.3s ease;
            width: calc(100% - 16rem);
        }
        .header {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 30;
        }
        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 0.5rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            min-width: 200px;
        }
        .dropdown-menu.show {
            display: block;
        }
        .mobile-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 30;
        }
        .mobile-backdrop.show {
            display: block;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 80%;
                max-width: 300px;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .content-wrapper {
                margin-left: 0;
                width: 100%;
            }
            .content-wrapper.sidebar-open {
                margin-left: 0;
            }
            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .card-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-100">
    <div class="min-h-screen">
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden fixed top-4 left-4 z-50 p-2 rounded-md text-gray-300 hover:text-white focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
        
        <!-- Mobile Backdrop -->
        <div id="mobile-backdrop" class="mobile-backdrop"></div>
        
        <div class="flex h-screen">
            @include('admin.partials.sidebar')
            
            <div class="flex-1 overflow-auto bg-gray-800">
                <!-- Admin Header -->
                <nav class="bg-gray-900 shadow-sm sticky top-0 z-10 border-b border-gray-700">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <!-- Logo -->
                                <div class="shrink-0 flex items-center">
                                    <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-white">
                                    <div class="col-md-3">
                @if(isset($settings) && $settings->site_logo)
                <a href="{{ route('home') }}" class="text-decoration-none">
                        <h1 class="h3 mb-0">{{ isset($settings) ? $settings->site_title : config('app.name') }}</h1>
                    </a>
                @endif
            </div>
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-center">
                                
                                <div class="relative ml-4">
                                    <button id="user-menu-button" class="flex items-center text-gray-300 hover:text-white">
                                        <img src="https://ui-avatars.com/api/?name=Admin&background=4f46e5&color=fff" class="h-8 w-8 rounded-full" alt="Admin">
                                        <span class="ml-2 hidden sm:inline">Admin</span>
                                        <i class="fas fa-chevron-down ml-2"></i>
                                    </button>
                                    <div id="user-menu" class="dropdown-menu">
                                        <div class="py-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Content -->
                <main class="p-4 md:p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Mobile menu toggle
            $('#mobile-menu-button').click(function() {
                $('.sidebar').toggleClass('show');
                $('#mobile-backdrop').toggleClass('show');
                $('body').toggleClass('overflow-hidden');
            });
            
            // Close sidebar when clicking on backdrop
            $('#mobile-backdrop').click(function() {
                $('.sidebar').removeClass('show');
                $('#mobile-backdrop').removeClass('show');
                $('body').removeClass('overflow-hidden');
            });

            // Toggle user menu
            $('#user-menu-button').click(function() {
                $('#user-menu').toggleClass('show');
            });

            // Close menu when clicking outside
            $(document).click(function(event) {
                if (!$(event.target).closest('#user-menu-button').length) {
                    $('#user-menu').removeClass('show');
                }
            });
            
            // Close sidebar when window is resized to desktop size
            $(window).resize(function() {
                if ($(window).width() > 768) {
                    $('.sidebar').removeClass('show');
                    $('#mobile-backdrop').removeClass('show');
                    $('body').removeClass('overflow-hidden');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html> 