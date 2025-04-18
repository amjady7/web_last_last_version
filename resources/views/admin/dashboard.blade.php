@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Total Sales Card -->
    <div class="card p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                <i class="fas fa-dollar-sign text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Sales</h3>
                <p class="text-2xl font-semibold text-gray-800">${{ number_format($totalSales, 2) }}</p>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-green-500 text-sm font-semibold">
                <i class="fas fa-arrow-up"></i> 12%
            </span>
            <span class="text-gray-500 text-sm ml-2">vs last month</span>
        </div>
    </div>

    <!-- Total Orders Card -->
    <div class="card p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-shopping-bag text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Orders</h3>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalOrders }}</p>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-green-500 text-sm font-semibold">
                <i class="fas fa-arrow-up"></i> 8%
            </span>
            <span class="text-gray-500 text-sm ml-2">vs last month</span>
        </div>
    </div>

    <!-- Total Products Card -->
    <div class="card p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-box text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Products</h3>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalProducts }}</p>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-green-500 text-sm font-semibold">
                <i class="fas fa-arrow-up"></i> 5%
            </span>
            <span class="text-gray-500 text-sm ml-2">vs last month</span>
        </div>
    </div>

    <!-- Total Customers Card -->
    <div class="card p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Customers</h3>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalCustomers }}</p>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-green-500 text-sm font-semibold">
                <i class="fas fa-arrow-up"></i> 15%
            </span>
            <span class="text-gray-500 text-sm ml-2">vs last month</span>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card p-6 mb-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Recent Orders</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-800">View All</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($recentOrders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $order->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($order->total_amount, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                               ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                               ($order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                               'bg-red-100 text-red-800')) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Sales Chart -->
<div class="card p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Sales Overview</h2>
        <div class="flex space-x-2">
            <button class="px-3 py-1 text-sm bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Week</button>
            <button class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Month</button>
            <button class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Year</button>
        </div>
    </div>
    <div class="h-80">
        <!-- Chart will be implemented here -->
        <div class="flex items-center justify-center h-full bg-gray-50 rounded-lg">
            <p class="text-gray-500">Sales chart will be displayed here</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart implementation will go here
</script>
@endsection
