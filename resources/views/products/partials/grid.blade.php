@foreach($products as $product)
    <div class="product-card">
        <div class="product-image-container">
            <a href="{{ route('products.show', $product) }}">
                <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="product-image">
            </a>
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
                        <span>${{ number_format($product->sale_price, 2) }}</span>
                    @else
                        ${{ number_format($product->price, 2) }}
                    @endif
                </div>
                <form action="{{ route('cart.add', $product) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="add-to-cart-btn">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Add to Cart</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endforeach

@if($products->isEmpty())
    <div class="text-center py-5">
        <p class="text-muted">No products found matching your criteria.</p>
    </div>
@endif

<div class="mt-6">
    {{ $products->links() }}
</div> 