@extends('layouts.redesign.admin')

@section('page-title', 'Brand Logos')
@section('breadcrumb', 'Brand Logos')

@push('page-styles')
<style>
    .brand-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .brand-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .brand-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .brand-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .brand-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .brand-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: var(--space-lg);
    }

    .brand-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        overflow: hidden;
        transition: transform var(--transition-fast), box-shadow var(--transition-fast);
    }

    .brand-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .brand-logo-wrapper {
        height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-secondary);
        padding: var(--space-md);
    }

    .brand-logo {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .brand-content {
        padding: var(--space-lg);
    }

    .brand-title {
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-md);
    }

    .brand-actions {
        display: flex;
        gap: var(--space-sm);
    }

    @media (max-width: 768px) {
        .brand-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalBrands = DB::table('brand_logo')->count();
@endphp

<!-- Brand Stats -->
<div class="brand-stats">
    <div class="brand-stat-card">
        <div class="brand-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-images"></i>
        </div>
        <div>
            <div class="brand-stat-value">{{ number_format($totalBrands) }}</div>
            <div class="brand-stat-label">Total Brand Logos</div>
        </div>
    </div>
    <div class="brand-stat-card">
        <div class="brand-stat-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--blue-500);">
            <i class="fas fa-eye"></i>
        </div>
        <div>
            <div class="brand-stat-value">{{ count($logo) }}</div>
            <div class="brand-stat-label">Displayed on Website</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">Brand Logos</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage partner and brand logos for your website</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/admin/add-logo') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Logo
        </a>
    </div>
</div>

@if(count($logo) > 0)
<!-- Brand Grid -->
<div class="brand-grid">
    @foreach($logo as $brand)
    <div class="brand-card">
        <div class="brand-logo-wrapper">
            @if($brand->logo)
                <img src="{{ url('uploads/product_images/' . $brand->logo) }}" alt="{{ $brand->title }}" class="brand-logo">
            @else
                <i class="fas fa-image" style="font-size: 3rem; color: var(--text-muted);"></i>
            @endif
        </div>
        <div class="brand-content">
            <h3 class="brand-title">{{ $brand->title }}</h3>
            <div class="brand-actions">
                <a href="{{ url('/admin/brand_logo_update' . $brand->id) }}" class="btn btn-secondary btn-sm" style="flex: 1;">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ url('/admin/brand_logo_delete' . $brand->id) }}" class="btn btn-danger btn-sm" style="flex: 1;" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-trash"></i> Delete
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
@if($logo->hasPages())
<div style="margin-top: var(--space-lg); display: flex; justify-content: center;">
    {{ $logo->links() }}
</div>
@endif
@else
<div style="text-align: center; padding: var(--space-3xl); background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl);">
    <i class="fas fa-images" style="font-size: 4rem; color: var(--text-muted); margin-bottom: var(--space-lg);"></i>
    <h3 style="color: var(--text-primary); margin-bottom: var(--space-sm);">No Brand Logos Yet</h3>
    <p style="color: var(--text-muted); margin-bottom: var(--space-lg);">Add partner and brand logos to showcase on your website</p>
    <a href="{{ url('/admin/add-logo') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add First Logo
    </a>
</div>
@endif

@endsection
