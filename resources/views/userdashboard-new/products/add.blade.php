@extends('layouts.redesign.dashboard')

@section('page-title', 'Add Product')
@section('breadcrumb', 'Add Product')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Add Product</h1>
            <p>Add a new product to your store</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/myproducts') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ url('/savemyproduct') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-box"></i> Product Details</h3>
            </div>
            <div class="form-card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Product Title <span class="required">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="Enter product name" required>
                        @error('title')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price (₹) <span class="required">*</span></label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}"
                               class="form-control @error('price') is-invalid @enderror"
                               placeholder="0.00" min="0" step="0.01" required>
                        @error('price')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="mrp_price">MRP Price (₹)</label>
                        <input type="number" id="mrp_price" name="mrp_price" value="{{ old('mrp_price') }}"
                               class="form-control @error('mrp_price') is-invalid @enderror"
                               placeholder="Original price (for discount display)" min="0" step="0.01">
                        @error('mrp_price')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                        <small class="form-hint">Set higher than selling price to show discount</small>
                    </div>
                    <div class="form-group">
                        <label for="buy_link">Buy Link</label>
                        <input type="url" id="buy_link" name="buy_link" value="{{ old('buy_link') }}"
                               class="form-control @error('buy_link') is-invalid @enderror"
                               placeholder="https://...">
                        @error('buy_link')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                        <small class="form-hint">External purchase link (optional)</small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Describe your product...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Product Images <span class="required">*</span></label>
                    <div class="file-upload-area" id="productUploadArea">
                        <div class="file-upload-content">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Drag & drop images here or <span class="browse-link">browse</span></p>
                            <small>Supports: JPG, PNG, WEBP (Max 1MB each)</small>
                        </div>
                        <input type="file" id="images" name="images[]" accept="image/jpeg,image/png,image/jpg,image/webp" multiple class="file-input" required>
                    </div>
                    @error('images')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    @error('images.*')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    <div id="imagePreviewContainer" class="image-preview-grid"></div>
                </div>
            </div>
            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Save Product
                </button>
                <a href="{{ url('/myproducts') }}" class="btn btn-outline btn-lg">Cancel</a>
            </div>
        </div>
    </form>
</div>

<style>
.image-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.image-preview-item {
    position: relative;
    width: 100%;
    padding-top: 100%;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.image-preview-item img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-preview-item .remove-preview {
    position: absolute;
    top: 5px;
    right: 5px;
    width: 24px;
    height: 24px;
    background: rgba(231, 76, 60, 0.9);
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.2s;
}

.image-preview-item:hover .remove-preview {
    opacity: 1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('productUploadArea');
    const fileInput = document.getElementById('images');
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
        fileInput.files = e.dataTransfer.files;
        handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        previewContainer.innerHTML = '';
        Array.from(files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const div = document.createElement('div');
                    div.className = 'image-preview-item';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index + 1}">
                        <button type="button" class="remove-preview" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@include('userdashboard-new.partials.form-page-styles')
@endsection
