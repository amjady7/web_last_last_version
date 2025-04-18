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

                <form action="{{ route('cart.add', $product) }}" method="POST" class="add-to-cart-form" id="addToCartForm">
                    @csrf
                    <div class="row align-items-center mb-4">
                        <div class="col-auto">
                            <div class="input-group" style="width: 150px;">
                                <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease">-</button>
                                <input type="number" class="form-control text-center quantity-input" name="quantity" value="1" min="1" max="{{ $product->stock }}" id="quantity">
                                <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase">+</button>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-warning btn-lg w-100 add-to-cart-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </form>

                <div class="product-actions">
                    <button class="btn btn-outline-warning me-2" onclick="addToWishlist({{ $product->id }})">
                        <i class="far fa-heart me-2"></i>Add to Wishlist
                    </button>
                    <button class="btn btn-outline-warning" onclick="shareProduct()">
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

    // Handle quantity buttons
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            const action = this.dataset.action;
            
            if (action === 'increase' && currentValue < parseInt(input.max)) {
                input.value = currentValue + 1;
            } else if (action === 'decrease' && currentValue > 1) {
                input.value = currentValue - 1;
            }
        });
    });

    // Handle quantity input validation
    document.getElementById('quantity').addEventListener('change', function() {
        let value = parseInt(this.value);
        const max = parseInt(this.max);
        if (isNaN(value) || value < 1) value = 1;
        if (value > max) value = max;
        this.value = value;
    });

    // Handle add to cart form submission
    document.getElementById('addToCartForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitButton = this.querySelector('.add-to-cart-btn');
        const originalText = submitButton.innerHTML;
        const quantity = document.getElementById('quantity').value;
        
        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...';

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    quantity: quantity
                })
            });

            if (response.status === 401) {
                // Store the current URL to redirect back after login
                sessionStorage.setItem('intended_url', window.location.href);
                window.location.href = '/login';
                return;
            }

            const data = await response.json();
            console.log('Server response:', data);

            if (data.success) {
                // Update cart count
                const cartCountElements = document.querySelectorAll('.cart-count');
                cartCountElements.forEach(element => {
                    element.textContent = data.cartCount;
                    element.dataset.cartCount = data.cartCount;
                    element.classList.add('updated');
                    setTimeout(() => element.classList.remove('updated'), 200);
                });

                // Show success toast
                const toast = new bootstrap.Toast(document.getElementById('cartToast'));
                toast.show();

                // Reset quantity to 1
                document.getElementById('quantity').value = 1;
            } else {
                alert('Error adding to cart: ' + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error adding to cart. Please try again.');
        } finally {
            // Reset button state
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
        }
    });

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