@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Product Image -->
                    <div>
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full rounded-lg">
                    </div>

                    <!-- Product Details -->
                    <div>
                        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                        <p class="text-2xl font-bold text-gray-900 mb-4">${{ number_format($product->price, 2) }}</p>
                        
                        <div class="mb-6">
                            <h2 class="text-lg font-semibold mb-2">Description</h2>
                            <p class="text-gray-600">{{ $product->description }}</p>
                        </div>

                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-8">
                            @csrf
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <button type="button" class="bg-gray-200 px-3 py-1 rounded-l" onclick="decreaseQuantity()">-</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-16 text-center border-t border-b border-gray-300 py-1">
                                    <button type="button" class="bg-gray-200 px-3 py-1 rounded-r" onclick="increaseQuantity()">+</button>
                                </div>
                                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                                    Add to Cart
                                </button>
                            </div>
                        </form>

                        <div class="border-t pt-6">
                            <h2 class="text-lg font-semibold mb-4">Product Details</h2>
                            <ul class="space-y-2">
                                <li class="flex">
                                    <span class="text-gray-600 w-32">Category:</span>
                                    <span class="text-gray-900">{{ $product->category->name }}</span>
                                </li>
                                <li class="flex">
                                    <span class="text-gray-600 w-32">Brand:</span>
                                    <span class="text-gray-900">{{ $product->brand->name }}</span>
                                </li>
                                <li class="flex">
                                    <span class="text-gray-600 w-32">Stock:</span>
                                    <span class="text-gray-900">{{ $product->stock }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Related Products -->
                @if($relatedProducts->count() > 0)
                    <div class="mt-12">
                        <h2 class="text-2xl font-bold mb-6">Related Products</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($relatedProducts as $relatedProduct)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                    <a href="{{ route('products.show', $relatedProduct) }}">
                                        <img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name }}" class="w-full h-48 object-cover">
                                    </a>
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold mb-2">
                                            <a href="{{ route('products.show', $relatedProduct) }}" class="text-gray-900 hover:text-indigo-600">
                                                {{ $relatedProduct->name }}
                                            </a>
                                        </h3>
                                        <p class="text-lg font-bold text-gray-900">${{ number_format($relatedProduct->price, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function increaseQuantity() {
        const input = document.getElementById('quantity');
        input.value = parseInt(input.value) + 1;
    }

    function decreaseQuantity() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>
@endpush
@endsection 