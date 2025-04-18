@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-white mb-6">Create New Category</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 border border-gray-700 shadow-lg rounded-xl p-6">
            @csrf

            <!-- Name -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-blue-400">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="mt-2 w-full rounded-lg bg-gray-900 border border-blue-500 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2.5"
                    placeholder="Enter category name" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-5">
                <label for="description" class="block text-sm font-semibold text-blue-400">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-2 w-full rounded-lg bg-gray-900 border border-blue-500 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2.5"
                    placeholder="Enter category description">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div class="mb-5">
                <label for="image" class="block text-sm font-semibold text-blue-400">Image</label>
                <input type="file" name="image" id="image"
                    class="mt-2 block w-full text-sm text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition">
                @error('image')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order -->
            <div class="mb-5">
                <label for="order" class="block text-sm font-semibold text-blue-400">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                    class="mt-2 w-full rounded-lg bg-gray-900 border border-blue-500 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2.5"
                    placeholder="Category display order">
                @error('order')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Checkbox -->
            <div class="mb-5">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="is_active"
                        class="rounded text-blue-500 focus:ring-2 focus:ring-blue-500"
                        {{ old('is_active', true) ? 'checked' : '' }}>
                    <span class="text-sm text-gray-300">Active</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end">
                <a href="{{ route('admin.categories.index') }}"
                    class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">Cancel</a>
                <button type="submit"
                    class="ml-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition font-semibold">Create Category</button>
            </div>
        </form>
    </div>
</div>
@endsection 