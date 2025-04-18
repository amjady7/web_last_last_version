<!-- Top Navigation -->
<div class="bg-white shadow-sm sticky top-0 z-10">
    <div class="flex items-center justify-between h-16 px-8">
        <!-- Left Side -->
        <div class="flex items-center flex-1">
            <a href="{{ route('welcome') }}" class="text-gray-500 hover:text-gray-600 mr-4">
                <i class="fas fa-home"></i> Home
            </a>
            <button class="text-gray-500 hover:text-gray-600 focus:outline-none lg:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div class="relative ml-4 flex-1 max-w-xs lg:max-w-md">
                <input type="text" placeholder="Search..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="flex items-center space-x-6">
            @include('admin.partials.header.notifications')
            @include('admin.partials.header.messages')
            @include('admin.partials.header.profile')
        </div>
    </div>
</div> 