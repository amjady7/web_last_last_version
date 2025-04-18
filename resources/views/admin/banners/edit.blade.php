@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-300 mb-6">Edit Banner</h1>

        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('description', $banner->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-300">Current Image</label>
                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="h-32 w-32 object-cover rounded-lg mb-2">
                <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-700 file:text-gray-300 hover:file:bg-gray-600">
                @error('image')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="link" class="block text-sm font-medium text-gray-300">Link (optional)</label>
                <input type="url" name="link" id="link" value="{{ old('link', $banner->link) }}" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                @error('link')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="order" class="block text-sm font-medium text-gray-300">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', $banner->order) }}" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                @error('order')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" class="rounded bg-gray-700 border-gray-600 text-blue-500 shadow-sm focus:border-blue-500 focus:ring-blue-500" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-300">Active</span>
                </label>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.banners.index') }}" class="bg-gray-700 hover:bg-gray-600 text-gray-300 px-4 py-2 rounded-lg mr-3">Cancel</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Update Banner</button>
            </div>
        </form>
    </div>
</div>
@endsection 