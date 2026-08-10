@extends('layouts.redesign.dashboard')

@section('title', 'Security Products')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Security Products</h1>
            <p class="content-subtitle">Manage CCTV and security products</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Product</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/security/products') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" name="product_category" class="form-input" placeholder="cctv/access_control/alarm">
                </div>
                <div class="form-group">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="product_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Model</label>
                    <input type="text" name="model" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Datasheet URL</label>
                    <input type="text" name="datasheet_url" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Specifications (one per line)</label>
                    <textarea name="specifications" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Images</label>
                    <input type="file" name="images[]" class="form-input" multiple>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
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
                @foreach($products as $product)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $product->product_name }}</strong>
                            <span>{{ $product->product_category ?? 'General' }}</span>
                        </div>
                        <p class="item-desc">{{ $product->description ?? 'No description.' }}</p>

                        <form method="POST" action="{{ url('/user/security/products/' . $product->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <input type="text" name="product_category" class="form-input" value="{{ $product->product_category }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-input" value="{{ $product->product_name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Brand</label>
                                <input type="text" name="brand" class="form-input" value="{{ $product->brand }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Model</label>
                                <input type="text" name="model" class="form-input" value="{{ $product->model }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" class="form-input" value="{{ $product->price }}" step="0.01" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Datasheet URL</label>
                                <input type="text" name="datasheet_url" class="form-input" value="{{ $product->datasheet_url }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Specifications</label>
                                <textarea name="specifications" class="form-input" rows="2">{{ is_array($product->specifications) ? implode("\n", $product->specifications) : '' }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-input" rows="2">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/user/security/products/' . $product->id) }}" class="inline-form" onsubmit="return confirm('Delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .form-group.full-width { grid-column: 1 / -1; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; margin-top: 0.75rem; }
    .empty-state { color: var(--text-secondary); }
    .item-card { border: 1px solid var(--border-color); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem; }
    .item-header { display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.5rem; }
    .item-desc { color: var(--text-secondary); margin-bottom: 1rem; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
