@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-2xl font-bold">All Products</h2>
                <div class="d-flex gap-3">
                    <select class="form-select">
                        <option>Sort by</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest First</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="product-grid">
        @include('products.partials.grid', ['products' => $products])
    </div>
</div>
@endsection 