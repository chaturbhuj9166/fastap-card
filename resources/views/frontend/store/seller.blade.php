@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <!-- Seller Header -->
    <div class="seller-header bg-light p-4 rounded mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">{{ $seller->name }}</h1>
                @if($seller->email)
                    <p class="text-muted mb-2"><i class="fas fa-envelope"></i> {{ $seller->email }}</p>
                @endif
                @if($seller->mobile)
                    <p class="text-muted mb-2"><i class="fas fa-phone"></i> {{ $seller->mobile }}</p>
                @endif
                @if($storeSetting)
                    <p class="mb-0"><span class="badge bg-success">Verified Seller</span></p>
                @endif
            </div>
            <div class="col-md-4 text-md-end">
                @if($seller->mobile)
                    <a href="https://wa.me/{{ $seller->mobile }}" class="btn btn-success mb-2" target="_blank">
                        <i class="fab fa-whatsapp"></i> Contact on WhatsApp
                    </a>
                @endif
                @if($seller->slug)
                    <a href="/{{ $seller->slug }}" class="btn btn-primary mb-2">
                        <i class="fas fa-user"></i> View Profile
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="seller-products">
        <h3 class="mb-4">Products by {{ $seller->name }} ({{ $products->total() }})</h3>

        @if($products->count() > 0)
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        @if($product->images && count($product->images) > 0)
                            <img src="{{ asset('storage/' . $product->images[0]) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span class="text-muted">No Image</span>
                            </div>
                        @endif

                        <div class="card-body">
                            <h6 class="card-title">{{ Str::limit($product->name, 40) }}</h6>

                            <div class="mb-2">
                                @if($product->isOnSale())
                                    <span class="text-decoration-line-through text-muted small">₹{{ number_format($product->price, 2) }}</span><br>
                                    <span class="text-danger fw-bold">₹{{ number_format($product->sale_price, 2) }}</span>
                                    <span class="badge bg-danger small">-{{ $product->getDiscountPercentage() }}%</span>
                                @else
                                    <span class="fw-bold">₹{{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>

                            @if($product->category)
                                <small class="text-muted">{{ $product->category->name }}</small>
                            @endif
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('store.show', $product->slug) }}" class="btn btn-sm btn-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @else
            <div class="alert alert-info">This seller has no products listed yet.</div>
        @endif
    </div>
</div>
@endsection
