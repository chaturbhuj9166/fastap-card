@extends('admin-new.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Pending Products Approval</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Products
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Seller</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Submitted</th>
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
                                <small class="text-muted">{{ $product->category->name ?? 'No Category' }}</small><br>
                                @if($product->description)
                                    <small class="text-muted">{{ Str::limit($product->description, 60) }}</small>
                                @endif
                            </td>
                            <td>
                                @if($product->user)
                                    <strong>{{ $product->user->name }}</strong><br>
                                    <small class="text-muted">{{ $product->user->email }}</small>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($product->sale_price)
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
                            <td>{{ $product->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <form action="{{ route('admin.products.approve', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this product?')">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.products.reject', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject this product?')">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">No pending products</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
