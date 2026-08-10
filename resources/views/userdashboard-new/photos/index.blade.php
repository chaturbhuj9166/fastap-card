@extends('layouts.redesign.dashboard')

@section('page-title', 'My Photos')
@section('breadcrumb', 'Photos')

@section('dashboard-content')
<div class="photos-page">
    {{-- Page Header --}}
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Photos</h1>
            <p>Manage your portfolio and gallery images</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/addportfolio') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Photos
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    {{-- Stats --}}
    <div class="photos-stats fade-up">
        @php
            $totalPhotos = $portfolios ? $portfolios->count() : 0;
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon purple">
                <i class="fas fa-images"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalPhotos }}</span>
                <span class="stat-mini-label">Total Albums</span>
            </div>
        </div>
    </div>

    {{-- Photos Grid --}}
    @if($portfolios && $portfolios->count() > 0)
        <div class="photos-grid stagger-animation">
            @foreach($portfolios as $portfolio)
                <div class="photo-card fade-up">
                    <div class="photo-card-image">
                        @php
                            $images = is_string($portfolio->image) ? json_decode($portfolio->image, true) : $portfolio->image;
                            $firstImage = is_array($images) && count($images) > 0 ? $images[0] : $portfolio->image;
                        @endphp
                        @if($firstImage)
                            <img src="{{ asset('public/frontend/portfolio/' . $firstImage) }}" alt="{{ $portfolio->title }}">
                        @else
                            <div class="photo-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        @if(is_array($images) && count($images) > 1)
                            <span class="photo-count">
                                <i class="fas fa-images"></i> {{ count($images) }}
                            </span>
                        @endif
                    </div>
                    <div class="photo-card-body">
                        <h4 class="photo-title">{{ $portfolio->title ?? 'Untitled Album' }}</h4>
                        <p class="photo-date">Added {{ $portfolio->created_at ? $portfolio->created_at->diffForHumans() : 'N/A' }}</p>
                    </div>
                    <div class="photo-card-actions">
                        <a href="{{ url('/editportfolio' . $portfolio->id) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('/deleteportfolio' . $portfolio->id) }}" class="action-btn danger" title="Delete" onclick="return confirm('Are you sure you want to delete this album?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-images"></i>
            </div>
            <h3>No Photos Yet</h3>
            <p>Start building your portfolio by adding your first photo album.</p>
            <a href="{{ url('/addportfolio') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Photos
            </a>
        </div>
    @endif
</div>

<style>
.photos-page {
    padding: var(--space-lg);
}

/* Page Header */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: var(--space-xl);
    flex-wrap: wrap;
    gap: var(--space-md);
}

.page-header-content h1 {
    font-size: var(--text-2xl);
    font-weight: var(--font-bold);
    margin-bottom: var(--space-xs);
}

.page-header-content p {
    color: var(--text-secondary);
}

/* Stats */
.photos-stats {
    margin-bottom: var(--space-xl);
}

.stat-mini-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    padding: var(--space-lg);
    display: inline-flex;
    align-items: center;
    gap: var(--space-md);
}

.stat-mini-icon {
    width: 45px;
    height: 45px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-lg);
}

.stat-mini-icon.purple {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%);
    color: var(--purple-500);
}

.stat-mini-info {
    display: flex;
    flex-direction: column;
}

.stat-mini-value {
    font-size: var(--text-xl);
    font-weight: var(--font-bold);
    color: var(--text-primary);
}

.stat-mini-label {
    font-size: var(--text-xs);
    color: var(--text-muted);
}

/* Photos Grid */
.photos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: var(--space-lg);
}

/* Photo Card */
.photo-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: all var(--transition-base);
}

.photo-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.photo-card-image {
    position: relative;
    aspect-ratio: 4/3;
    background: var(--bg-secondary);
    overflow: hidden;
}

.photo-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-base);
}

.photo-card:hover .photo-card-image img {
    transform: scale(1.05);
}

.photo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-4xl);
    color: var(--text-muted);
}

.photo-count {
    position: absolute;
    top: var(--space-sm);
    right: var(--space-sm);
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 4px 10px;
    border-radius: var(--radius-full);
    font-size: var(--text-xs);
    font-weight: var(--font-medium);
    display: flex;
    align-items: center;
    gap: 4px;
}

.photo-card-body {
    padding: var(--space-md);
}

.photo-title {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    margin-bottom: var(--space-xs);
    color: var(--text-primary);
}

.photo-date {
    font-size: var(--text-xs);
    color: var(--text-muted);
    margin: 0;
}

.photo-card-actions {
    display: flex;
    gap: var(--space-xs);
    padding: 0 var(--space-md) var(--space-md);
}

.action-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-sm);
    background: var(--bg-secondary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-md);
    color: var(--text-secondary);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.action-btn:hover {
    background: var(--purple-500);
    border-color: var(--purple-500);
    color: white;
}

.action-btn.danger:hover {
    background: var(--red-500);
    border-color: var(--red-500);
}

/* Empty State */
.empty-state {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    text-align: center;
    padding: var(--space-3xl);
}

.empty-state-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto var(--space-lg);
    background: var(--bg-secondary);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-3xl);
    color: var(--text-muted);
}

.empty-state h3 {
    font-size: var(--text-xl);
    margin-bottom: var(--space-sm);
}

.empty-state p {
    color: var(--text-secondary);
    margin-bottom: var(--space-lg);
}

/* Responsive */
@media (max-width: 576px) {
    .photos-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
