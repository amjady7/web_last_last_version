@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6">
            <div class="product-gallery">
                <div class="main-image mb-3">
                    <img src="{{ $product->image_url }}" class="img-fluid rounded" alt="{{ $product->name }}" id="mainImage">
                </div>
                @if($product->images)
                    <div class="thumbnail-images d-flex gap-2">
                        <img src="{{ $product->image_url }}" class="thumbnail active" onclick="changeImage(this.src)">
                        @foreach(json_decode($product->images) as $image)
                            <img src="{{ asset('storage/' . $image) }}" class="thumbnail" onclick="changeImage(this.src)">
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <div class="product-details">
                <h1 class="mb-3">{{ $product->name }}</h1>
                
                <div class="price mb-3">
                    @if($product->sale_price)
                        <span class="text-muted text-decoration-line-through me-2">${{ number_format($product->price, 2) }}</span>
                        <span class="h4 text-danger">${{ number_format($product->sale_price, 2) }}</span>
                    @else
                        <span class="h4">${{ number_format($product->price, 2) }}</span>
                    @endif
                </div>

                <div class="product-badges mb-3">
                    @if($product->is_new)
                        <span class="badge bg-success me-2">New</span>
                    @endif
                    @if($product->is_hot)
                        <span class="badge bg-danger me-2">Hot</span>
                    @endif
                    @if($product->sale_price)
                        <span class="badge bg-warning me-2">Sale</span>
                    @endif
                </div>

                <div class="description mb-4">
                    <h5>Description</h5>
                    <p>{{ $product->description }}</p>
                </div>

                <div class="product-meta mb-4">
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Categories:</strong> 
                                @forelse($product->categories as $category)
                                    <a href="{{ route('products.category', $category) }}" class="text-decoration-none">{{ $category->name }}</a>
                                    @if(!$loop->last), @endif
                                @empty
                                    Uncategorized
                                @endforelse
                            </p>
                        </div>
                        <div class="col-6">
                            <p><strong>Brand:</strong> {{ $product->brand?->name ?? 'No Brand' }}</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('cart.add', $product) }}" method="POST" class="add-to-cart-form">
                    @csrf
                    <div class="row align-items-center mb-4">
                        <div class="col-auto">
                            <div class="input-group" style="width: 150px;">
                                <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button>
                                <input type="number" class="form-control text-center" name="quantity" value="1" min="1" max="{{ $product->stock }}" id="quantity">
                                <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </form>

                <div class="product-actions">
                    <button class="btn btn-outline-secondary me-2" onclick="addToWishlist({{ $product->id }})">
                        <i class="far fa-heart me-2"></i>Add to Wishlist
                    </button>
                    <button class="btn btn-outline-secondary" onclick="shareProduct()">
                        <i class="fas fa-share-alt me-2"></i>Share
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Similar Products -->
    <div class="similar-products mt-5">
        <h3 class="mb-4">Similar Products</h3>
        <div class="row">
            @foreach($relatedProducts as $relatedProduct)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="product-img">
                            <img src="{{ $relatedProduct->image_url }}" class="card-img-top" alt="{{ $relatedProduct->name }}">
                            @if($relatedProduct->is_new)
                                <span class="product-badge badge-new">New</span>
                            @endif
                            @if($relatedProduct->is_hot)
                                <span class="product-badge badge-hot">Hot</span>
                            @endif
                            @if($relatedProduct->sale_price)
                                <span class="product-badge badge-sale">Sale</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                            <div class="price">
                                @if($relatedProduct->sale_price)
                                    <span class="price-old">${{ number_format($relatedProduct->price, 2) }}</span>
                                    <span>${{ number_format($relatedProduct->sale_price, 2) }}</span>
                                @else
                                    <span>${{ number_format($relatedProduct->price, 2) }}</span>
                                @endif
                            </div>
                            <a href="{{ route('products.show', $relatedProduct) }}" class="btn btn-primary mt-2">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('styles')
<style>
    .product-gallery {
        position: relative;
    }
    .main-image {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        overflow: hidden;
    }
    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        opacity: 0.7;
        transition: all 0.3s ease;
    }
    .thumbnail:hover, .thumbnail.active {
        opacity: 1;
        border-color: #0d6efd;
    }
    .product-badges .badge {
        font-size: 0.9rem;
        padding: 0.5em 0.75em;
    }
    .price-old {
        text-decoration: line-through;
        color: #6c757d;
        margin-right: 0.5rem;
    }
    .product-actions .btn {
        padding: 0.5rem 1rem;
    }
</style>
@endpush

@push('scripts')
<script>
    function changeImage(src) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
            if(thumb.src === src) {
                thumb.classList.add('active');
            }
        });
    }

    function increaseQuantity() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.max);
        if(parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    }

    function decreaseQuantity() {
        const input = document.getElementById('quantity');
        if(parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    function addToWishlist(productId) {
        // Implement wishlist functionality
        alert('Added to wishlist!');
    }

    function shareProduct() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $product->name }}',
                text: 'Check out this product!',
                url: window.location.href
            });
        } else {
            alert('Share functionality is not supported in your browser.');
        }
    }
</script>
@endpush
@endsection 