@extends('frontend.layouts.app')

@section('content')
<div class="container py-5 store-page">
    <div class="store-hero mb-4">
        <div>
            <span class="store-kicker">Fastap Store</span>
            <h1>Discover products and services from verified sellers</h1>
            <p>Filter by category, source, and type to find what you need.</p>
        </div>
    </div>
    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="card filter-card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Filters</h5>

                    <form method="GET">
                        <!-- Source Filter -->
                        <div class="mb-3">
                            <label class="form-label">Source</label>
                            <select name="source" class="form-select" onchange="this.form.submit()">
                                <option value="">All Products</option>
                                <option value="admin" {{ request('source') == 'admin' ? 'selected' : '' }}>Official Store</option>
                                <option value="user" {{ request('source') == 'user' ? 'selected' : '' }}>User Products</option>
                            </select>
                        </div>

                        <!-- Category Filter -->
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Type Filter -->
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select" onchange="this.form.submit()">
                                <option value="">All</option>
                                <option value="product" {{ request('type') == 'product' ? 'selected' : '' }}>Products</option>
                                <option value="service" {{ request('type') == 'service' ? 'selected' : '' }}>Services</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        <a href="{{ route('store.index') }}" class="btn btn-outline-secondary w-100 mt-2">Clear</a>
                    </form>
                </div>
            </div>

            <!-- Featured Products -->
            @if($featuredProducts->count() > 0)
            <div class="card mt-3 featured-card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Featured</h5>
                    @foreach($featuredProducts as $featured)
                    <div class="mb-3">
                        <a href="{{ route('store.show', $featured->slug) }}" class="text-decoration-none">
                            <div class="d-flex">
                                @if($featured->images && count($featured->images) > 0)
                                    <img src="{{ asset('storage/' . $featured->images[0]) }}" alt="{{ $featured->name }}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded">
                                @endif
                                <div class="ms-2">
                                    <div class="small fw-bold">{{ Str::limit($featured->name, 30) }}</div>
                                    <div class="text-primary">₹{{ number_format($featured->getFinalPrice(), 2) }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 store-toolbar">
                <h2>Fastap Store</h2>
                <select name="sort" class="form-select w-auto" onchange="window.location.href='?sort='+this.value">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>

            @if($products->count() > 0)
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 product-card">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                            @else
                                <div class="product-placeholder d-flex align-items-center justify-content-center">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif

                            <div class="card-body">
                                <span class="badge source-badge bg-{{ $product->isAdminProduct() ? 'primary' : 'success' }} mb-2">
                                    {{ $product->isAdminProduct() ? 'Official' : 'Seller: ' . ($product->user->name ?? 'N/A') }}
                                </span>

                                <h5 class="card-title">{{ Str::limit($product->name, 50) }}</h5>

                                <div class="mb-2 product-price">
                                    @if($product->isOnSale())
                                        <span class="price-old">₹{{ number_format($product->price, 2) }}</span>
                                        <span class="price-new">₹{{ number_format($product->sale_price, 2) }}</span>
                                        <span class="badge bg-danger ms-1">-{{ $product->getDiscountPercentage() }}%</span>
                                    @else
                                        <span class="price-new">₹{{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>

                                @if($product->category)
                                    <small class="text-muted">{{ $product->category->name }}</small>
                                @endif
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('store.show', $product->slug) }}" class="btn btn-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-info">No products found.</div>
            @endif
        </div>
    </div>
</div>
<style>
.store-page {
    color: #0f172a;
}

.store-hero {
    background: linear-gradient(120deg, #0f172a 0%, #1f2937 55%, #0f172a 100%);
    color: #f8fafc;
    border-radius: 18px;
    padding: 28px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
}

.store-kicker {
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 12px;
    font-weight: 700;
    color: rgba(248, 250, 252, 0.7);
}

.store-hero h1 {
    font-size: 32px;
    margin: 8px 0 6px;
}

.store-hero p {
    margin: 0;
    color: rgba(248, 250, 252, 0.75);
}

.filter-card,
.featured-card {
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
}

.store-toolbar h2 {
    font-weight: 700;
}

.product-card {
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 30px rgba(15, 23, 42, 0.16);
}

.product-image {
    height: 200px;
    object-fit: cover;
}

.product-placeholder {
    height: 200px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

.source-badge {
    font-weight: 600;
    letter-spacing: 0.2px;
}

.product-price {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.price-old {
    text-decoration: line-through;
    color: #94a3b8;
    font-size: 14px;
}

.price-new {
    font-weight: 700;
    color: #0f172a;
}

@media (max-width: 768px) {
    .store-hero {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
@endsection
