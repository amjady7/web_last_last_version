<!-- Banner Section -->
<div class="mt-4">
    <div class="px-6 py-2 text-xs font-medium text-gray-400 uppercase tracking-wider">BANNER</div>
    <div class="mt-2">
        
        <a href="{{ route('admin.banners.index') }}" class="flex items-center px-6 py-3 text-gray-300 {{ request()->routeIs('admin.banners.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
            </svg>
            Banners
        </a>
    </div>
</div> 