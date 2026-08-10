@extends('layouts.redesign.dashboard')

@section('title', 'Salon Products')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Salon Products</h1>
            <p class="content-subtitle">Manage retail product offerings</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Product</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/salon/products') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="product_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_available" value="1" checked>
                        <span>Available</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Products</h3>
        </div>
        <div class="card-body">
            @if($products->count() === 0)
                <p class="empty-state">No products added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Available</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->category ?? '-' }}</td>
                                <td>{{ $product->price ? number_format($product->price, 2) : '-' }}</td>
                                <td>{{ $product->is_available ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/salon/products/' . $product->id) }}" class="inline-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="product_name" class="form-input form-input-sm" value="{{ $product->product_name }}" required>
                                        <input type="text" name="category" class="form-input form-input-sm" value="{{ $product->category }}">
                                        <input type="number" name="price" class="form-input form-input-sm" value="{{ $product->price }}" step="0.01" min="0">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_available" value="1" {{ $product->is_available ? 'checked' : '' }}>
                                            <span>Available</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/salon/products/' . $product->id) }}" class="inline-form" onsubmit="return confirm('Delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .form-group.full-width { grid-column: 1 / -1; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; margin-right: 0.5rem; }
    .form-input-sm { max-width: 150px; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
