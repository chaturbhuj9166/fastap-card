@extends('layouts.redesign.dashboard')

@section('title', 'Add Menu Category')

@section('dashboard-content')
<div class="content-page">
    <!-- Page Header -->
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Add Menu Category</h1>
            <p class="content-subtitle">Create a new category for your menu items</p>
        </div>
        <div class="content-header-right">
            <a href="{{ url('/mymenu') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back to Menu
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ url('/mymenu/category/store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="e.g., Starters, Main Course, Beverages" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"
                              placeholder="Brief description of this category">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Icon</label>
                    <select name="icon" class="form-control">
                        <option value="fa-utensils" {{ old('icon') == 'fa-utensils' ? 'selected' : '' }}>🍽️ Utensils</option>
                        <option value="fa-hamburger" {{ old('icon') == 'fa-hamburger' ? 'selected' : '' }}>🍔 Burger</option>
                        <option value="fa-pizza-slice" {{ old('icon') == 'fa-pizza-slice' ? 'selected' : '' }}>🍕 Pizza</option>
                        <option value="fa-fish" {{ old('icon') == 'fa-fish' ? 'selected' : '' }}>🐟 Fish</option>
                        <option value="fa-drumstick-bite" {{ old('icon') == 'fa-drumstick-bite' ? 'selected' : '' }}>🍗 Chicken</option>
                        <option value="fa-leaf" {{ old('icon') == 'fa-leaf' ? 'selected' : '' }}>🌿 Vegetarian</option>
                        <option value="fa-mug-hot" {{ old('icon') == 'fa-mug-hot' ? 'selected' : '' }}>☕ Hot Drinks</option>
                        <option value="fa-wine-glass" {{ old('icon') == 'fa-wine-glass' ? 'selected' : '' }}>🍷 Wine</option>
                        <option value="fa-glass-martini" {{ old('icon') == 'fa-glass-martini' ? 'selected' : '' }}>🍸 Cocktails</option>
                        <option value="fa-ice-cream" {{ old('icon') == 'fa-ice-cream' ? 'selected' : '' }}>🍦 Desserts</option>
                        <option value="fa-bread-slice" {{ old('icon') == 'fa-bread-slice' ? 'selected' : '' }}>🍞 Bread</option>
                        <option value="fa-bowl-rice" {{ old('icon') == 'fa-bowl-rice' ? 'selected' : '' }}>🍚 Rice</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Category Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="form-text text-muted">Optional. Recommended size: 400x300px</small>
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" checked class="form-check-input">
                        <span class="form-check-label">Active (visible on profile)</span>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Category
                    </button>
                    <a href="{{ url('/mymenu') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('userdashboard-new.partials.form-page-styles')
@endsection
