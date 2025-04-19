<!-- Profile Dropdown -->
<div class="relative">
    <button class="flex items-center space-x-3 focus:outline-none">
        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
            <span class="text-sm font-medium text-gray-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
        </div>
        <div class="hidden md:block">
            <div class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</div>
            
        </div>
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
</div> 