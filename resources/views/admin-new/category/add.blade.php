@extends('layouts.redesign.admin')

@section('page-title', 'Add Category')
@section('breadcrumb')
    <a href="{{ url('/admin/viewcategroy') }}">Categories</a>
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
        max-width: 800px;
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

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
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

    .preview-image {
        max-width: 200px;
        max-height: 150px;
        border-radius: var(--radius-md);
        margin-top: var(--space-md);
        display: none;
    }

    .form-actions {
        display: flex;
        gap: var(--space-md);
        padding-top: var(--space-lg);
        border-top: 1px solid var(--card-border);
        margin-top: var(--space-xl);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-lg);
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')

<div class="form-card">
    <div class="form-header">
        <h2><i class="fas fa-folder-plus" style="color: var(--purple-500); margin-right: var(--space-sm);"></i> Add New Category</h2>
        <p>Create a new product category for your store</p>
    </div>

    <form method="POST" action="{{ url('/admin/addcategroy') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Category Name <span class="required">*</span></label>
                <input type="text" name="categroy" class="form-control" value="{{ old('categroy') }}" placeholder="Enter category name">
                @error('categroy')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Status <span class="required">*</span></label>
                <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Category Image</label>
            <div class="file-upload" onclick="document.getElementById('categoryImage').click()">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Click to upload image or drag and drop</p>
                <p style="font-size: var(--text-xs); margin-top: var(--space-xs);">PNG, JPG, GIF up to 2MB</p>
                <input type="file" id="categoryImage" name="image" accept="image/*">
            </div>
            <img id="imagePreview" class="preview-image" alt="Preview">
            @error('image')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="editor" class="form-control" placeholder="Enter category description (optional)">{{ old('editor') }}</textarea>
            @error('editor')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ url('/admin/viewcategroy') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Category
            </button>
        </div>
    </form>
</div>

@endsection

@push('page-scripts')
<script>
    // Image preview
    document.getElementById('categoryImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
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
            document.getElementById('categoryImage').files = files;
            const event = new Event('change');
            document.getElementById('categoryImage').dispatchEvent(event);
        }
    });
</script>
@endpush
