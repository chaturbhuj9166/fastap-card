@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Category Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Categories</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('store.index') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-th-large"></i> All Products
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('store.category', $cat->slug) }}" class="list-group-item list-group-item-action {{ $cat->id == $category->id ? 'active' : '' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="col-lg-9">
            <div class="category-header mb-4">
                <h1>{{ $category->name }}</h1>
                <p class="text-muted">{{ $products->total() }} products found</p>
            </div>

            @if($products->count() > 0)
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif

                            <div class="card-body">
                                <span class="badge bg-{{ $product->isAdminProduct() ? 'primary' : 'success' }} mb-2">
                                    {{ $product->isAdminProduct() ? 'Official' : 'Seller' }}
                                </span>

                                <h5 class="card-title">{{ Str::limit($product->name, 50) }}</h5>

                                <div class="mb-2">
                                    @if($product->isOnSale())
                                        <span class="text-decoration-line-through text-muted">₹{{ number_format($product->price, 2) }}</span>
                                        <span class="text-danger fw-bold ms-2">₹{{ number_format($product->sale_price, 2) }}</span>
                                        <span class="badge bg-danger ms-1">-{{ $product->getDiscountPercentage() }}%</span>
                                    @else
                                        <span class="fw-bold">₹{{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>

                                @if($product->stock_quantity > 0)
                                    <small class="text-success"><i class="fas fa-check-circle"></i> In Stock</small>
                                @else
                                    <small class="text-danger"><i class="fas fa-times-circle"></i> Out of Stock</small>
                                @endif
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('store.show', $product->slug) }}" class="btn btn-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-info">No products found in this category.</div>
            @endif
        </div>
    </div>
</div>
@endsection
