@extends('layouts.redesign.dashboard')

@section('page-title', 'My Portfolio')
@section('breadcrumb', 'Portfolio')

@section('dashboard-content')
<div class="portfolio-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Portfolio</h1>
            <p>Manage your portfolio categories and showcase your work</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('user.creative.portfolio.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Category
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="stats-row fade-up">
        @php
            $totalCategories = $categories ? (is_countable($categories) ? count($categories) : 0) : 0;
            $activeCategories = $categories ? $categories->where('is_active', true)->count() : 0;
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon purple">
                <i class="fas fa-folder"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalCategories }}</span>
                <span class="stat-mini-label">Total Categories</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $activeCategories }}</span>
                <span class="stat-mini-label">Active Categories</span>
            </div>
        </div>
    </div>

    @if($categories && count($categories) > 0)
        <div class="portfolio-grid stagger-animation">
            @foreach($categories as $category)
                <div class="portfolio-card fade-up">
                    <div class="portfolio-image">
                        @if($category->cover_image)
                            <img src="{{ asset('storage/' . $category->cover_image) }}" alt="{{ $category->name }}">
                        @else
                            <div class="portfolio-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        <div class="portfolio-overlay">
                            <div class="portfolio-status">
                                @if($category->is_active)
                                    <span class="status-badge active">
                                        <i class="fas fa-check-circle"></i> Active
                                    </span>
                                @else
                                    <span class="status-badge inactive">
                                        <i class="fas fa-times-circle"></i> Inactive
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-body">
                        <h4 class="portfolio-title">{{ $category->name }}</h4>
                        <div class="portfolio-slug">
                            <i class="fas fa-link"></i>
                            <span>{{ $category->slug }}</span>
                        </div>
                        @if($category->description)
                            <p class="portfolio-description">{{ Str::limit($category->description, 80) }}</p>
                        @endif
                        <div class="portfolio-meta">
                            <div class="meta-item">
                                <i class="fas fa-images"></i>
                                <span>{{ $category->images_count ?? 0 }} images</span>
                            </div>
                        </div>
                        <p class="portfolio-date">Created {{ $category->created_at ? $category->created_at->diffForHumans() : 'N/A' }}</p>
                    </div>
                    <div class="portfolio-actions">
                        <a href="{{ route('user.creative.portfolio.edit', $category->id) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('user.creative.portfolio.toggle-status', $category->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn {{ $category->is_active ? 'warning' : 'success' }}" title="{{ $category->is_active ? 'Deactivate' : 'Activate' }}">
                                <i class="fas fa-{{ $category->is_active ? 'eye-slash' : 'eye' }}"></i>
                            </button>
                        </form>
                        <form action="{{ route('user.creative.portfolio.destroy', $category->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <h3>No Portfolio Categories Yet</h3>
            <p>Create categories to organize and showcase your creative work.</p>
            <a href="{{ route('user.creative.portfolio.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Category
            </a>
        </div>
    @endif
</div>

<style>
.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.portfolio-card {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.portfolio-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.portfolio-image {
    position: relative;
    width: 100%;
    height: 220px;
    background: var(--bg-secondary);
    overflow: hidden;
}

.portfolio-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.portfolio-card:hover .portfolio-image img {
    transform: scale(1.05);
}

.portfolio-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    font-size: 3.5rem;
    background: linear-gradient(135deg, var(--bg-secondary), var(--bg-tertiary));
}

.portfolio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.3), transparent);
    padding: 1rem;
    display: flex;
    justify-content: flex-end;
    align-items: flex-start;
}

.portfolio-status .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.4rem 0.85rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

.status-badge.active {
    background: rgba(39, 174, 96, 0.9);
    color: white;
}

.status-badge.inactive {
    background: rgba(231, 76, 60, 0.9);
    color: white;
}

.portfolio-body {
    padding: 1.25rem;
    flex: 1;
}

.portfolio-title {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0 0 0.75rem;
}

.portfolio-slug {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    color: var(--text-muted);
    margin-bottom: 0.75rem;
    padding: 0.5rem;
    background: var(--bg-secondary);
    border-radius: 6px;
}

.portfolio-slug i {
    color: var(--primary-color);
}

.portfolio-description {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 1rem;
    line-height: 1.5;
}

.portfolio-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 0.75rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.meta-item i {
    color: var(--primary-color);
}

.portfolio-date {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin: 0;
}

.portfolio-actions {
    display: flex;
    border-top: 1px solid var(--border-color);
    padding: 0.75rem 1.25rem;
    gap: 0.5rem;
    justify-content: flex-end;
}

.stat-mini-icon.purple {
    background: linear-gradient(135deg, #667eea, #764ba2);
}

@media (max-width: 576px) {
    .portfolio-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@include('userdashboard-new.partials.content-page-styles')
@endsection
