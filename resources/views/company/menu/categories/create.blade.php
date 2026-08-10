@extends('layouts.redesign.company')

@section('page-title', 'Create Category')
@section('breadcrumb')
<a href="{{ url('/company/menu') }}">Menu</a>
<span class="breadcrumb-separator">/</span>
Create Category
@endsection

@section('company-content')
<div class="form-page">
    <div class="form-card">
        <div class="form-header">
            <h2><i class="fas fa-folder-plus"></i> Create Menu Category</h2>
            <p>Add a new category to organize your menu items</p>
        </div>

        <form action="{{ route('company.menu.category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-section">
                <div class="form-group">
                    <label class="form-label">Category Name *</label>
                    <input type="text" name="name" class="form-input" placeholder="e.g., Starters, Main Course" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="3" placeholder="Brief description of this category">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Category Image</label>
                    <div class="file-upload-area" id="uploadArea">
                        <input type="file" name="image" id="categoryImage" accept="image/*" hidden>
                        <div class="upload-placeholder" id="uploadPlaceholder">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click or drag to upload image</p>
                            <span>Max 2MB, JPG/PNG</span>
                        </div>
                        <div class="upload-preview" id="uploadPreview" style="display: none;">
                            <img id="previewImage" src="" alt="Preview">
                            <button type="button" class="remove-image" onclick="removeImage()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ url('/company/menu') }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Category
                </button>
            </div>
        </form>
    </div>
</div>

@push('page-styles')
<style>
    .form-page { max-width: 600px; }
    .form-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
    }
    .form-header { margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border-color); }
    .form-header h2 { font-size: 1.25rem; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem; }
    .form-header p { color: var(--text-muted); font-size: 0.9rem; }
    .form-group { margin-bottom: 1rem; }
    .form-label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-input, .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 1rem;
        background: var(--bg-primary);
        color: var(--text-primary);
    }
    .form-input:focus, .form-select:focus { outline: none; border-color: #0891b2; }
    .error-text { color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem; display: block; }
    .file-upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 0.75rem;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
    }
    .file-upload-area:hover { border-color: #0891b2; }
    .upload-placeholder i { font-size: 2.5rem; color: #0891b2; margin-bottom: 0.75rem; }
    .upload-placeholder p { font-weight: 500; margin-bottom: 0.25rem; }
    .upload-placeholder span { font-size: 0.85rem; color: var(--text-muted); }
    .upload-preview { position: relative; display: inline-block; }
    .upload-preview img { width: 120px; height: 120px; border-radius: 0.75rem; object-fit: cover; }
    .remove-image {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #ef4444;
        color: white;
        border: none;
        cursor: pointer;
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }
</style>
@endpush

@push('page-scripts')
<script>
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('categoryImage');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const uploadPreview = document.getElementById('uploadPreview');
    const previewImage = document.getElementById('previewImage');

    uploadArea.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            const reader = new FileReader();
            reader.onload = (ev) => {
                previewImage.src = ev.target.result;
                uploadPlaceholder.style.display = 'none';
                uploadPreview.style.display = 'block';
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });
    function removeImage() {
        fileInput.value = '';
        previewImage.src = '';
        uploadPlaceholder.style.display = 'block';
        uploadPreview.style.display = 'none';
    }
</script>
@endpush
@endsection
