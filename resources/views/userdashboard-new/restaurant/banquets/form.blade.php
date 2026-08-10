@extends('layouts.redesign.dashboard')

@section('title', $banquet ? 'Edit Banquet Hall' : 'Add Banquet Hall')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">{{ $banquet ? 'Edit Banquet Hall' : 'Add Banquet Hall' }}</h1>
            <p class="content-subtitle">Manage banquet details and pricing</p>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">Please fix the errors and try again.</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ $banquet ? url('/user/restaurant/banquets/' . $banquet->id) : url('/user/restaurant/banquets') }}" class="form-grid">
                @csrf
                @if($banquet)
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label class="form-label">Hall Name</label>
                    <input type="text" name="hall_name" class="form-input" value="{{ old('hall_name', $banquet->hall_name ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Capacity Min</label>
                    <input type="number" name="capacity_min" class="form-input" min="0" value="{{ old('capacity_min', $banquet->capacity_min ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Capacity Max</label>
                    <input type="number" name="capacity_max" class="form-input" min="0" value="{{ old('capacity_max', $banquet->capacity_max ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Hall Type</label>
                    <input type="text" name="hall_type" class="form-input" value="{{ old('hall_type', $banquet->hall_type ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Size (sqft)</label>
                    <input type="number" name="size_sqft" class="form-input" min="0" value="{{ old('size_sqft', $banquet->size_sqft ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Price Per Plate</label>
                    <input type="number" name="price_per_plate" class="form-input" min="0" step="0.01" value="{{ old('price_per_plate', $banquet->price_per_plate ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Price Per Day</label>
                    <input type="number" name="price_per_day" class="form-input" min="0" step="0.01" value="{{ old('price_per_day', $banquet->price_per_day ?? '') }}">
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $banquet->is_active ?? true) ? 'checked' : '' }}>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">{{ $banquet ? 'Update' : 'Create' }}</button>
                    <a href="{{ url('/user/restaurant/banquets') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; gap: 0.75rem; }
    .checkbox-label { display: inline-flex; align-items: center; gap: 0.4rem; }
    .btn-primary { background: #0891b2; color: #fff; border: none; padding: 0.6rem 1.2rem; border-radius: 0.5rem; }
    .btn-outline { border: 1px solid var(--border-color); padding: 0.6rem 1.2rem; border-radius: 0.5rem; }
    .alert { padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .alert-danger { background: #fee2e2; color: #991b1b; }
</style>
@endsection
