@extends('layouts.redesign.admin')

@section('page-title', 'Add Brand Logo')
@section('breadcrumb')
    <a href="{{ url('/admin/view-brand_logo_view') }}">Brand Logos</a>
    <span class="breadcrumb-separator">/</span>
    <span>Add</span>
@endsection

@push('page-styles')
<style>
    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        max-width: 600px;
    }

    .form-header {
        margin-bottom: var(--space-xl);
        padding-bottom: var(--space-lg);
        border-bottom: 1px solid var(--card-border);
    }

    .form-header h2 {
        font-size: var(--text-xl);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .form-header p {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .form-group {
        margin-bottom: var(--space-lg);
    }

    .form-label {
        display: block;
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
    }

    .form-label .required {
        color: var(--red-500);
    }

    .form-control {
        width: 100%;
        padding: var(--space-sm) var(--space-md);
        font-size: var(--text-base);
        color: var(--text-primary);
        background: var(--bg-primary);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-md);
        transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--purple-500);
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-control::placeholder {
        color: var(--text-muted);
    }

    .form-error {
        font-size: var(--text-sm);
        color: var(--red-500);
        margin-top: var(--space-xs);
    }

    .file-upload {
        border: 2px dashed var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-xl);
        text-align: center;
        cursor: pointer;
        transition: border-color var(--transition-fast), background var(--transition-fast);
    }

    .file-upload:hover {
        border-color: var(--purple-500);
        background: rgba(124, 58, 237, 0.05);
    }

    .file-upload i {
        font-size: var(--text-3xl);
        color: var(--text-muted);
        margin-bottom: var(--space-md);
    }

    .file-upload p {
        color: var(--text-muted);
        font-size: var(--text-sm);
    }

    .file-upload input {
        display: none;
    }

    .preview-container {
        display: flex;
        justify-content: center;
        margin-top: var(--space-md);
    }

    .preview-image {
        max-width: 200px;
        max-height: 100px;
        border-radius: var(--radius-md);
        display: none;
        background: var(--bg-secondary);
        padding: var(--space-sm);
    }

    .form-actions {
        display: flex;
        gap: var(--space-md);
        padding-top: var(--space-lg);
        border-top: 1px solid var(--card-border);
        margin-top: var(--space-xl);
    }

    .logo-preview-box {
        background: var(--bg-secondary);
        border-radius: var(--radius-lg);
        padding: var(--space-xl);
        text-align: center;
        margin-bottom: var(--space-xl);
    }

    .logo-preview-box .placeholder-icon {
        font-size: 48px;
        color: var(--text-muted);
        margin-bottom: var(--space-sm);
    }

    .logo-preview-box p {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    #logoPreviewContainer {
        display: none;
    }

    #logoPreviewContainer img {
        max-width: 200px;
        max-height: 80px;
        object-fit: contain;
    }

    .form-hint {
        font-size: var(--text-xs);
        color: var(--text-muted);
        margin-top: var(--space-xs);
    }
</style>
@endpush

@section('admin-content')

<div class="form-card">
    <div class="form-header">
        <h2><i class="fas fa-building" style="color: var(--purple-500); margin-right: var(--space-sm);"></i> Add Brand Logo</h2>
        <p>Add a partner or client brand logo to display on your website</p>
    </div>

    <div class="logo-preview-box">
        <div id="logoPlaceholder">
            <div class="placeholder-icon"><i class="fas fa-image"></i></div>
            <p>Logo preview will appear here</p>
        </div>
        <div id="logoPreviewContainer">
            <img id="logoPreview" alt="Logo Preview">
        </div>
    </div>

    <form method="POST" action="{{ url('/admin/add-logo1') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label">Brand Name <span class="required">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter brand or company name">
            @error('title')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Logo Image <span class="required">*</span></label>
            <div class="file-upload" onclick="document.getElementById('logoImage').click()">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Click to upload logo image</p>
                <p style="font-size: var(--text-xs); margin-top: var(--space-xs);">PNG, JPG, SVG (Recommended: transparent PNG)</p>
                <input type="file" id="logoImage" name="logo" accept="image/*">
            </div>
            <p class="form-hint">For best results, use a logo with transparent background</p>
            @error('logo')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ url('/admin/view-brand_logo_view') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Brand Logo
            </button>
        </div>
    </form>
</div>

@endsection

@push('page-scripts')
<script>
    // Image preview
    document.getElementById('logoImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logoPlaceholder').style.display = 'none';
                document.getElementById('logoPreviewContainer').style.display = 'block';
                document.getElementById('logoPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Drag and drop
    const uploadArea = document.querySelector('.file-upload');

    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = 'var(--purple-500)';
        this.style.background = 'rgba(124, 58, 237, 0.05)';
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = 'var(--card-border)';
        this.style.background = 'transparent';
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = 'var(--card-border)';
        this.style.background = 'transparent';

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('logoImage').files = files;
            const event = new Event('change');
            document.getElementById('logoImage').dispatchEvent(event);
        }
    });
</script>
@endpush
