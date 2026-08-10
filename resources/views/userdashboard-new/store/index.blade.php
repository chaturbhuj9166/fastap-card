@extends('userdashboard-new.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>My Products</h1>
            <p class="text-muted mb-0">
                <strong>{{ $products->total() }}</strong> of <strong>{{ $storeSetting->product_limit }}</strong> products used
            </p>
        </div>
        <div>
            @if($storeSetting->canAddProducts())
                <a href="{{ route('user.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Product
                </a>
            @else
                <button class="btn btn-secondary" disabled>
                    <i class="fas fa-exclamation-circle"></i> Product Limit Reached
                </button>
            @endif
        </div>
    </div>

    @if(!$storeSetting->auto_approve)
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> Your products require admin approval before appearing in the store.
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->images && count($product->images) > 0)
                                    <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $product->name }}</strong><br>
                                <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                            </td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>
                                @if($product->isOnSale())
                                    <span class="text-decoration-line-through text-muted small">₹{{ number_format($product->price, 2) }}</span><br>
                                    <span class="text-danger fw-bold">₹{{ number_format($product->sale_price, 2) }}</span>
                                @else
                                    ₹{{ number_format($product->price, 2) }}
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $product->stock_quantity > 0 ? 'success' : 'danger' }}">
                                    {{ $product->stock_quantity }}
                                </span>
                            </td>
                            <td>
                                @if($product->status == 'pending')
                                    <span class="badge bg-warning">Pending Approval</span>
                                @elseif($product->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($product->status == 'inactive')
                                    <span class="badge bg-secondary">Inactive</span>
                                @else
                                    <span class="badge bg-danger">Out of Stock</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    @if($product->status == 'active')
                                        <a href="{{ route('store.show', $product->slug) }}" class="btn btn-sm btn-success" target="_blank" title="View on Store">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('user.products.edit', $product->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('user.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-3">You haven't added any products yet</p>
                                @if($storeSetting->canAddProducts())
                                    <a href="{{ route('user.products.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Your First Product
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
