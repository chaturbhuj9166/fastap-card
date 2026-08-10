@extends('layouts.redesign.dashboard')

@section('page-title', 'Edit Portfolio Category')
@section('breadcrumb', 'Edit Category')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Edit Portfolio Category</h1>
            <p>Update category details</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('user.creative.portfolio.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ route('user.creative.portfolio.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-folder"></i> Category Details</h3>
            </div>
            <div class="form-card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Category Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="e.g., Wedding Photography, Portraits" required>
                        @error('name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                        <small class="form-hint">A descriptive name for this portfolio category</small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Describe this category and the type of work it showcases...">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Help viewers understand what they'll find in this category</small>
                </div>

                <div class="form-group">
                    <label>Current Cover Image</label>
                    @if($category->cover_image)
                        <div class="current-cover-image">
                            <img src="{{ asset('storage/' . $category->cover_image) }}" alt="{{ $category->name }}">
                            <div class="image-info">
                                <i class="fas fa-check-circle"></i>
                                <span>Current cover image</span>
                            </div>
                        </div>
                    @else
                        <p class="text-muted">No cover image uploaded</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>Replace Cover Image</label>
                    <div class="file-upload-area" id="coverUploadArea">
                        <div class="file-upload-content">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Drag & drop new cover image here or <span class="browse-link">browse</span></p>
                            <small>Leave empty to keep current image - Supports: JPG, PNG, WEBP (Max 2MB)</small>
                        </div>
                        <input type="file" id="cover_image" name="cover_image"
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               class="file-input">
                    </div>
                    @error('cover_image')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    <div id="imagePreviewContainer" class="image-preview-single"></div>
                </div>

                <div class="form-group">
                    <div class="form-checkbox">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                        <label for="is_active">Active (visible in portfolio)</label>
                    </div>
                    @error('is_active')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Update Category
                </button>
                <a href="{{ route('user.creative.portfolio.index') }}" class="btn btn-outline btn-lg">Cancel</a>
            </div>
        </div>
    </form>
</div>

<style>
.current-cover-image {
    position: relative;
    width: 100%;
    max-width: 500px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 1rem;
}

.current-cover-image img {
    width: 100%;
    height: auto;
    display: block;
}

.image-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
    padding: 2rem 1rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    font-size: 0.875rem;
}

.image-info i {
    color: var(--success-color);
}

.image-preview-single {
    margin-top: 1rem;
    display: none;
}

.image-preview-single.active {
    display: block;
}

.image-preview-wrapper {
    position: relative;
    width: 100%;
    max-width: 500px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
}

.image-preview-wrapper img {
    width: 100%;
    height: auto;
    display: block;
}

.image-preview-actions {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    gap: 0.5rem;
}

.preview-action-btn {
    width: 36px;
    height: 36px;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(10px);
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.preview-action-btn:hover {
    background: rgba(0, 0, 0, 0.9);
    transform: scale(1.1);
}

.preview-action-btn.remove {
    background: rgba(231, 76, 60, 0.9);
}

.preview-action-btn.remove:hover {
    background: rgba(231, 76, 60, 1);
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
    const uploadArea = document.getElementById('coverUploadArea');
    const fileInput = document.getElementById('cover_image');
    const previewContainer = document.getElementById('imagePreviewContainer');

    uploadArea.addEventListener('click', () => fileInput.click());

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        if (e.dataTransfer.files.length > 0) {
            fileInput.files = e.dataTransfer.files;
            handleFile(e.dataTransfer.files[0]);
        }
    });

    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleFile(e.target.files[0]);
        }
    });

    function handleFile(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewContainer.innerHTML = `
                    <div class="image-preview-wrapper">
                        <img src="${e.target.result}" alt="New Cover Image Preview">
                        <div class="image-preview-actions">
                            <button type="button" class="preview-action-btn remove" onclick="removePreview()" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                `;
                previewContainer.classList.add('active');
            };
            reader.readAsDataURL(file);
        }
    }

    window.removePreview = function() {
        previewContainer.innerHTML = '';
        previewContainer.classList.remove('active');
        fileInput.value = '';
    };
});
</script>
@include('userdashboard-new.partials.form-page-styles')
@endsection
