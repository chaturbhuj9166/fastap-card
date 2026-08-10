@extends('layouts.redesign.dashboard')

@section('page-title', 'Social Media Statistics')
@section('breadcrumb', 'Social Stats')

@section('dashboard-content')
<div class="social-stats-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Social Media Statistics</h1>
            <p>Manage your social media presence and showcase your reach</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <!-- Overall Stats -->
    <div class="stats-row fade-up">
        @php
            $totalFollowers = $socialStats ? $socialStats->sum('followers') : 0;
            $totalViews = $socialStats ? $socialStats->sum('total_views') : 0;
            $avgEngagement = $socialStats && count($socialStats) > 0 ? $socialStats->avg('engagement_rate') : 0;
            $totalPlatforms = $socialStats ? count($socialStats) : 0;
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon purple">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ number_format($totalFollowers) }}</span>
                <span class="stat-mini-label">Total Followers</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon blue">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ number_format($totalViews) }}</span>
                <span class="stat-mini-label">Total Views</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon green">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ number_format($avgEngagement, 2) }}%</span>
                <span class="stat-mini-label">Avg Engagement</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon orange">
                <i class="fas fa-share-nodes"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalPlatforms }}</span>
                <span class="stat-mini-label">Platforms</span>
            </div>
        </div>
    </div>

    <!-- Add/Update Form -->
    <div class="form-card fade-up">
        <div class="form-card-header">
            <h3><i class="fas fa-plus-circle"></i> {{ isset($editingStat) ? 'Update' : 'Add' }} Platform Statistics</h3>
        </div>
        <div class="form-card-body">
            <form action="{{ isset($editingStat) ? route('talent.social-stats.update', $editingStat->id) : route('talent.social-stats.store') }}" method="POST">
                @csrf
                @if(isset($editingStat))
                    @method('PUT')
                @endif
                <div class="form-row">
                    <div class="form-group">
                        <label for="platform">Platform <span class="required">*</span></label>
                        <select id="platform" name="platform" class="form-control @error('platform') is-invalid @enderror" required>
                            <option value="">Select Platform</option>
                            <option value="instagram" {{ old('platform', $editingStat->platform ?? '') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="youtube" {{ old('platform', $editingStat->platform ?? '') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                            <option value="facebook" {{ old('platform', $editingStat->platform ?? '') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="twitter" {{ old('platform', $editingStat->platform ?? '') == 'twitter' ? 'selected' : '' }}>Twitter/X</option>
                            <option value="tiktok" {{ old('platform', $editingStat->platform ?? '') == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                            <option value="linkedin" {{ old('platform', $editingStat->platform ?? '') == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                            <option value="spotify" {{ old('platform', $editingStat->platform ?? '') == 'spotify' ? 'selected' : '' }}>Spotify</option>
                            <option value="soundcloud" {{ old('platform', $editingStat->platform ?? '') == 'soundcloud' ? 'selected' : '' }}>SoundCloud</option>
                            <option value="other" {{ old('platform', $editingStat->platform ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('platform')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="followers">Followers/Subscribers <span class="required">*</span></label>
                        <input type="number" id="followers" name="followers" value="{{ old('followers', $editingStat->followers ?? '') }}"
                               class="form-control @error('followers') is-invalid @enderror"
                               placeholder="10000" min="0" required>
                        @error('followers')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="engagement_rate">Engagement Rate (%)</label>
                        <input type="number" id="engagement_rate" name="engagement_rate" value="{{ old('engagement_rate', $editingStat->engagement_rate ?? '') }}"
                               class="form-control @error('engagement_rate') is-invalid @enderror"
                               placeholder="5.5" min="0" max="100" step="0.01">
                        @error('engagement_rate')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                        <small class="form-hint">Average engagement rate on your posts</small>
                    </div>
                    <div class="form-group">
                        <label for="total_views">Total Views</label>
                        <input type="number" id="total_views" name="total_views" value="{{ old('total_views', $editingStat->total_views ?? '') }}"
                               class="form-control @error('total_views') is-invalid @enderror"
                               placeholder="1000000" min="0">
                        @error('total_views')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="total_posts">Total Posts/Videos</label>
                        <input type="number" id="total_posts" name="total_posts" value="{{ old('total_posts', $editingStat->total_posts ?? '') }}"
                               class="form-control @error('total_posts') is-invalid @enderror"
                               placeholder="250" min="0">
                        @error('total_posts')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-checkbox" style="margin-top: 2rem;">
                            <input type="checkbox" id="is_verified" name="is_verified" value="1" {{ old('is_verified', $editingStat->is_verified ?? false) ? 'checked' : '' }}>
                            <label for="is_verified">Verified Account</label>
                        </div>
                        @error('is_verified')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ isset($editingStat) ? 'Update' : 'Add' }} Statistics
                    </button>
                    @if(isset($editingStat))
                        <a href="{{ route('talent.social-stats.index') }}" class="btn btn-outline">Cancel</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Social Stats List -->
    @if($socialStats && count($socialStats) > 0)
        <div class="social-stats-grid stagger-animation">
            @foreach($socialStats as $stat)
                <div class="social-stat-card fade-up">
                    <div class="stat-card-header">
                        <div class="platform-info">
                            <div class="platform-icon {{ $stat->platform }}">
                                @if($stat->platform == 'instagram')
                                    <i class="fab fa-instagram"></i>
                                @elseif($stat->platform == 'youtube')
                                    <i class="fab fa-youtube"></i>
                                @elseif($stat->platform == 'facebook')
                                    <i class="fab fa-facebook"></i>
                                @elseif($stat->platform == 'twitter')
                                    <i class="fab fa-twitter"></i>
                                @elseif($stat->platform == 'tiktok')
                                    <i class="fab fa-tiktok"></i>
                                @elseif($stat->platform == 'linkedin')
                                    <i class="fab fa-linkedin"></i>
                                @elseif($stat->platform == 'spotify')
                                    <i class="fab fa-spotify"></i>
                                @elseif($stat->platform == 'soundcloud')
                                    <i class="fab fa-soundcloud"></i>
                                @else
                                    <i class="fas fa-share-nodes"></i>
                                @endif
                            </div>
                            <div class="platform-details">
                                <h4>{{ ucfirst($stat->platform) }}</h4>
                                @if($stat->is_verified)
                                    <span class="verified-badge">
                                        <i class="fas fa-check-circle"></i> Verified
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="stat-card-body">
                        <div class="stat-metrics">
                            <div class="metric-item">
                                <div class="metric-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="metric-info">
                                    <span class="metric-value">{{ number_format($stat->followers) }}</span>
                                    <span class="metric-label">Followers</span>
                                </div>
                            </div>
                            @if($stat->total_views)
                                <div class="metric-item">
                                    <div class="metric-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="metric-info">
                                        <span class="metric-value">{{ number_format($stat->total_views) }}</span>
                                        <span class="metric-label">Views</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="stat-details">
                            @if($stat->engagement_rate)
                                <div class="detail-row">
                                    <span class="detail-label">Engagement Rate</span>
                                    <span class="detail-value engagement">{{ number_format($stat->engagement_rate, 2) }}%</span>
                                </div>
                            @endif
                            @if($stat->total_posts)
                                <div class="detail-row">
                                    <span class="detail-label">Total Posts</span>
                                    <span class="detail-value">{{ number_format($stat->total_posts) }}</span>
                                </div>
                            @endif
                        </div>
                        <p class="stat-date">Updated {{ $stat->updated_at ? $stat->updated_at->diffForHumans() : 'N/A' }}</p>
                    </div>
                    <div class="stat-card-actions">
                        <a href="{{ route('talent.social-stats.edit', $stat->id) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('talent.social-stats.destroy', $stat->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this social media stat?')">
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
                <i class="fas fa-share-nodes"></i>
            </div>
            <h3>No Social Media Stats Yet</h3>
            <p>Add your social media statistics to showcase your online presence and reach to potential clients.</p>
        </div>
    @endif
</div>

<style>
.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.social-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
}

.social-stat-card {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.social-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.stat-card-header {
    padding: 1.25rem;
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border-color);
}

.platform-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.platform-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: white;
}

.platform-icon.instagram {
    background: linear-gradient(135deg, #833ab4, #fd1d1d, #fcb045);
}

.platform-icon.youtube {
    background: linear-gradient(135deg, #ff0000, #cc0000);
}

.platform-icon.facebook {
    background: linear-gradient(135deg, #1877f2, #0d5dbf);
}

.platform-icon.twitter {
    background: linear-gradient(135deg, #1da1f2, #0c85d0);
}

.platform-icon.tiktok {
    background: linear-gradient(135deg, #000000, #ee1d52, #69c9d0);
}

.platform-icon.linkedin {
    background: linear-gradient(135deg, #0077b5, #005885);
}

.platform-icon.spotify {
    background: linear-gradient(135deg, #1db954, #1aa34a);
}

.platform-icon.soundcloud {
    background: linear-gradient(135deg, #ff5500, #ff3300);
}

.platform-icon.other {
    background: linear-gradient(135deg, var(--purple-500), #667eea);
}

.platform-details h4 {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0 0 0.25rem;
}

.verified-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.25rem 0.6rem;
    border-radius: 10px;
    font-size: 0.7rem;
    font-weight: 600;
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.stat-card-body {
    padding: 1.25rem;
    flex: 1;
}

.stat-metrics {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.25rem;
}

.metric-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: var(--bg-secondary);
    border-radius: 10px;
}

.metric-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: linear-gradient(135deg, var(--purple-500), #667eea);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.metric-info {
    display: flex;
    flex-direction: column;
}

.metric-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-color);
}

.metric-label {
    font-size: 0.7rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-details {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border-color);
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.detail-value {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-color);
}

.detail-value.engagement {
    color: var(--success-color);
}

.stat-date {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin: 0;
}

.stat-card-actions {
    display: flex;
    border-top: 1px solid var(--border-color);
    padding: 0.75rem 1.25rem;
    gap: 0.5rem;
    justify-content: flex-end;
}

.form-checkbox {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.form-checkbox input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
}

.form-checkbox label {
    margin: 0;
    cursor: pointer;
    user-select: none;
}

@media (max-width: 576px) {
    .social-stats-grid {
        grid-template-columns: 1fr;
    }

    .stat-metrics {
        grid-template-columns: 1fr;
    }
}
</style>
@include('userdashboard-new.partials.content-page-styles')
@endsection
