@extends('layouts.redesign.admin')

@section('page-title', 'Add Testimonial')
@section('breadcrumb')
    <a href="{{ url('/admin/testimoniallist') }}">Testimonials</a>
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
        min-height: 150px;
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
        max-width: 120px;
        max-height: 120px;
        border-radius: 50%;
        margin-top: var(--space-md);
        display: none;
        border: 3px solid var(--purple-500);
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
        grid-template-columns: 200px 1fr;
        gap: var(--space-xl);
        align-items: start;
    }

    .testimonial-preview {
        background: var(--bg-secondary);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        margin-bottom: var(--space-xl);
    }

    .testimonial-preview-header {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        margin-bottom: var(--space-md);
    }

    .testimonial-preview-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--purple-100);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--purple-500);
    }

    .testimonial-preview-name {
        font-weight: var(--font-semibold);
        color: var(--text-primary);
    }

    .testimonial-preview-stars {
        color: var(--amber-400);
    }

    .testimonial-preview-text {
        font-style: italic;
        color: var(--text-secondary);
        font-size: var(--text-sm);
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
        <h2><i class="fas fa-quote-right" style="color: var(--purple-500); margin-right: var(--space-sm);"></i> Add New Testimonial</h2>
        <p>Add a customer testimonial to showcase on your website</p>
    </div>

    <div class="testimonial-preview">
        <div class="testimonial-preview-header">
            <div class="testimonial-preview-avatar" id="previewAvatar">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <div class="testimonial-preview-name" id="previewName">Customer Name</div>
                <div class="testimonial-preview-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
        <div class="testimonial-preview-text" id="previewText">"Your testimonial will appear here..."</div>
    </div>

    <form method="POST" action="{{ url('/admin/savetestimonial') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Customer Photo</label>
                <div class="file-upload" onclick="document.getElementById('customerImage').click()">
                    <i class="fas fa-user-circle"></i>
                    <p>Upload photo</p>
                    <input type="file" id="customerImage" name="image" accept="image/*">
                </div>
                <img id="imagePreview" class="preview-image" alt="Preview">
                @error('image')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="form-group">
                    <label class="form-label">Customer Name <span class="required">*</span></label>
                    <input type="text" name="name" id="customerName" class="form-control" value="{{ old('name') }}" placeholder="Enter customer name">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Testimonial <span class="required">*</span></label>
                    <textarea name="description" id="testimonialText" class="form-control" placeholder="Enter the customer's testimonial...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ url('/admin/testimoniallist') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Testimonial
            </button>
        </div>
    </form>
</div>

@endsection

@push('page-scripts')
<script>
    // Image preview
    document.getElementById('customerImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                preview.src = e.target.result;
                preview.style.display = 'block';

                // Update preview avatar
                const previewAvatar = document.getElementById('previewAvatar');
                previewAvatar.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">`;
            };
            reader.readAsDataURL(file);
        }
    });

    // Live preview for name
    document.getElementById('customerName').addEventListener('input', function() {
        document.getElementById('previewName').textContent = this.value || 'Customer Name';
    });

    // Live preview for testimonial text
    document.getElementById('testimonialText').addEventListener('input', function() {
        document.getElementById('previewText').textContent = this.value ? `"${this.value}"` : '"Your testimonial will appear here..."';
    });
</script>
@endpush
