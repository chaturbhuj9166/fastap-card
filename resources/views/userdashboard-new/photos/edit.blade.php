@extends('layouts.redesign.dashboard')

@section('page-title', 'Edit Photos')
@section('breadcrumb', 'Edit Photos')

@section('dashboard-content')
<div class="photos-form-page">
    {{-- Page Header --}}
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Edit Photos</h1>
            <p>Update your photo album</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/portfolio') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ url('/updateportfolio') }}" method="POST" enctype="multipart/form-data" class="photos-form">
        @csrf
        <input type="hidden" name="id" value="{{ $portfolio->id }}">

        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-images"></i> Album Details</h3>
            </div>

            <div class="form-card-body">
                <div class="form-group">
                    <label for="title">Album Title <span class="required">*</span></label>
                    <input type="text" id="title" name="title"
                           value="{{ old('title', $portfolio->title) }}"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="Enter album title" required>
                    @error('title')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Current Images --}}
                @php
                    $images = is_string($portfolio->image) ? json_decode($portfolio->image, true) : $portfolio->image;
                @endphp
                @if($images && count($images) > 0)
                    <div class="form-group">
                        <label>Current Images</label>
                        <div class="current-images-grid">
                            @foreach($images as $index => $image)
                                <div class="current-image-item">
                                    <img src="{{ asset('public/frontend/portfolio/' . $image) }}" alt="Album Image">
                                    <div class="image-overlay">
                                        <span class="image-number">#{{ $index + 1 }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <span class="form-hint">Upload new images below to replace existing ones</span>
                    </div>
                @endif

                <div class="form-group">
                    <label>Upload New Images</label>
                    <div class="file-upload-zone" id="dropZone">
                        <input type="file" id="imageInput" name="image[]" multiple accept="image/*" hidden>
                        <div class="upload-content">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <h4>Drag & drop new images here</h4>
                            <p>or <span class="browse-link">browse files</span></p>
                            <span class="upload-hint">Leave empty to keep current images</span>
                        </div>
                    </div>
                    @error('image')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    @error('image.*')
                        <span class="form-error">{{ $message }}</span>
                    @enderror

                    <div class="image-preview-grid" id="previewGrid"></div>
                </div>
            </div>

            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Update Album
                </button>
                <a href="{{ url('/portfolio') }}" class="btn btn-outline btn-lg">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>

<style>
.photos-form-page {
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

/* Current Images Grid */
.current-images-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: var(--space-md);
    margin-bottom: var(--space-sm);
}

.current-image-item {
    position: relative;
    aspect-ratio: 1;
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 2px solid var(--border-light);
}

.current-image-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 50%);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding: var(--space-xs);
}

.image-number {
    font-size: var(--text-xs);
    font-weight: var(--font-medium);
    color: white;
}

/* File Upload Zone */
.file-upload-zone {
    border: 2px dashed var(--border-light);
    border-radius: var(--radius-xl);
    padding: var(--space-2xl);
    text-align: center;
    cursor: pointer;
    transition: all var(--transition-fast);
    background: var(--bg-secondary);
}

.file-upload-zone:hover,
.file-upload-zone.dragover {
    border-color: var(--purple-500);
    background: rgba(139, 92, 246, 0.05);
}

.upload-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto var(--space-md);
    background: var(--bg-tertiary);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-2xl);
    color: var(--purple-500);
}

.upload-content h4 {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    margin-bottom: var(--space-xs);
}

.upload-content p {
    color: var(--text-secondary);
    margin-bottom: var(--space-xs);
}

.browse-link {
    color: var(--purple-500);
    font-weight: var(--font-medium);
    cursor: pointer;
}

.browse-link:hover {
    text-decoration: underline;
}

.upload-hint {
    font-size: var(--text-xs);
    color: var(--text-muted);
}

/* Image Preview Grid */
.image-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: var(--space-md);
    margin-top: var(--space-lg);
}

.preview-item {
    position: relative;
    aspect-ratio: 1;
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1px solid var(--border-light);
}

.preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.preview-remove {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 24px;
    height: 24px;
    background: rgba(239, 68, 68, 0.9);
    border: none;
    border-radius: var(--radius-full);
    color: white;
    font-size: var(--text-xs);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--transition-fast);
}

.preview-remove:hover {
    background: var(--red-600);
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 576px) {
    .form-card-footer {
        flex-direction: column;
    }

    .form-card-footer .btn {
        width: 100%;
        justify-content: center;
    }

    .current-images-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .image-preview-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('imageInput');
    const previewGrid = document.getElementById('previewGrid');
    let selectedFiles = new DataTransfer();

    // Click to browse
    dropZone.addEventListener('click', () => fileInput.click());

    // Drag and drop events
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.add('dragover'));
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.remove('dragover'));
    });

    // Handle dropped files
    dropZone.addEventListener('drop', function(e) {
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    // Handle selected files
    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        [...files].forEach(file => {
            if (file.type.startsWith('image/')) {
                selectedFiles.items.add(file);
                previewFile(file);
            }
        });
        fileInput.files = selectedFiles.files;
    }

    function previewFile(file) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = function() {
            const previewItem = document.createElement('div');
            previewItem.className = 'preview-item';
            previewItem.innerHTML = `
                <img src="${reader.result}" alt="Preview">
                <button type="button" class="preview-remove" data-name="${file.name}">
                    <i class="fas fa-times"></i>
                </button>
            `;
            previewGrid.appendChild(previewItem);

            // Remove button handler
            previewItem.querySelector('.preview-remove').addEventListener('click', function() {
                const fileName = this.dataset.name;
                removeFile(fileName);
                previewItem.remove();
            });
        }
    }

    function removeFile(fileName) {
        const newFiles = new DataTransfer();
        [...selectedFiles.files].forEach(file => {
            if (file.name !== fileName) {
                newFiles.items.add(file);
            }
        });
        selectedFiles = newFiles;
        fileInput.files = selectedFiles.files;
    }
});
</script>
@endsection
