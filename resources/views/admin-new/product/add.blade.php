@extends('layouts.redesign.admin')

@section('page-title', 'Add Product')
@section('breadcrumb')
    <a href="{{ url('/admin/view-product') }}">Products</a>
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
        padding-bottom: var(--space-sm);
        border-bottom: 1px solid var(--card-border);
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-lg);
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
        flex-wrap: wrap;
        gap: var(--space-md);
        margin-top: var(--space-md);
    }

    .preview-image {
        width: 100px;
        height: 80px;
        object-fit: cover;
        border-radius: var(--radius-md);
        border: 1px solid var(--card-border);
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon .form-control {
        padding-left: var(--space-xl);
    }

    .input-with-icon .icon {
        position: absolute;
        left: var(--space-md);
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .form-actions {
        display: flex;
        gap: var(--space-md);
        padding-top: var(--space-lg);
        border-top: 1px solid var(--card-border);
        margin-top: var(--space-xl);
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
        <h2><i class="fas fa-box" style="color: var(--purple-500); margin-right: var(--space-sm);"></i> Add New Product</h2>
        <p>Create a new product for your store</p>
    </div>

    <form action="{{ url('/admin/add-product') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Information -->
        <div class="form-section">
            <h3 class="form-section-title"><i class="fas fa-info-circle" style="margin-right: var(--space-sm); color: var(--purple-500);"></i> Basic Information</h3>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Product Name <span class="required">*</span></label>
                    <input type="text" name="pro_name" class="form-control" value="{{ old('pro_name') }}" placeholder="Enter product name">
                    @error('pro_name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Commission (%) <span class="required">*</span></label>
                    <div class="input-with-icon">
                        <span class="icon"><i class="fas fa-percent"></i></span>
                        <input type="number" name="commission" class="form-control" value="{{ old('commission') }}" placeholder="0" min="0" max="99" maxlength="2">
                    </div>
                    @error('commission')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
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

        <!-- Pricing -->
        <div class="form-section">
            <h3 class="form-section-title"><i class="fas fa-rupee-sign" style="margin-right: var(--space-sm); color: var(--green-500);"></i> Pricing</h3>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Selling Price <span class="required">*</span></label>
                    <div class="input-with-icon">
                        <span class="icon"><i class="fas fa-rupee-sign"></i></span>
                        <input type="number" name="pro_price" class="form-control" value="{{ old('pro_price') }}" placeholder="0.00" min="0">
                    </div>
                    @error('pro_price')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">MRP Price <span class="required">*</span></label>
                    <div class="input-with-icon">
                        <span class="icon"><i class="fas fa-rupee-sign"></i></span>
                        <input type="number" name="pro_mrp" class="form-control" value="{{ old('pro_mrp') }}" placeholder="0.00" min="0">
                    </div>
                    @error('pro_mrp')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Images -->
        <div class="form-section">
            <h3 class="form-section-title"><i class="fas fa-images" style="margin-right: var(--space-sm); color: var(--blue-500);"></i> Product Images</h3>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Main Image <span class="required">*</span></label>
                    <div class="file-upload" onclick="document.getElementById('mainImage').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Click to upload main product image</p>
                        <p style="font-size: var(--text-xs); margin-top: var(--space-xs);">PNG, JPG up to 2MB</p>
                        <input type="file" id="mainImage" name="pro_img" accept="image/*">
                    </div>
                    <div class="preview-container">
                        <img id="mainImagePreview" class="preview-image" style="display: none;" alt="Preview">
                    </div>
                    @error('pro_img')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Additional Images</label>
                    <div class="file-upload" onclick="document.getElementById('multiImages').click()">
                        <i class="fas fa-images"></i>
                        <p>Click to upload additional images</p>
                        <p style="font-size: var(--text-xs); margin-top: var(--space-xs);">Select multiple images</p>
                        <input type="file" id="multiImages" name="pro_multi_img[]" accept="image/*" multiple>
                    </div>
                    <div class="preview-container" id="multiImagePreview"></div>
                    @error('pro_multi_img')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="form-section">
            <h3 class="form-section-title"><i class="fas fa-align-left" style="margin-right: var(--space-sm); color: var(--amber-500);"></i> Description</h3>

            <div class="form-group">
                <label class="form-label">About Product</label>
                <textarea name="editor" class="form-control" placeholder="Enter detailed product description...">{{ old('editor') }}</textarea>
                @error('editor')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ url('/admin/view-product') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Product
            </button>
        </div>
    </form>
</div>

@endsection

@push('page-scripts')
<script>
    // Main image preview
    document.getElementById('mainImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('mainImagePreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // Multiple images preview
    document.getElementById('multiImages').addEventListener('change', function(e) {
        const container = document.getElementById('multiImagePreview');
        container.innerHTML = '';

        Array.from(e.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'preview-image';
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush
