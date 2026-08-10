@extends('layouts.redesign.dashboard')

@section('page-title', 'Edit Video')
@section('breadcrumb', 'Edit Video')

@section('dashboard-content')
<div class="videos-form-page">
    {{-- Page Header --}}
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Edit Video</h1>
            <p>Update your video link</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/myvideo') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="form-layout">
        <form action="{{ url('/updatemyvideo') }}" method="POST" class="videos-form">
            @csrf
            <input type="hidden" name="id" value="{{ $video->id }}">

            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-video"></i> Video Details</h3>
                </div>

                <div class="form-card-body">
                    <div class="form-group">
                        <label for="video_link">Video URL <span class="required">*</span></label>
                        <input type="url" id="video_link" name="video_link"
                               value="{{ old('video_link', $video->video_link) }}"
                               class="form-control @error('video_link') is-invalid @enderror"
                               placeholder="https://www.youtube.com/watch?v=..." required
                               pattern="https://.*">
                        @error('video_link')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                        <span class="form-hint">Paste a YouTube, Vimeo, or other video URL</span>
                    </div>

                    @php
                        $videoId = null;
                        $videoUrl = $video->video_link;
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoUrl, $matches)) {
                            $videoId = $matches[1];
                        }
                    @endphp

                    <div class="video-preview-container" id="videoPreview" @if(!$videoId) style="display: none;" @endif>
                        <label>Preview</label>
                        <div class="video-preview">
                            <iframe id="previewFrame"
                                    src="{{ $videoId ? 'https://www.youtube.com/embed/' . $videoId : '' }}"
                                    frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                <div class="form-card-footer">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save"></i> Update Video
                    </button>
                    <a href="{{ url('/myvideo') }}" class="btn btn-outline btn-lg">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

        {{-- Current Video Card --}}
        <div class="tips-card fade-up">
            <div class="tips-card-header">
                <h3><i class="fas fa-info-circle"></i> Current Video</h3>
            </div>
            <div class="tips-card-body">
                @if($videoId)
                    <div class="current-thumbnail">
                        <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg" alt="Video Thumbnail">
                    </div>
                @endif
                <div class="current-info">
                    <p class="info-label">Added</p>
                    <p class="info-value">{{ $video->created_at ? $video->created_at->format('M d, Y') : 'N/A' }}</p>
                </div>
                <a href="{{ $video->video_link }}" target="_blank" class="btn btn-outline btn-block">
                    <i class="fas fa-external-link-alt"></i> Open Video
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.videos-form-page {
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

/* Form Layout */
.form-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: var(--space-xl);
    align-items: start;
}

/* Form Card */
.form-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.form-card-header {
    padding: var(--space-lg);
    border-bottom: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

.form-card-header h3 {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin: 0;
}

.form-card-header h3 i {
    color: var(--purple-500);
}

.form-card-body {
    padding: var(--space-xl);
}

.form-card-footer {
    display: flex;
    gap: var(--space-md);
    padding: var(--space-lg);
    border-top: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

/* Form Elements */
.form-group {
    margin-bottom: var(--space-lg);
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-group label {
    display: block;
    font-size: var(--text-sm);
    font-weight: var(--font-medium);
    color: var(--text-primary);
    margin-bottom: var(--space-xs);
}

.form-group label .required {
    color: var(--red-500);
}

.form-control {
    width: 100%;
    padding: var(--space-sm) var(--space-md);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: var(--text-base);
    transition: all var(--transition-fast);
}

.form-control:focus {
    outline: none;
    border-color: var(--purple-500);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
}

.form-control.is-invalid {
    border-color: var(--red-500);
}

.form-error {
    display: block;
    font-size: var(--text-xs);
    color: var(--red-500);
    margin-top: var(--space-xs);
}

.form-hint {
    display: block;
    font-size: var(--text-xs);
    color: var(--text-muted);
    margin-top: var(--space-xs);
}

/* Video Preview */
.video-preview-container {
    margin-top: var(--space-lg);
}

.video-preview {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    border-radius: var(--radius-lg);
    background: #000;
}

.video-preview iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

/* Tips/Info Card */
.tips-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.tips-card-header {
    padding: var(--space-md) var(--space-lg);
    border-bottom: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

.tips-card-header h3 {
    font-size: var(--text-sm);
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin: 0;
}

.tips-card-header h3 i {
    color: var(--blue-500);
}

.tips-card-body {
    padding: var(--space-lg);
}

.current-thumbnail {
    border-radius: var(--radius-lg);
    overflow: hidden;
    margin-bottom: var(--space-md);
}

.current-thumbnail img {
    width: 100%;
    display: block;
}

.current-info {
    margin-bottom: var(--space-md);
}

.info-label {
    font-size: var(--text-xs);
    color: var(--text-muted);
    margin-bottom: 2px;
}

.info-value {
    font-size: var(--text-sm);
    font-weight: var(--font-medium);
    color: var(--text-primary);
    margin: 0;
}

.btn-block {
    width: 100%;
    justify-content: center;
}

/* Responsive */
@media (max-width: 992px) {
    .form-layout {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .form-card-footer {
        flex-direction: column;
    }

    .form-card-footer .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoInput = document.getElementById('video_link');
    const previewContainer = document.getElementById('videoPreview');
    const previewFrame = document.getElementById('previewFrame');

    videoInput.addEventListener('input', function() {
        const url = this.value;
        const embedUrl = getYouTubeEmbedUrl(url);

        if (embedUrl) {
            previewFrame.src = embedUrl;
            previewContainer.style.display = 'block';
        } else {
            previewFrame.src = '';
            previewContainer.style.display = 'none';
        }
    });

    function getYouTubeEmbedUrl(url) {
        const regex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
        const match = url.match(regex);

        if (match && match[1]) {
            return `https://www.youtube.com/embed/${match[1]}`;
        }

        return null;
    }
});
</script>
@endsection
