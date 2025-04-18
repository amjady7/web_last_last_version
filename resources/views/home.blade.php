@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Banner Slider -->
<section id="Gslider" class="carousel slide" data-bs-ride="carousel" style="height: 600px; margin-bottom: 20px; margin-top:10px;">
    <div class="carousel-indicators">
        @foreach($banners as $key => $banner)
            <button type="button" data-bs-target="#Gslider" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($banners as $key => $banner)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ $banner->image_url }}" class="d-block w-100" alt="{{ $banner->title }}" style="height: 600px; object-fit: cover;">
                <div class="carousel-caption text-start" style="left: 10%; right: 50%; top: 50%; transform: translateY(-50%);">
                    <h1 class="text-dark">{{ $banner->title }}</h1>
                    <p class="text-dark">{{ $banner->description }}</p>
                    <a href="{{ route('products.index') }}" class="btn btn-warning" style="font-size: 30px; padding: 15px 30px;">Shop Now</a>
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#Gslider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#Gslider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</section>

<!-- Small Banner -->
<section class="small-banner">
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4">
                    <div class="single-banner">
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}">
                        <div class="content">
                            <h3 style="color: black;">{{ $category->name }}</h3>
                        
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="featured-products py-5">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Featured Products</h2>
            <p>Check out our featured products</p>
        </div>
        <div class="product-grid">
            @foreach($featuredProducts as $product)
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                        @if($product->is_new)
                            <span class="product-badge badge-new">New</span>
                        @endif
                        @if($product->is_hot)
                            <span class="product-badge badge-hot">Hot</span>
                        @endif
                        @if($product->sale_price)
                            <span class="product-badge badge-sale">Sale</span>
                        @endif
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">
                            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                        </h3>
                        <p class="product-description">{{ Str::limit($product->description, 100) }}</p>
                        <div class="product-footer">
                            <div class="product-price">
                                @if($product->sale_price)
                                    <span class="price-old">${{ number_format($product->price, 2) }}</span>
                                    ${{ number_format($product->sale_price, 2) }}
                                @else
                                    ${{ number_format($product->price, 2) }}
                                @endif
                            </div>
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Hot Items -->
<section class="hot-items py-5 bg-light">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Hot Items</h2>
            <p>Check out our hot selling products</p>
        </div>
        <div class="product-grid">
            @foreach($hotProducts as $product)
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                        @if($product->is_new)
                            <span class="product-badge badge-new">New</span>
                        @endif
                        @if($product->is_hot)
                            <span class="product-badge badge-hot">Hot</span>
                        @endif
                        @if($product->sale_price)
                            <span class="product-badge badge-sale">Sale</span>
                        @endif
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">
                            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                        </h3>
                        <p class="product-description">{{ Str::limit($product->description, 100) }}</p>
                        <div class="product-footer">
                            <div class="product-price">
                                @if($product->sale_price)
                                    <span class="price-old">${{ number_format($product->price, 2) }}</span>
                                    ${{ number_format($product->sale_price, 2) }}
                                @else
                                    ${{ number_format($product->price, 2) }}
                                @endif
                            </div>
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Latest Products -->
<section class="latest-products py-5">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Latest Products</h2>
            <p>Check out our latest products</p>
        </div>
        <div class="product-grid">
            @foreach($latestProducts as $product)
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                        @if($product->is_new)
                            <span class="product-badge badge-new">New</span>
                        @endif
                        @if($product->is_hot)
                            <span class="product-badge badge-hot">Hot</span>
                        @endif
                        @if($product->sale_price)
                            <span class="product-badge badge-sale">Sale</span>
                        @endif
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">
                            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                        </h3>
                        <p class="product-description">{{ Str::limit($product->description, 100) }}</p>
                        <div class="product-footer">
                            <div class="product-price">
                                @if($product->sale_price)
                                    <span class="price-old">${{ number_format($product->price, 2) }}</span>
                                    ${{ number_format($product->sale_price, 2) }}
                                @else
                                    ${{ number_format($product->price, 2) }}
                                @endif
                            </div>
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    /* Carousel Control Arrows */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #F7941D;
        border-radius: 50%;
        padding: 20px;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
    }

    /* Product Card Styles */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        padding: 1rem;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
        margin-bottom: 20px;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }

    .product-image-container {
        position: relative;
        padding-top: 100%;
        overflow: hidden;
    }

    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        z-index: 1;
    }

    .badge-new {
        background: #4CAF50;
        color: white;
    }

    .badge-hot {
        background: #f44336;
        color: white;
    }

    .badge-sale {
        background: #ff9800;
        color: white;
    }

    .product-content {
        padding: 1.5rem;
    }

    .product-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .product-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .product-title a:hover {
        color: #F7941D;
    }

    .product-description {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
    }

    .product-price {
        font-size: 1.2rem;
        font-weight: 600;
        color: #F7941D;
    }

    .price-old {
        text-decoration: line-through;
        color: #999;
        font-size: 1rem;
        margin-right: 0.5rem;
    }

    .add-to-cart-btn {
        background: #F7941D;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .add-to-cart-btn:hover {
        background: #e67e00;
        transform: scale(1.05);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1rem;
        }

        .product-content {
            padding: 1rem;
        }

        .product-title {
            font-size: 1rem;
        }

        .product-price {
            font-size: 1.1rem;
        }

        .add-to-cart-btn {
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
        }
    }
</style>

@push('scripts')
<script>
    $(document).ready(function(){
        // Initialize Owl Carousel
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });
    });
</script>
@endpush
@endsection 