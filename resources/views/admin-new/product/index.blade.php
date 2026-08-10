@extends('layouts.redesign.admin')

@section('page-title', 'Products')
@section('breadcrumb', 'Products')

@push('page-styles')
<style>
    .product-image-cell {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-md);
        object-fit: cover;
        background: var(--bg-secondary);
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .product-name {
        font-weight: var(--font-medium);
        color: var(--text-primary);
    }

    .product-category {
        font-size: var(--text-xs);
        color: var(--text-muted);
    }

    .product-price {
        font-weight: var(--font-semibold);
    }

    .product-price-original {
        text-decoration: line-through;
        color: var(--text-muted);
        font-size: var(--text-sm);
        margin-left: var(--space-xs);
    }

    .stock-badge {
        padding: 0.25rem 0.75rem;
        border-radius: var(--radius-full);
        font-size: var(--text-xs);
        font-weight: var(--font-medium);
    }

    .stock-in {
        background: rgba(16, 185, 129, 0.1);
        color: var(--green-500);
    }

    .stock-low {
        background: rgba(249, 115, 22, 0.1);
        color: var(--orange-500);
    }

    .stock-out {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
</style>
@endpush

@section('admin-content')
<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">All Products</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage your product catalog</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/admin/add-product') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>
</div>

<!-- Products Table -->
<div class="table-container">
    <div class="table-header">
        <div class="table-search">
            <i class="fas fa-search"></i>
            <input type="text" id="productSearch" placeholder="Search products...">
        </div>
        <div class="table-actions">
            <select style="padding: 0.5rem 1rem; border: 1px solid var(--border-light); border-radius: var(--radius-md); background: var(--bg-primary); font-size: var(--text-sm);">
                <option value="">All Categories</option>
                @foreach(DB::table('categories')->get() as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="data-table" id="productsTable">
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products ?? [] as $product)
            <tr>
                <td>
                    <div class="product-info">
                        <img src="{{ $product->product_image ? asset('uploads/products/'.$product->product_image) : asset('assets/images/placeholder.png') }}"
                             alt="{{ $product->product_name }}"
                             class="product-image-cell">
                        <div>
                            <div class="product-name">{{ Str::limit($product->product_name, 40) }}</div>
                            <div class="product-category">SKU: {{ $product->sku ?? 'N/A' }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    @php
                        $category = DB::table('categories')->where('id', $product->category_id)->first();
                    @endphp
                    {{ $category->category_name ?? 'Uncategorized' }}
                </td>
                <td>
                    <span class="product-price">₹{{ number_format($product->sale_price ?? $product->regular_price ?? 0) }}</span>
                    @if(isset($product->regular_price) && isset($product->sale_price) && $product->regular_price > $product->sale_price)
                        <span class="product-price-original">₹{{ number_format($product->regular_price) }}</span>
                    @endif
                </td>
                <td>
                    @php
                        $stock = $product->stock ?? $product->quantity ?? 0;
                        $stockClass = 'stock-in';
                        $stockText = 'In Stock';
                        if($stock <= 0) {
                            $stockClass = 'stock-out';
                            $stockText = 'Out of Stock';
                        } elseif($stock <= 10) {
                            $stockClass = 'stock-low';
                            $stockText = 'Low Stock';
                        }
                    @endphp
                    <span class="stock-badge {{ $stockClass }}">{{ $stockText }} ({{ $stock }})</span>
                </td>
                <td>
                    <span class="status-badge {{ ($product->status ?? 1) == 1 ? 'status-active' : 'status-inactive' }}">
                        {{ ($product->status ?? 1) == 1 ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="table-action-btns">
                        <a href="{{ url('/admin/view-singal-product/'.$product->id) }}" class="table-action-btn view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ url('/admin/update_product/'.$product->id) }}" class="table-action-btn edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="table-action-btn delete" title="Delete" onclick="confirmDelete({{ $product->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h3 class="empty-state-title">No Products Yet</h3>
                        <p class="empty-state-text">Start by adding your first product to the catalog.</p>
                        <a href="{{ url('/admin/add-product') }}" class="btn btn-primary">Add Product</a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if(isset($products) && method_exists($products, 'hasPages') && $products->hasPages())
    <div class="table-footer">
        <div class="table-info">
            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products
        </div>
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="modal modal-sm" id="deleteModal">
    <div class="modal-header">
        <h3 class="modal-title">Delete Product</h3>
        <button class="modal-close" onclick="closeModal('deleteModal')">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="modal-body">
        <p>Are you sure you want to delete this product? This action cannot be undone.</p>
    </div>
    <div class="modal-footer">
        <button class="btn btn-ghost" onclick="closeModal('deleteModal')">Cancel</button>
        <form id="deleteForm" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>

@push('page-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search
    const searchInput = document.getElementById('productSearch');
    const tableRows = document.querySelectorAll('#productsTable tbody tr');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
});

function confirmDelete(productId) {
    document.getElementById('deleteForm').action = '/admin/delete-product/' + productId;
    document.getElementById('deleteModal').classList.add('active');
    document.querySelector('.modal-backdrop').classList.add('active');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
    document.querySelector('.modal-backdrop').classList.remove('active');
}
</script>
@endpush
@endsection
