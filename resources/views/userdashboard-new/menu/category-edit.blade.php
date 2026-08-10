@extends('layouts.redesign.dashboard')

@section('title', 'Edit Menu Category')

@section('dashboard-content')
<div class="content-page">
    <!-- Page Header -->
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Edit Menu Category</h1>
            <p class="content-subtitle">Update category details</p>
        </div>
        <div class="content-header-right">
            <a href="{{ url('/mymenu') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back to Menu
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ url('/mymenu/category/'.$category->id.'/update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Icon</label>
                    <select name="icon" class="form-control">
                        <option value="fa-utensils" {{ $category->icon == 'fa-utensils' ? 'selected' : '' }}>🍽️ Utensils</option>
                        <option value="fa-hamburger" {{ $category->icon == 'fa-hamburger' ? 'selected' : '' }}>🍔 Burger</option>
                        <option value="fa-pizza-slice" {{ $category->icon == 'fa-pizza-slice' ? 'selected' : '' }}>🍕 Pizza</option>
                        <option value="fa-fish" {{ $category->icon == 'fa-fish' ? 'selected' : '' }}>🐟 Fish</option>
                        <option value="fa-drumstick-bite" {{ $category->icon == 'fa-drumstick-bite' ? 'selected' : '' }}>🍗 Chicken</option>
                        <option value="fa-leaf" {{ $category->icon == 'fa-leaf' ? 'selected' : '' }}>🌿 Vegetarian</option>
                        <option value="fa-mug-hot" {{ $category->icon == 'fa-mug-hot' ? 'selected' : '' }}>☕ Hot Drinks</option>
                        <option value="fa-wine-glass" {{ $category->icon == 'fa-wine-glass' ? 'selected' : '' }}>🍷 Wine</option>
                        <option value="fa-glass-martini" {{ $category->icon == 'fa-glass-martini' ? 'selected' : '' }}>🍸 Cocktails</option>
                        <option value="fa-ice-cream" {{ $category->icon == 'fa-ice-cream' ? 'selected' : '' }}>🍦 Desserts</option>
                        <option value="fa-bread-slice" {{ $category->icon == 'fa-bread-slice' ? 'selected' : '' }}>🍞 Bread</option>
                        <option value="fa-bowl-rice" {{ $category->icon == 'fa-bowl-rice' ? 'selected' : '' }}>🍚 Rice</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Category Image</label>
                    @if($category->image)
                        <div class="current-image mb-2">
                            <img src="{{ url('uploads/menu/categories/'.$category->image) }}" alt="{{ $category->name }}" style="max-width: 200px; border-radius: 0.5rem;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="form-text text-muted">Leave empty to keep current image</small>
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" {{ $category->status ? 'checked' : '' }} class="form-check-input">
                        <span class="form-check-label">Active (visible on profile)</span>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Category
                    </button>
                    <a href="{{ url('/mymenu') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('userdashboard-new.partials.form-page-styles')
@endsection
