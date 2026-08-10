@extends('layouts.redesign.admin')

@section('page-title', 'Profession Themes')
@section('breadcrumb', 'Profession Themes')

@push('page-styles')
<style>
    .themes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: var(--space-lg);
    }

    .theme-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        overflow: hidden;
        transition: all var(--transition-fast);
    }

    .theme-card:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-lg);
    }

    .theme-preview {
        height: 160px;
        background: linear-gradient(135deg, var(--bg-tertiary), var(--bg-secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .theme-preview-icon {
        font-size: 3rem;
        color: var(--text-muted);
        opacity: 0.5;
    }

    .theme-badge {
        position: absolute;
        top: var(--space-sm);
        right: var(--space-sm);
        padding: var(--space-xs) var(--space-sm);
        border-radius: var(--radius-md);
        font-size: var(--text-xs);
        font-weight: var(--font-medium);
    }

    .theme-badge.active {
        background: rgba(16, 185, 129, 0.2);
        color: var(--green-500);
    }

    .theme-badge.inactive {
        background: rgba(239, 68, 68, 0.2);
        color: var(--red-500);
    }

    .theme-content {
        padding: var(--space-lg);
    }

    .theme-name {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-xs);
    }

    .theme-description {
        font-size: var(--text-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-md);
        line-height: 1.5;
    }

    .theme-stats {
        display: flex;
        gap: var(--space-lg);
        padding: var(--space-md) 0;
        border-top: 1px solid var(--card-border);
        border-bottom: 1px solid var(--card-border);
        margin-bottom: var(--space-md);
    }

    .theme-stat {
        text-align: center;
    }

    .theme-stat-value {
        font-size: var(--text-xl);
        font-weight: var(--font-bold);
        color: var(--primary-color);
    }

    .theme-stat-label {
        font-size: var(--text-xs);
        color: var(--text-muted);
    }

    .theme-actions {
        display: flex;
        gap: var(--space-sm);
    }

    .theme-actions .btn {
        flex: 1;
    }

    .stats-header {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-lg);
        margin-bottom: var(--space-xl);
    }

    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        display: flex;
        align-items: center;
        gap: var(--space-lg);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-2xl);
    }

    .stat-value {
        font-size: var(--text-3xl);
        font-weight: var(--font-bold);
    }

    .stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    @media (max-width: 768px) {
        .stats-header {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalThemes = $themes->count();
    $activeThemes = $themes->where('is_active', true)->count();
    $totalUsage = \App\Models\customer::whereNotNull('profession_type')->count() + \App\Models\Company::whereNotNull('profession_type')->count();
@endphp

<!-- Stats Header -->
<div class="stats-header">
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-palette"></i>
        </div>
        <div>
            <div class="stat-value">{{ $totalThemes }}</div>
            <div class="stat-label">Total Themes</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <div class="stat-value">{{ $activeThemes }}</div>
            <div class="stat-label">Active Themes</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--blue-500);">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <div class="stat-value">{{ $totalUsage }}</div>
            <div class="stat-label">Users Using Themes</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-lg);">
    <div>
        <h2 style="font-size: var(--text-xl); font-weight: var(--font-semibold);">All Profession Themes</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm);">Manage profile themes for different professions</p>
    </div>
</div>

<!-- Themes Grid -->
<div class="themes-grid">
    @foreach($themes as $theme)
    @php
        $customerUsage = \App\Models\customer::where('profession_type', $theme->id)->count();
        $companyUsage = \App\Models\Company::where('profession_type', $theme->id)->count();
        $totalThemeUsage = $customerUsage + $companyUsage;
    @endphp
    <div class="theme-card">
        <div class="theme-preview" style="background: linear-gradient(135deg, {{ $theme->color_scheme['primary'] ?? '#6366f1' }}20, {{ $theme->color_scheme['secondary'] ?? '#818cf8' }}20);">
            <i class="fas {{ $theme->icon ?? 'fa-palette' }} theme-preview-icon" style="color: {{ $theme->color_scheme['primary'] ?? '#6366f1' }};"></i>
            <span class="theme-badge {{ $theme->is_active ? 'active' : 'inactive' }}">
                {{ $theme->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="theme-content">
            <h3 class="theme-name">{{ $theme->name }}</h3>
            <p class="theme-description">{{ $theme->description ?? 'No description available' }}</p>

            <div class="theme-stats">
                <div class="theme-stat">
                    <div class="theme-stat-value">{{ $customerUsage }}</div>
                    <div class="theme-stat-label">Customers</div>
                </div>
                <div class="theme-stat">
                    <div class="theme-stat-value">{{ $companyUsage }}</div>
                    <div class="theme-stat-label">Companies</div>
                </div>
                <div class="theme-stat">
                    <div class="theme-stat-value">{{ $totalThemeUsage }}</div>
                    <div class="theme-stat-label">Total Users</div>
                </div>
            </div>

            <div class="theme-actions">
                <form action="{{ url('/admin/profession-themes/'.$theme->id.'/toggle') }}" method="POST" style="flex: 1;">
                    @csrf
                    <button type="submit" class="btn {{ $theme->is_active ? 'btn-outline' : 'btn-primary' }} btn-sm" style="width: 100%;">
                        <i class="fas {{ $theme->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        {{ $theme->is_active ? 'Disable' : 'Enable' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($themes->isEmpty())
<div style="text-align: center; padding: var(--space-3xl); color: var(--text-muted);">
    <i class="fas fa-palette" style="font-size: 4rem; margin-bottom: var(--space-lg); opacity: 0.3;"></i>
    <h3>No Themes Found</h3>
    <p>Run the ProfessionThemesSeeder to add the default themes.</p>
</div>
@endif

@endsection
