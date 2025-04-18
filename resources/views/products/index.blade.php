@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Filters</h5>
                </div>
                <div class="card-body">
                    <form id="filterForm">
                        <!-- Price Range -->
                        <div class="mb-4">
                            <h6>Price Range</h6>
                            <div class="d-flex align-items-center">
                                <input type="number" class="form-control me-2" id="minPrice" placeholder="Min" name="min_price">
                                <span>-</span>
                                <input type="number" class="form-control ms-2" id="maxPrice" placeholder="Max" name="max_price">
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="mb-4">
                            <h6>Categories</h6>
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category{{ $category->id }}">
                                    <label class="form-check-label" for="category{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Brands -->
                        <div class="mb-4">
                            <h6>Brands</h6>
                            @foreach($brands as $brand)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="brands[]" value="{{ $brand->id }}" id="brand{{ $brand->id }}">
                                    <label class="form-check-label" for="brand{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-9">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h2>Products</h2>
                </div>
                <div class="col-md-6 text-end">
                    <select class="form-select" id="sortBy">
                        <option value="latest">Latest</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                        <option value="name_asc">Name: A to Z</option>
                        <option value="name_desc">Name: Z to A</option>
                    </select>
                </div>
            </div>

            <div class="row" id="productsGrid">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="product-img">
                                <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
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
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                                <div class="price">
                                    @if($product->sale_price)
                                        <span class="price-old">${{ number_format($product->price, 2) }}</span>
                                        <span>${{ number_format($product->sale_price, 2) }}</span>
                                    @else
                                        <span>${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary mt-2">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle filter form submission
        $('#filterForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            const sortBy = $('#sortBy').val();
            
            $.ajax({
                url: '{{ route("products.index") }}',
                type: 'GET',
                data: formData + '&sort=' + sortBy,
                success: function(response) {
                    $('#productsGrid').html(response);
                }
            });
        });

        // Handle sort change
        $('#sortBy').on('change', function() {
            $('#filterForm').submit();
        });
    });
</script>
@endpush
@endsection 