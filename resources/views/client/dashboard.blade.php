@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-semibold mb-6">Welcome, {{ auth()->user()->name }}!</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Orders Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <h2 class="text-xl font-semibold mb-4">My Orders</h2>
                        <p class="text-gray-600 mb-4">View and track your orders</p>
                        <a href="{{ route('client.orders.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            View Orders
                        </a>
                    </div>

                    <!-- Profile Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <h2 class="text-xl font-semibold mb-4">My Profile</h2>
                        <p class="text-gray-600 mb-4">Update your personal information</p>
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit Profile
                        </a>
                    </div>

                    <!-- Shop Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <h2 class="text-xl font-semibold mb-4">Shop</h2>
                        <p class="text-gray-600 mb-4">Browse our products</p>
                        <a href="{{ route('client.products.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            View Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
