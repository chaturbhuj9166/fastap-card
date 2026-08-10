@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6 mb-4">
            <div class="product-images">
                @if($product->images && count($product->images) > 0)
                    <div class="main-image mb-3">
                        <img id="mainProductImage" src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="width: 100%; height: 500px; object-fit: cover;">
                    </div>

                    @if(count($product->images) > 1)
                    <div class="thumbnail-images d-flex gap-2 overflow-auto">
                        @foreach($product->images as $index => $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;" onclick="changeMainImage('{{ asset('storage/' . $image) }}')">
                        @endforeach
                    </div>
                    @endif
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 500px;">
                        <div class="text-center text-muted">
                            <i class="fas fa-image fa-5x mb-3"></i>
                            <p>No Image Available</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
            <div class="product-details">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('store.index') }}">Store</a></li>
                        @if($product->category)
                            <li class="breadcrumb-item"><a href="{{ route('store.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                        @endif
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
                    </ol>
                </nav>

                <!-- Product Title -->
                <h1 class="mb-3">{{ $product->name }}</h1>

                <!-- Source Badge -->
                <div class="mb-3">
                    @if($product->isAdminProduct())
                        <span class="badge bg-primary fs-6"><i class="fas fa-shield-alt"></i> Official Fastap Product</span>
                    @else
                        <span class="badge bg-success fs-6"><i class="fas fa-store"></i> Sold by: {{ $product->user->name ?? 'Seller' }}</span>
                        @if($product->user)
                            <a href="{{ route('store.seller', $product->user->id) }}" class="btn btn-sm btn-outline-primary ms-2">View Seller Profile</a>
                        @endif
                    @endif

                    @if($product->is_featured)
                        <span class="badge bg-warning text-dark ms-2"><i class="fas fa-star"></i> Featured</span>
                    @endif
                </div>

                <!-- Price -->
                <div class="price-section mb-4">
                    @if($product->isOnSale())
                        <div class="d-flex align-items-center gap-3">
                            <h2 class="text-danger mb-0">₹{{ number_format($product->sale_price, 2) }}</h2>
                            <span class="text-decoration-line-through text-muted fs-4">₹{{ number_format($product->price, 2) }}</span>
                            <span class="badge bg-danger fs-6">Save {{ $product->getDiscountPercentage() }}%</span>
                        </div>
                    @else
                        <h2 class="text-primary mb-0">₹{{ number_format($product->price, 2) }}</h2>
                    @endif
                </div>

                <!-- Stock Status -->
                <div class="stock-status mb-4">
                    @if($product->stock_quantity > 0)
                        <span class="badge bg-success fs-6"><i class="fas fa-check-circle"></i> In Stock ({{ $product->stock_quantity }} available)</span>
                    @else
                        <span class="badge bg-danger fs-6"><i class="fas fa-times-circle"></i> Out of Stock</span>
                    @endif
                </div>

                <!-- Product Type & Category -->
                <div class="product-meta mb-4">
                    <p class="mb-2"><strong>Type:</strong> <span class="badge bg-info">{{ ucfirst($product->type) }}</span></p>
                    @if($product->category)
                        <p class="mb-2"><strong>Category:</strong> <a href="{{ route('store.category', $product->category->slug) }}" class="text-decoration-none">{{ $product->category->name }}</a></p>
                    @endif
                    @if($product->sku)
                        <p class="mb-0"><strong>SKU:</strong> {{ $product->sku }}</p>
                    @endif
                </div>

                <!-- Description -->
                @if($product->description)
                <div class="product-description mb-4">
                    <h4>Description</h4>
                    <p class="text-muted">{{ $product->description }}</p>
                </div>
                @endif

                <!-- Contact/Order Buttons -->
                <div class="action-buttons d-grid gap-2">
                    @if($product->stock_quantity > 0)
                        @if($product->user)
                            <a href="https://wa.me/{{ $product->user->mobile ?? '' }}?text=Hi, I'm interested in {{ $product->name }}" class="btn btn-success btn-lg" target="_blank">
                                <i class="fab fa-whatsapp"></i> Contact Seller on WhatsApp
                            </a>
                            @if($product->user->email)
                                <a href="mailto:{{ $product->user->email }}?subject=Inquiry about {{ $product->name }}" class="btn btn-outline-primary btn-lg">
                                    <i class="fas fa-envelope"></i> Email Seller
                                </a>
                            @endif
                        @else
                            <a href="https://wa.me/?text=I'm interested in {{ $product->name }} from Fastap Store" class="btn btn-success btn-lg" target="_blank">
                                <i class="fab fa-whatsapp"></i> Inquire via WhatsApp
                            </a>
                        @endif
                    @else
                        <button class="btn btn-secondary btn-lg" disabled>Out of Stock</button>
                    @endif

                    <button class="btn btn-outline-secondary btn-lg" onclick="shareProduct()">
                        <i class="fas fa-share-alt"></i> Share Product
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="related-products mt-5">
        <h3 class="mb-4">Related Products</h3>
        <div class="row">
            @foreach($relatedProducts as $related)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($related->images && count($related->images) > 0)
                        <img src="{{ asset('storage/' . $related->images[0]) }}" class="card-img-top" alt="{{ $related->name }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ Str::limit($related->name, 40) }}</h6>
                        <p class="text-primary fw-bold mb-0">₹{{ number_format($related->getFinalPrice(), 2) }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('store.show', $related->slug) }}" class="btn btn-sm btn-outline-primary w-100">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- More from Seller -->
    @if(isset($sellerProducts) && $sellerProducts->count() > 0)
    <div class="seller-products mt-5">
        <h3 class="mb-4">More from {{ $product->user->name ?? 'This Seller' }}</h3>
        <div class="row">
            @foreach($sellerProducts as $sellerProduct)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($sellerProduct->images && count($sellerProduct->images) > 0)
                        <img src="{{ asset('storage/' . $sellerProduct->images[0]) }}" class="card-img-top" alt="{{ $sellerProduct->name }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ Str::limit($sellerProduct->name, 40) }}</h6>
                        <p class="text-primary fw-bold mb-0">₹{{ number_format($sellerProduct->getFinalPrice(), 2) }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('store.show', $sellerProduct->slug) }}" class="btn btn-sm btn-outline-primary w-100">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
function changeMainImage(src) {
    document.getElementById('mainProductImage').src = src;
}

function shareProduct() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $product->name }}',
            text: 'Check out this product on Fastap Store',
            url: window.location.href
        });
    } else {
        // Fallback: Copy link
        navigator.clipboard.writeText(window.location.href);
        alert('Product link copied to clipboard!');
    }
}
</script>
@endsection
