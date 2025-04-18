<!--
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
-->

<footer class="bg-black text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <!-- Contact Information and About Us -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                <div class="space-y-2">
                    <p class="flex items-center justify-center">
                        <i class="fas fa-envelope mr-2"></i>
                        {{ $settings->email ?? 'contact@example.com' }}
                    </p>
                    <p class="flex items-center justify-center">
                        <i class="fas fa-phone mr-2"></i>
                        {{ $settings->phone ?? '+1 234 567 890' }}
                    </p>
                </div>
                <div class="mt-4">
                    <h4 class="text-lg font-semibold mb-2">About Us</h4>
                    <p class="text-gray-300">
                        {{ $settings->about_us ?? 'Your company description goes here.' }}
                    </p>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-400">Home</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-blue-400">Products</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-400">Contact</a></li>
                </ul>
            </div>

            <!-- Social Media -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
                <div class="social-icons flex justify-center space-x-4">
                    @if(isset($settings))
                        @if($settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" class="text-white hover:text-blue-400" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if($settings->twitter_url)
                            <a href="{{ $settings->twitter_url }}" class="text-white hover:text-blue-400" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if($settings->instagram_url)
                            <a href="{{ $settings->instagram_url }}" class="text-white hover:text-blue-400" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($settings->linkedin_url)
                            <a href="{{ $settings->linkedin_url }}" class="text-white hover:text-blue-400" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endif
                        @if($settings->youtube_url)
                            <a href="{{ $settings->youtube_url }}" class="text-white hover:text-blue-400" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="mt-8 text-center">
            <p class="text-gray-400">&copy; {{ date('Y') }} {{ isset($settings) ? $settings->site_title : config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</footer>