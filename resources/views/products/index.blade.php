@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">Filters</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET" id="filterForm">
                        <!-- Search -->
                        <div class="mb-3">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Search products...">
                        </div>

                        <!-- Categories -->
                        <div class="mb-3">
                            <label class="form-label">Categories</label>
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]" 
                                           value="{{ $category->id }}" id="category{{ $category->id }}"
                                           {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Brands -->
                        <div class="mb-3">
                            <label class="form-label">Brands</label>
                            @foreach($brands as $brand)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="brands[]" 
                                           value="{{ $brand->id }}" id="brand{{ $brand->id }}"
                                           {{ in_array($brand->id, request('brands', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="brand{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Price Range -->
                        <div class="mb-3">
                            <label class="form-label">Price Range</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" class="form-control" name="min_price" 
                                           value="{{ request('min_price') }}" placeholder="Min">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control" name="max_price" 
                                           value="{{ request('max_price') }}" placeholder="Max">
                                </div>
                            </div>
                        </div>

                        <!-- Sort -->
                        <div class="mb-3">
                            <label for="sort" class="form-label">Sort By</label>
                            <select class="form-select" id="sort" name="sort">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-warning w-100">Apply Filters</button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-warning w-100 mt-2">Reset</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <!-- Mobile Filter Toggle -->
            <div class="d-lg-none mb-3">
                <button class="btn btn-warning w-100" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                    <i class="fas fa-filter me-2"></i>Filters
                </button>
                <div class="collapse mt-3" id="filterCollapse">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('products.index') }}" method="GET" id="mobileFilterForm">
                                <!-- Search -->
                                <div class="mb-3">
                                    <label for="mobileSearch" class="form-label">Search</label>
                                    <input type="text" class="form-control" id="mobileSearch" name="search" 
                                           value="{{ request('search') }}" placeholder="Search products...">
                                </div>

                                <!-- Categories -->
                                <div class="mb-3">
                                    <label class="form-label">Categories</label>
                                    @foreach($categories as $category)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="categories[]" 
                                                   value="{{ $category->id }}" id="mobileCategory{{ $category->id }}"
                                                   {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="mobileCategory{{ $category->id }}">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Brands -->
                                <div class="mb-3">
                                    <label class="form-label">Brands</label>
                                    @foreach($brands as $brand)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="brands[]" 
                                                   value="{{ $brand->id }}" id="mobileBrand{{ $brand->id }}"
                                                   {{ in_array($brand->id, request('brands', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="mobileBrand{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Price Range -->
                                <div class="mb-3">
                                    <label class="form-label">Price Range</label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="min_price" 
                                                   value="{{ request('min_price') }}" placeholder="Min">
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="max_price" 
                                                   value="{{ request('max_price') }}" placeholder="Max">
                                        </div>
                                    </div>
                                </div>

                                <!-- Sort -->
                                <div class="mb-3">
                                    <label for="mobileSort" class="form-label">Sort By</label>
                                    <select class="form-select" id="mobileSort" name="sort">
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-warning w-100">Apply Filters</button>
                                <a href="{{ route('products.index') }}" class="btn btn-outline-warning w-100 mt-2">Reset</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            @include('products.partials.grid', ['products' => $products])

            <!-- Pagination -->
            @include('products.partials.pagination', ['products' => $products])
        </div>
    </div>
</div>

@push('styles')
<style>
    .product-card {
        transition: transform 0.2s;
    }
    .product-card:hover {
        transform: translateY(-5px);
    }
    .product-image {
        height: 200px;
        object-fit: cover;
    }
    .badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1;
    }
    .badge-featured {
        background-color: #ffc107;
        color: #000;
    }
    .badge-hot {
        background-color: #dc3545;
        color: #fff;
    }
    @media (max-width: 768px) {
        .product-image {
            height: 150px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto-submit form when filters change
    document.querySelectorAll('#filterForm select, #mobileFilterForm select').forEach(select => {
        select.addEventListener('change', () => {
            select.closest('form').submit();
        });
    });
</script>
@endpush
@endsection 