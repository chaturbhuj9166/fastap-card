@extends('layouts.redesign.dashboard')

@section('page-title', 'My Portfolio')
@section('breadcrumb', 'Portfolio')

@section('dashboard-content')
<div class="portfolio-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Portfolio</h1>
            <p>Showcase your best work and talent</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('talent.portfolio.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Portfolio Item
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="stats-row fade-up">
        @php
            $totalItems = $portfolioItems ? (is_countable($portfolioItems) ? count($portfolioItems) : 0) : 0;
            $imagesCount = $portfolioItems ? $portfolioItems->where('media_type', 'image')->count() : 0;
            $videosCount = $portfolioItems ? $portfolioItems->where('media_type', 'video')->count() : 0;
            $audioCount = $portfolioItems ? $portfolioItems->where('media_type', 'audio')->count() : 0;
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon purple">
                <i class="fas fa-photo-film"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalItems }}</span>
                <span class="stat-mini-label">Total Items</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon blue">
                <i class="fas fa-image"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $imagesCount }}</span>
                <span class="stat-mini-label">Images</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon orange">
                <i class="fas fa-video"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $videosCount }}</span>
                <span class="stat-mini-label">Videos</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon green">
                <i class="fas fa-music"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $audioCount }}</span>
                <span class="stat-mini-label">Audio</span>
            </div>
        </div>
    </div>

    <div class="filter-bar fade-up">
        <div class="filter-section">
            <label for="talentTypeFilter"><i class="fas fa-filter"></i> Filter by Talent Type:</label>
            <select id="talentTypeFilter" class="filter-select" onchange="window.location.href='?talent_type=' + this.value">
                <option value="">All Talent Types</option>
                <option value="actor" {{ request('talent_type') == 'actor' ? 'selected' : '' }}>Actor</option>
                <option value="model" {{ request('talent_type') == 'model' ? 'selected' : '' }}>Model</option>
                <option value="singer" {{ request('talent_type') == 'singer' ? 'selected' : '' }}>Singer</option>
                <option value="dancer" {{ request('talent_type') == 'dancer' ? 'selected' : '' }}>Dancer</option>
                <option value="youtuber" {{ request('talent_type') == 'youtuber' ? 'selected' : '' }}>YouTuber</option>
                <option value="music_producer" {{ request('talent_type') == 'music_producer' ? 'selected' : '' }}>Music Producer</option>
                <option value="anchor" {{ request('talent_type') == 'anchor' ? 'selected' : '' }}>Anchor</option>
                <option value="influencer" {{ request('talent_type') == 'influencer' ? 'selected' : '' }}>Influencer</option>
                <option value="custom" {{ request('talent_type') == 'custom' ? 'selected' : '' }}>Custom Talent</option>
            </select>
        </div>
    </div>

    @if($portfolioItems && count($portfolioItems) > 0)
        <div class="portfolio-grid stagger-animation">
            @foreach($portfolioItems as $item)
                <div class="portfolio-card fade-up">
                    <div class="portfolio-media">
                        @if($item->media_type === 'image')
                            <img src="{{ asset('storage/' . $item->media_path) }}" alt="{{ $item->title }}">
                            <div class="media-type-badge image">
                                <i class="fas fa-image"></i>
                            </div>
                        @elseif($item->media_type === 'video')
                            @if($item->thumbnail_path)
                                <img src="{{ asset('storage/' . $item->thumbnail_path) }}" alt="{{ $item->title }}">
                            @else
                                <div class="media-placeholder">
                                    <i class="fas fa-video"></i>
                                </div>
                            @endif
                            <div class="media-type-badge video">
                                <i class="fas fa-video"></i>
                            </div>
                        @else
                            <div class="media-placeholder">
                                <i class="fas fa-music"></i>
                            </div>
                            <div class="media-type-badge audio">
                                <i class="fas fa-music"></i>
                            </div>
                        @endif
                        @if($item->is_featured)
                            <div class="featured-badge">
                                <i class="fas fa-star"></i> Featured
                            </div>
                        @endif
                    </div>
                    <div class="portfolio-body">
                        <div class="portfolio-header">
                            <span class="talent-type-badge {{ $item->talent_type }}">
                                {{ ucfirst(str_replace('_', ' ', $item->talent_type)) }}
                            </span>
                        </div>
                        <h4 class="portfolio-title">{{ $item->title }}</h4>
                        @if($item->description)
                            <p class="portfolio-description">{{ Str::limit($item->description, 80) }}</p>
                        @endif
                        <div class="portfolio-meta">
                            @if($item->category)
                                <div class="meta-item">
                                    <i class="fas fa-tag"></i>
                                    <span>{{ $item->category }}</span>
                                </div>
                            @endif
                            @if($item->year)
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $item->year }}</span>
                                </div>
                            @endif
                        </div>
                        <p class="portfolio-date">Added {{ $item->created_at ? $item->created_at->diffForHumans() : 'N/A' }}</p>
                    </div>
                    <div class="portfolio-actions">
                        <a href="{{ route('talent.portfolio.edit', $item->id) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('talent.portfolio.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this portfolio item?')">
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
                <i class="fas fa-photo-film"></i>
            </div>
            <h3>No Portfolio Items Yet</h3>
            <p>Start building your portfolio by adding your best work - photos, videos, and audio samples.</p>
            <a href="{{ route('talent.portfolio.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Portfolio Item
            </a>
        </div>
    @endif
</div>

<style>
.filter-bar {
    background: var(--card-bg);
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-sm);
}

.filter-section {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.filter-section label {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-secondary);
    margin: 0;
}

.filter-select {
    padding: 0.5rem 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background: var(--bg-secondary);
    color: var(--text-color);
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s;
    min-width: 200px;
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary-color);
}

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

.portfolio-media {
    position: relative;
    aspect-ratio: 16/9;
    overflow: hidden;
    background: var(--bg-secondary);
}

.portfolio-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.media-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: var(--text-muted);
    background: linear-gradient(135deg, var(--bg-secondary), var(--bg-tertiary));
}

.media-type-badge {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    padding: 0.4rem 0.75rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.35rem;
}

.media-type-badge.image {
    background: rgba(59, 130, 246, 0.9);
}

.media-type-badge.video {
    background: rgba(249, 115, 22, 0.9);
}

.media-type-badge.audio {
    background: rgba(16, 185, 129, 0.9);
}

.featured-badge {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    padding: 0.4rem 0.75rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    color: white;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    display: flex;
    align-items: center;
    gap: 0.35rem;
}

.portfolio-body {
    padding: 1.25rem;
    flex: 1;
}

.portfolio-header {
    margin-bottom: 0.75rem;
}

.talent-type-badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: capitalize;
}

.talent-type-badge.actor {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
}

.talent-type-badge.model {
    background: rgba(245, 87, 108, 0.1);
    color: #f5576c;
}

.talent-type-badge.singer {
    background: rgba(79, 172, 254, 0.1);
    color: #4facfe;
}

.talent-type-badge.dancer {
    background: rgba(67, 233, 123, 0.1);
    color: #43e97b;
}

.talent-type-badge.youtuber,
.talent-type-badge.influencer,
.talent-type-badge.music_producer,
.talent-type-badge.anchor,
.talent-type-badge.custom {
    background: rgba(250, 112, 154, 0.1);
    color: #fa709a;
}

.portfolio-title {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0 0 0.75rem;
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
    gap: 0.4rem;
    font-size: 0.8rem;
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

@media (max-width: 576px) {
    .portfolio-grid {
        grid-template-columns: 1fr;
    }

    .filter-section {
        flex-direction: column;
        align-items: stretch;
    }

    .filter-select {
        width: 100%;
    }
}
</style>
@include('userdashboard-new.partials.content-page-styles')
@endsection
