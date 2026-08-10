@extends('layouts.redesign.dashboard')

@section('title', 'Add Menu Item')

@section('dashboard-content')
<div class="content-page">
    <!-- Page Header -->
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Add Menu Item</h1>
            <p class="content-subtitle">Add a new item to your menu</p>
        </div>
        <div class="content-header-right">
            <a href="{{ url('/mymenu') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back to Menu
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ url('/mymenu/item/store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label class="form-label">Item Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="e.g., Chicken Biryani" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"
                              placeholder="Describe this item...">{{ old('description') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="form-label">Price (₹) <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" step="0.01" min="0"
                               value="{{ old('price') }}" placeholder="0.00" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label">Dietary Type</label>
                        <select name="dietary_type" class="form-control">
                            <option value="veg" {{ old('dietary_type') == 'veg' ? 'selected' : '' }}>🌿 Vegetarian</option>
                            <option value="non-veg" {{ old('dietary_type') == 'non-veg' ? 'selected' : '' }}>🍗 Non-Vegetarian</option>
                            <option value="vegan" {{ old('dietary_type') == 'vegan' ? 'selected' : '' }}>🥬 Vegan</option>
                            <option value="eggetarian" {{ old('dietary_type') == 'eggetarian' ? 'selected' : '' }}>🥚 Eggetarian</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label">Spice Level</label>
                        <select name="spice_level" class="form-control">
                            <option value="">None</option>
                            <option value="mild" {{ old('spice_level') == 'mild' ? 'selected' : '' }}>🌶️ Mild</option>
                            <option value="medium" {{ old('spice_level') == 'medium' ? 'selected' : '' }}>🌶️🌶️ Medium</option>
                            <option value="hot" {{ old('spice_level') == 'hot' ? 'selected' : '' }}>🌶️🌶️🌶️ Hot</option>
                            <option value="extra_hot" {{ old('spice_level') == 'extra_hot' ? 'selected' : '' }}>🔥 Extra Hot</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Item Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="form-text text-muted">Recommended size: 600x400px</small>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="form-check">
                            <input type="checkbox" name="is_available" value="1" checked class="form-check-input">
                            <span class="form-check-label">Available</span>
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-check">
                            <input type="checkbox" name="is_bestseller" value="1" class="form-check-input">
                            <span class="form-check-label">Mark as Bestseller</span>
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-check">
                            <input type="checkbox" name="is_chefs_special" value="1" class="form-check-input">
                            <span class="form-check-label">Chef's Special</span>
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Item
                    </button>
                    <a href="{{ url('/mymenu') }}" class="btn btn-outline">Cancel</a>
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
</style>
@endsection
