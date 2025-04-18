<div class="products-container d-flex flex-wrap gap-4">
    @forelse($products as $product)
        <div class="product-item" style="width: 300px;">
            <div class="card h-100 product-card">
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                    @if($product->is_featured)
                        <span class="badge badge-featured">Featured</span>
                    @endif
                    @if($product->is_hot)
                        <span class="badge badge-hot">Hot</span>
                    @endif
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">${{ number_format($product->price, 2) }}</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="input-group input-group-sm" style="width: 120px;">
                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease">-</button>
                                    <input type="number" class="form-control text-center quantity-input" value="1" min="1" max="99" data-product-id="{{ $product->id }}">
                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="add-to-cart-form flex-grow-1">
                                @csrf
                                <input type="hidden" name="quantity" class="quantity-input" value="1">
                                <button type="submit" class="btn btn-warning w-100 add-to-cart-btn">
                                    Add to Cart
                                </button>
                            </form>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-warning">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                No products found matching your criteria.
            </div>
        </div>
    @endforelse
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="cartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Cart Update</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Item added to cart successfully!
        </div>
    </div>
</div>

@push('styles')
<style>
    .products-container {
        justify-content: flex-start;
    }
    @media (max-width: 768px) {
        .product-item {
            width: 100% !important;
        }
    }
    .quantity-input {
        -moz-appearance: textfield;
    }
    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .cart-count, .cart-badge, .header-cart-count {
        transition: transform 0.2s;
    }
    .cart-count.updated, .cart-badge.updated, .header-cart-count.updated {
        transform: scale(1.2);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartToast = new bootstrap.Toast(document.getElementById('cartToast'), {
        autohide: true,
        delay: 3000
    });
    
    // Function to update cart count
    function updateCartCount(newCount) {
        console.log('Updating cart count to:', newCount);
        
        // Update all cart count elements
        const cartCountElements = document.querySelectorAll('.cart-count, .cart-badge');
        console.log('Found cart count elements:', cartCountElements.length);
        
        cartCountElements.forEach(element => {
            element.textContent = newCount;
            if (element.dataset) {
                element.dataset.cartCount = newCount;
            }
            element.classList.add('updated');
            setTimeout(() => element.classList.remove('updated'), 200);
        });

        // Update cart count in the header
        const headerCartCount = document.querySelector('.header-cart-count');
        if (headerCartCount) {
            headerCartCount.textContent = newCount;
            headerCartCount.classList.add('updated');
            setTimeout(() => headerCartCount.classList.remove('updated'), 200);
        }
    }

    // Handle quantity buttons
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantity-input');
            const currentValue = parseInt(input.value);
            const action = this.dataset.action;
            
            if (action === 'increase' && currentValue < 99) {
                input.value = currentValue + 1;
            } else if (action === 'decrease' && currentValue > 1) {
                input.value = currentValue - 1;
            }
        });
    });

    // Handle quantity input validation
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) value = 1;
            if (value > 99) value = 99;
            this.value = value;
        });
    });

    // Handle add to cart form submission
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitButton = this.querySelector('.add-to-cart-btn');
            const originalText = submitButton.innerHTML;
            const quantity = this.querySelector('.quantity-input').value;
            
            // Show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...';

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
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
                    // Update cart count immediately
                    updateCartCount(data.cartCount);

                    // Show success toast
                    cartToast.show();

                    // Reset quantity to 1
                    this.querySelector('.quantity-input').value = 1;
                } else {
                    alert('Error adding to cart: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error adding to cart. Please try again.');
            } finally {
                // Reset button state
                submitButton.disabled = false;
                submitButton.innerHTML = 'Add to Cart';
            }
        });
    });
});
</script>
@endpush

<div class="mt-6">
    {{ $products->links() }}
</div> 