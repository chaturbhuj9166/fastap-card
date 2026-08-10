@extends('layouts.redesign.dashboard')

@section('page-title', 'Edit Portfolio Item')
@section('breadcrumb', 'Edit Portfolio Item')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Edit Portfolio Item</h1>
            <p>Update your portfolio item details</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('talent.portfolio.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ route('talent.portfolio.update', $portfolioItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-photo-film"></i> Portfolio Item Details</h3>
            </div>
            <div class="form-card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="talent_type">Talent Type <span class="required">*</span></label>
                        <select id="talent_type" name="talent_type" class="form-control @error('talent_type') is-invalid @enderror" required>
                            <option value="">Select Talent Type</option>
                            <option value="actor" {{ old('talent_type', $portfolioItem->talent_type) == 'actor' ? 'selected' : '' }}>Actor</option>
                            <option value="model" {{ old('talent_type', $portfolioItem->talent_type) == 'model' ? 'selected' : '' }}>Model</option>
                            <option value="singer" {{ old('talent_type', $portfolioItem->talent_type) == 'singer' ? 'selected' : '' }}>Singer</option>
                            <option value="dancer" {{ old('talent_type', $portfolioItem->talent_type) == 'dancer' ? 'selected' : '' }}>Dancer</option>
                            <option value="youtuber" {{ old('talent_type', $portfolioItem->talent_type) == 'youtuber' ? 'selected' : '' }}>YouTuber</option>
                            <option value="music_producer" {{ old('talent_type', $portfolioItem->talent_type) == 'music_producer' ? 'selected' : '' }}>Music Producer</option>
                            <option value="anchor" {{ old('talent_type', $portfolioItem->talent_type) == 'anchor' ? 'selected' : '' }}>Anchor</option>
                            <option value="influencer" {{ old('talent_type', $portfolioItem->talent_type) == 'influencer' ? 'selected' : '' }}>Influencer</option>
                            <option value="custom" {{ old('talent_type', $portfolioItem->talent_type) == 'custom' ? 'selected' : '' }}>Custom Talent</option>
                        </select>
                        @error('talent_type')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Title <span class="required">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $portfolioItem->title) }}"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="e.g., Commercial Shoot 2024" required>
                        @error('title')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Describe this portfolio item...">{{ old('description', $portfolioItem->description) }}</textarea>
                    @error('description')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Current Media Type</label>
                    <div class="current-media-info">
                        <i class="fas fa-{{ $portfolioItem->media_type == 'image' ? 'image' : ($portfolioItem->media_type == 'video' ? 'video' : 'music') }}"></i>
                        <span>{{ ucfirst($portfolioItem->media_type) }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Media Type <span class="required">*</span></label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="media_type_image" name="media_type" value="image"
                                   {{ old('media_type', $portfolioItem->media_type) == 'image' ? 'checked' : '' }} required>
                            <label for="media_type_image">
                                <i class="fas fa-image"></i> Image
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="media_type_video" name="media_type" value="video"
                                   {{ old('media_type', $portfolioItem->media_type) == 'video' ? 'checked' : '' }}>
                            <label for="media_type_video">
                                <i class="fas fa-video"></i> Video
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="media_type_audio" name="media_type" value="audio"
                                   {{ old('media_type', $portfolioItem->media_type) == 'audio' ? 'checked' : '' }}>
                            <label for="media_type_audio">
                                <i class="fas fa-music"></i> Audio
                            </label>
                        </div>
                    </div>
                    @error('media_type')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="media_file">Update Media File (Optional)</label>
                    <input type="file" id="media_file" name="media_file"
                           class="form-control @error('media_file') is-invalid @enderror"
                           accept="image/*,video/*,audio/*">
                    @error('media_file')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Leave empty to keep existing file. Upload new file to replace.</small>
                </div>

                <div class="form-group" id="thumbnailGroup" style="display: {{ old('media_type', $portfolioItem->media_type) == 'video' ? 'block' : 'none' }};">
                    <label for="thumbnail">Video Thumbnail (Optional)</label>
                    <input type="file" id="thumbnail" name="thumbnail"
                           class="form-control @error('thumbnail') is-invalid @enderror"
                           accept="image/*">
                    @error('thumbnail')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Upload a new thumbnail or leave empty to keep existing</small>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" id="category" name="category" value="{{ old('category', $portfolioItem->category) }}"
                               class="form-control @error('category') is-invalid @enderror"
                               placeholder="e.g., Commercial, Theatre, Album">
                        @error('category')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="number" id="year" name="year" value="{{ old('year', $portfolioItem->year) }}"
                               class="form-control @error('year') is-invalid @enderror"
                               placeholder="2024" min="1900" max="2100">
                        @error('year')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-checkbox">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $portfolioItem->is_featured) ? 'checked' : '' }}>
                        <label for="is_featured">Feature this item (highlight it on your profile)</label>
                    </div>
                    @error('is_featured')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Update Portfolio Item
                </button>
                <a href="{{ route('talent.portfolio.index') }}" class="btn btn-outline btn-lg">Cancel</a>
            </div>
        </div>
    </form>
</div>

<style>
.current-media-info {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.25rem;
    background: var(--bg-secondary);
    border-radius: 8px;
    border: 1px solid var(--border-color);
    font-weight: 500;
}

.current-media-info i {
    color: var(--primary-color);
    font-size: 1.25rem;
}

.radio-group {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.radio-option {
    flex: 1;
    min-width: 150px;
}

.radio-option input[type="radio"] {
    display: none;
}

.radio-option label {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 1rem;
    border: 2px solid var(--border-color);
    border-radius: 12px;
    background: var(--bg-secondary);
    cursor: pointer;
    transition: all 0.2s;
    font-weight: 500;
    margin: 0;
}

.radio-option label:hover {
    border-color: var(--primary-color);
    background: rgba(139, 92, 246, 0.05);
}

.radio-option input[type="radio"]:checked + label {
    border-color: var(--primary-color);
    background: rgba(139, 92, 246, 0.1);
    color: var(--primary-color);
}

.radio-option label i {
    font-size: 1.25rem;
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mediaTypeRadios = document.querySelectorAll('input[name="media_type"]');
    const thumbnailGroup = document.getElementById('thumbnailGroup');

    function toggleThumbnailField() {
        const selectedType = document.querySelector('input[name="media_type"]:checked').value;
        if (selectedType === 'video') {
            thumbnailGroup.style.display = 'block';
        } else {
            thumbnailGroup.style.display = 'none';
        }
    }

    mediaTypeRadios.forEach(radio => {
        radio.addEventListener('change', toggleThumbnailField);
    });

    // Initialize on page load
    toggleThumbnailField();
});
</script>

@include('userdashboard-new.partials.form-page-styles')
@endsection
