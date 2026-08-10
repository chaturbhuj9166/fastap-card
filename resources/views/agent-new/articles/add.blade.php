@extends('layouts.redesign.agent')

@section('page-title', 'Add Article')
@section('breadcrumb')
    <a href="{{ url('/agent/articles') }}">Articles</a>
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
        max-width: 900px;
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

    .form-section {
        margin-bottom: var(--space-xl);
    }

    .form-section-title {
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-md);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .form-section-title i {
        color: var(--green-500);
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
        border-color: var(--green-500);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .form-control::placeholder {
        color: var(--text-muted);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    textarea.form-control.tall {
        min-height: 200px;
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
        border-color: var(--green-500);
        background: rgba(16, 185, 129, 0.05);
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
        max-width: 300px;
        max-height: 200px;
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

    .form-hint {
        font-size: var(--text-xs);
        color: var(--text-muted);
        margin-top: var(--space-xs);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--green-500), var(--green-600));
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--green-600), var(--green-700));
    }

    .article-preview {
        background: var(--bg-secondary);
        border-radius: var(--radius-lg);
        overflow: hidden;
        margin-bottom: var(--space-xl);
    }

    .article-preview-image {
        width: 100%;
        height: 150px;
        background: linear-gradient(135deg, var(--green-100), var(--green-200));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--green-500);
        font-size: 48px;
    }

    .article-preview-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .article-preview-content {
        padding: var(--space-lg);
    }

    .article-preview-meta {
        display: flex;
        gap: var(--space-md);
        font-size: var(--text-xs);
        color: var(--text-muted);
        margin-bottom: var(--space-sm);
    }

    .article-preview-title {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
    }

    .article-preview-desc {
        font-size: var(--text-sm);
        color: var(--text-secondary);
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('agent-content')

<div class="form-card">
    <div class="form-header">
        <h2><i class="fas fa-newspaper" style="color: var(--green-500); margin-right: var(--space-sm);"></i> Add New Article</h2>
        <p>Create a new blog article or news post</p>
    </div>

    <div class="article-preview">
        <div class="article-preview-image" id="previewImageContainer">
            <i class="fas fa-image"></i>
        </div>
        <div class="article-preview-content">
            <div class="article-preview-meta">
                <span id="previewDate"><i class="fas fa-calendar"></i> Select date</span>
                <span id="previewAuthor"><i class="fas fa-user"></i> Author name</span>
            </div>
            <div class="article-preview-title" id="previewTitle">Article title will appear here</div>
            <div class="article-preview-desc" id="previewDesc">Short description preview...</div>
        </div>
    </div>

    <form method="POST" action="{{ url('/agent/addarticle/store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Basic Information -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-info-circle"></i> Basic Information
            </h3>

            <div class="form-group">
                <label class="form-label">Article Title <span class="required">*</span></label>
                <input type="text" name="title" id="articleTitle" class="form-control" value="{{ old('title') }}" placeholder="Enter article title">
                @error('title')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Featured Image</label>
                <div class="file-upload" onclick="document.getElementById('articleImage').click()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Click to upload article image</p>
                    <p style="font-size: var(--text-xs); margin-top: var(--space-xs);">PNG, JPG, GIF up to 2MB</p>
                    <input type="file" id="articleImage" name="image" accept="image/*">
                </div>
                <img id="imagePreview" class="preview-image" alt="Preview">
                @error('image')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Short Description <span class="required">*</span></label>
                <textarea name="short_desc" id="shortDesc" class="form-control" placeholder="Enter a brief summary of the article">{{ old('short_desc') }}</textarea>
                <p class="form-hint">This will appear in article listings and previews</p>
                @error('short_desc')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Article Content -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-file-alt"></i> Article Content
            </h3>

            <div class="form-group">
                <label class="form-label">Full Content <span class="required">*</span></label>
                <textarea name="long_desc" id="longDesc" class="form-control tall" placeholder="Write your full article content here...">{{ old('long_desc') }}</textarea>
                <p class="form-hint">You can use HTML for formatting</p>
                @error('long_desc')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Publishing Details -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-calendar-alt"></i> Publishing Details
            </h3>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Post Date <span class="required">*</span></label>
                    <input type="date" name="post_date" id="postDate" class="form-control" value="{{ old('post_date', date('Y-m-d')) }}">
                    @error('post_date')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Author Name <span class="required">*</span></label>
                    <input type="text" name="post_by" id="postBy" class="form-control" value="{{ old('post_by') }}" placeholder="Enter author name">
                    @error('post_by')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ url('/agent/articles') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Publish Article
            </button>
        </div>
    </form>
</div>

@endsection

@push('page-scripts')
<script>
    // Image preview
    document.getElementById('articleImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                preview.src = e.target.result;
                preview.style.display = 'block';

                // Update article preview
                const previewContainer = document.getElementById('previewImageContainer');
                previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        }
    });

    // Live preview for title
    document.getElementById('articleTitle').addEventListener('input', function() {
        document.getElementById('previewTitle').textContent = this.value || 'Article title will appear here';
    });

    // Live preview for short description
    document.getElementById('shortDesc').addEventListener('input', function() {
        document.getElementById('previewDesc').textContent = this.value || 'Short description preview...';
    });

    // Live preview for date
    document.getElementById('postDate').addEventListener('change', function() {
        const date = new Date(this.value);
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        document.getElementById('previewDate').innerHTML = `<i class="fas fa-calendar"></i> ${date.toLocaleDateString('en-US', options)}`;
    });

    // Live preview for author
    document.getElementById('postBy').addEventListener('input', function() {
        document.getElementById('previewAuthor').innerHTML = `<i class="fas fa-user"></i> ${this.value || 'Author name'}`;
    });

    // Drag and drop
    const uploadArea = document.querySelector('.file-upload');

    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = 'var(--green-500)';
        this.style.background = 'rgba(16, 185, 129, 0.05)';
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
            document.getElementById('articleImage').files = files;
            const event = new Event('change');
            document.getElementById('articleImage').dispatchEvent(event);
        }
    });
</script>
@endpush
