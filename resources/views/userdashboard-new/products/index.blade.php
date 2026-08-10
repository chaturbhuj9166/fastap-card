@extends('layouts.redesign.dashboard')

@section('page-title', 'My Products')
@section('breadcrumb', 'Products')

@section('dashboard-content')
<div class="products-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Products</h1>
            <p>Manage your product listings</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/addmyproduct') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Product
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="stats-row fade-up">
        @php
            $totalProducts = $myproducts ? (is_countable($myproducts) ? count($myproducts) : 0) : 0;
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon green">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalProducts }}</span>
                <span class="stat-mini-label">Total Products</span>
            </div>
        </div>
    </div>

    @if($myproducts && count($myproducts) > 0)
        <div class="products-grid stagger-animation">
            @foreach($myproducts as $product)
                <div class="product-card fade-up">
                    <div class="product-image">
                        @php
                            $images = json_decode($product->images, true);
                            $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                        @endphp
                        @if($firstImage)
                            <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $product->title }}">
                        @else
                            <div class="product-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        @if(is_array($images) && count($images) > 1)
                            <span class="image-count">
                                <i class="fas fa-images"></i> {{ count($images) }}
                            </span>
                        @endif
                    </div>
                    <div class="product-body">
                        <h4 class="product-title">{{ Str::limit($product->title, 40) }}</h4>
                        <div class="product-price">
                            @if($product->mrp_price && $product->mrp_price > $product->price)
                                <span class="price-original">₹{{ number_format($product->mrp_price) }}</span>
                            @endif
                            <span class="price-current">₹{{ number_format($product->price) }}</span>
                        </div>
                        @if($product->description)
                            <p class="product-description">{{ Str::limit($product->description, 60) }}</p>
                        @endif
                        <p class="product-date">Added {{ $product->created_at ? $product->created_at->diffForHumans() : 'N/A' }}</p>
                    </div>
                    <div class="product-actions">
                        <a href="{{ url('/editmyproduct' . $product->id) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('/deletemyproduct' . $product->id) }}" class="action-btn danger" title="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-box"></i>
            </div>
            <h3>No Products Yet</h3>
            <p>Add products to showcase and sell on your profile.</p>
            <a href="{{ url('/addmyproduct') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Product
            </a>
        </div>
    @endif
</div>

<style>
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
}

.product-card {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.product-image {
    position: relative;
    width: 100%;
    height: 200px;
    background: var(--bg-secondary);
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    font-size: 3rem;
}

.image-count {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

.product-body {
    padding: 1.25rem;
    flex: 1;
}

.product-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0 0 0.75rem;
}

.product-price {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
}

.price-original {
    color: var(--text-muted);
    text-decoration: line-through;
    font-size: 0.9rem;
}

.price-current {
    color: var(--success-color);
    font-size: 1.25rem;
    font-weight: 700;
}

.product-description {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 0.5rem;
    line-height: 1.5;
}

.product-date {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin: 0;
}

.product-actions {
    display: flex;
    border-top: 1px solid var(--border-color);
    padding: 0.75rem 1.25rem;
    gap: 0.5rem;
    justify-content: flex-end;
}

.stat-mini-icon.green {
    background: linear-gradient(135deg, var(--success-color), #27ae60);
}

@media (max-width: 576px) {
    .products-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@include('userdashboard-new.partials.content-page-styles')
@endsection
