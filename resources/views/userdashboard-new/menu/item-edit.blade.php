@extends('layouts.redesign.dashboard')

@section('title', 'Edit Menu Item')

@section('dashboard-content')
<div class="content-page">
    <!-- Page Header -->
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Edit Menu Item</h1>
            <p class="content-subtitle">Update item details</p>
        </div>
        <div class="content-header-right">
            <a href="{{ url('/mymenu/category/'.$item->category_id.'/items') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back to Items
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ url('/mymenu/item/'.$item->id.'/update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label class="form-label">Item Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $item->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $item->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="form-label">Price (₹) <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" step="0.01" min="0"
                               value="{{ old('price', $item->price) }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label">Dietary Type</label>
                        <select name="dietary_type" class="form-control">
                            <option value="veg" {{ $item->dietary_type == 'veg' ? 'selected' : '' }}>🌿 Vegetarian</option>
                            <option value="non-veg" {{ $item->dietary_type == 'non-veg' ? 'selected' : '' }}>🍗 Non-Vegetarian</option>
                            <option value="vegan" {{ $item->dietary_type == 'vegan' ? 'selected' : '' }}>🥬 Vegan</option>
                            <option value="eggetarian" {{ $item->dietary_type == 'eggetarian' ? 'selected' : '' }}>🥚 Eggetarian</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label">Spice Level</label>
                        <select name="spice_level" class="form-control">
                            <option value="">None</option>
                            <option value="mild" {{ $item->spice_level == 'mild' ? 'selected' : '' }}>🌶️ Mild</option>
                            <option value="medium" {{ $item->spice_level == 'medium' ? 'selected' : '' }}>🌶️🌶️ Medium</option>
                            <option value="hot" {{ $item->spice_level == 'hot' ? 'selected' : '' }}>🌶️🌶️🌶️ Hot</option>
                            <option value="extra_hot" {{ $item->spice_level == 'extra_hot' ? 'selected' : '' }}>🔥 Extra Hot</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Item Image</label>
                    @if($item->image)
                        <div class="current-image mb-2">
                            <img src="{{ url('uploads/menu/items/'.$item->image) }}" alt="{{ $item->name }}" style="max-width: 200px; border-radius: 0.5rem;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="form-text text-muted">Leave empty to keep current image</small>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="form-check">
                            <input type="checkbox" name="is_available" value="1" {{ $item->is_available ? 'checked' : '' }} class="form-check-input">
                            <span class="form-check-label">Available</span>
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-check">
                            <input type="checkbox" name="is_bestseller" value="1" {{ $item->is_bestseller ? 'checked' : '' }} class="form-check-input">
                            <span class="form-check-label">Mark as Bestseller</span>
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-check">
                            <input type="checkbox" name="is_chefs_special" value="1" {{ $item->is_chefs_special ? 'checked' : '' }} class="form-check-input">
                            <span class="form-check-label">Chef's Special</span>
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Item
                    </button>
                    <a href="{{ url('/mymenu/category/'.$item->category_id.'/items') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('userdashboard-new.partials.form-page-styles')

<style>
    .form-row {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .form-row .form-group {
        flex: 1;
        min-width: 200px;
    }
    .col-md-4 { flex: 0 0 calc(33.333% - 0.67rem); }
    .col-md-8 { flex: 0 0 calc(66.666% - 0.34rem); }
    @media (max-width: 768px) {
        .col-md-4, .col-md-8 { flex: 0 0 100%; }
    }
    .mb-2 { margin-bottom: 0.5rem; }
</style>
@endsection
