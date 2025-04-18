@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="w-full md:w-1/4 lg:w-1/5 mb-8 md:mb-0 md:pr-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Categories</h3>
                <ul class="space-y-2">
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('products.category', $cat) }}" 
                               class="block px-4 py-2 rounded {{ $category->id === $cat->id ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="w-full md:w-3/4 lg:w-4/5">
            <h1 class="text-3xl font-bold mb-8">{{ $category->name }}</h1>
            
            @if($products->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-600">No products found in this category.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <a href="{{ route('products.show', $product) }}">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2">
                                    <a href="{{ route('products.show', $product) }}" class="hover:text-gray-600">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-2">{{ Str::limit($product->description, 50) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold">${{ number_format($product->price, 2) }}</span>
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition duration-300">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 