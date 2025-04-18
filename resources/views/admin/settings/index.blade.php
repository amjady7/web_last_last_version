@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-100">Site Settings</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-800 rounded-lg shadow p-6">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <div>
                        <label for="site_title" class="block text-sm font-medium text-gray-300 mb-2">Site Title</label>
                        <input type="text" name="site_title" id="site_title" 
                               value="{{ old('site_title', $settings->site_title ?? '') }}" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('site_title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="site_logo" class="block text-sm font-medium text-gray-300 mb-2">Site Logo</label>
                        <input type="file" name="site_logo" id="site_logo" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('site_logo')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        @if(isset($settings) && $settings->site_logo)
                            <div class="mt-2">
                                <img src="{{ Storage::url($settings->site_logo) }}" alt="Current Logo" class="max-h-24">
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email', $settings->email ?? '') }}" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Phone Number</label>
                        <input type="text" name="phone" id="phone" 
                               value="{{ old('phone', $settings->phone ?? '') }}" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column - Social Media Links -->
                <div class="space-y-4">
                    <h4 class="text-lg font-medium text-gray-300 mb-4">Social Media Links</h4>
                    
                    <div>
                        <label for="facebook_url" class="block text-sm font-medium text-gray-300 mb-2">Facebook URL</label>
                        <input type="url" name="facebook_url" id="facebook_url" 
                               value="{{ old('facebook_url', $settings->facebook_url ?? '') }}" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('facebook_url')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="twitter_url" class="block text-sm font-medium text-gray-300 mb-2">Twitter URL</label>
                        <input type="url" name="twitter_url" id="twitter_url" 
                               value="{{ old('twitter_url', $settings->twitter_url ?? '') }}" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('twitter_url')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="instagram_url" class="block text-sm font-medium text-gray-300 mb-2">Instagram URL</label>
                        <input type="url" name="instagram_url" id="instagram_url" 
                               value="{{ old('instagram_url', $settings->instagram_url ?? '') }}" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('instagram_url')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="linkedin_url" class="block text-sm font-medium text-gray-300 mb-2">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" id="linkedin_url" 
                               value="{{ old('linkedin_url', $settings->linkedin_url ?? '') }}" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('linkedin_url')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="youtube_url" class="block text-sm font-medium text-gray-300 mb-2">YouTube URL</label>
                        <input type="url" name="youtube_url" id="youtube_url" 
                               value="{{ old('youtube_url', $settings->youtube_url ?? '') }}" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('youtube_url')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 