@extends('layouts.redesign.dashboard')

@section('page-title', 'My Videos')
@section('breadcrumb', 'Videos')

@section('dashboard-content')
<div class="videos-page">
    {{-- Page Header --}}
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Videos</h1>
            <p>Manage your video links and embeds</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/addmyvideo') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Video
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    {{-- Stats --}}
    <div class="videos-stats fade-up">
        @php
            $totalVideos = $videos ? $videos->count() : 0;
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon red">
                <i class="fas fa-video"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalVideos }}</span>
                <span class="stat-mini-label">Total Videos</span>
            </div>
        </div>
    </div>

    {{-- Videos Grid --}}
    @if($videos && $videos->count() > 0)
        <div class="videos-grid stagger-animation">
            @foreach($videos as $video)
                @php
                    // Extract YouTube video ID
                    $videoId = null;
                    $videoUrl = $video->video_link;
                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoUrl, $matches)) {
                        $videoId = $matches[1];
                    }
                @endphp
                <div class="video-card fade-up">
                    <div class="video-card-preview">
                        @if($videoId)
                            <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg" alt="Video Thumbnail">
                            <div class="play-button">
                                <i class="fab fa-youtube"></i>
                            </div>
                        @else
                            <div class="video-placeholder">
                                <i class="fas fa-video"></i>
                            </div>
                        @endif
                        <a href="{{ $videoUrl }}" target="_blank" class="video-overlay-link"></a>
                    </div>
                    <div class="video-card-body">
                        <p class="video-url">{{ Str::limit($video->video_link, 50) }}</p>
                        <p class="video-date">Added {{ $video->created_at ? $video->created_at->diffForHumans() : 'N/A' }}</p>
                    </div>
                    <div class="video-card-actions">
                        <a href="{{ $video->video_link }}" target="_blank" class="action-btn" title="Watch">
                            <i class="fas fa-play"></i>
                        </a>
                        <a href="{{ url('/editmyvideo' . $video->id) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('/deletemyvideo' . $video->id) }}" class="action-btn danger" title="Delete" onclick="return confirm('Are you sure you want to delete this video?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-video"></i>
            </div>
            <h3>No Videos Yet</h3>
            <p>Add YouTube or other video links to showcase on your profile.</p>
            <a href="{{ url('/addmyvideo') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Video
            </a>
        </div>
    @endif
</div>

<style>
.videos-page {
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
.videos-stats {
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

.stat-mini-icon.red {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(248, 113, 113, 0.15) 100%);
    color: var(--red-500);
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

/* Videos Grid */
.videos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: var(--space-lg);
}

/* Video Card */
.video-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: all var(--transition-base);
}

.video-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.video-card-preview {
    position: relative;
    aspect-ratio: 16/9;
    background: #000;
    overflow: hidden;
}

.video-card-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-base);
}

.video-card:hover .video-card-preview img {
    transform: scale(1.05);
}

.video-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-secondary);
    font-size: var(--text-4xl);
    color: var(--text-muted);
}

.play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    background: rgba(255, 0, 0, 0.9);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-2xl);
    color: white;
    opacity: 0.9;
    transition: all var(--transition-fast);
}

.video-card:hover .play-button {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1.1);
}

.video-overlay-link {
    position: absolute;
    inset: 0;
    z-index: 1;
}

.video-card-body {
    padding: var(--space-md);
}

.video-url {
    font-size: var(--text-sm);
    color: var(--text-secondary);
    margin-bottom: var(--space-xs);
    word-break: break-all;
}

.video-date {
    font-size: var(--text-xs);
    color: var(--text-muted);
    margin: 0;
}

.video-card-actions {
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
    .videos-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
