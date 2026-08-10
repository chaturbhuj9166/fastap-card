@extends('layouts.redesign.dashboard')

@section('page-title', 'Edit Product')
@section('breadcrumb', 'Edit Product')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Edit Product</h1>
            <p>Update your product details</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/myproducts') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ url('/updatemyproduct') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $myproducts->id }}">

        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-box"></i> Product Details</h3>
            </div>
            <div class="form-card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Product Title <span class="required">*</span></label>
                        <input type="text" id="title" name="title"
                               value="{{ old('title', $myproducts->title) }}"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="Enter product name" required>
                        @error('title')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price (₹) <span class="required">*</span></label>
                        <input type="number" id="price" name="price"
                               value="{{ old('price', $myproducts->price) }}"
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
                        <input type="number" id="mrp_price" name="mrp_price"
                               value="{{ old('mrp_price', $myproducts->mrp_price) }}"
                               class="form-control @error('mrp_price') is-invalid @enderror"
                               placeholder="Original price (for discount display)" min="0" step="0.01">
                        @error('mrp_price')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                        <small class="form-hint">Set higher than selling price to show discount</small>
                    </div>
                    <div class="form-group">
                        <label for="buy_link">Buy Link</label>
                        <input type="url" id="buy_link" name="buy_link"
                               value="{{ old('buy_link', $myproducts->buy_link) }}"
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
                              placeholder="Describe your product...">{{ old('description', $myproducts->description) }}</textarea>
                    @error('description')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Current Images</label>
                    @php
                        $images = json_decode($myproducts->images, true);
                    @endphp
                    @if(is_array($images) && count($images) > 0)
                        <div class="current-images-grid">
                            @foreach($images as $index => $image)
                                <div class="current-image-item">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Product Image {{ $index + 1 }}">
                                    <div class="image-overlay">
                                        <span class="image-number">{{ $index + 1 }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No images uploaded</p>
                    @endif
                </div>

                <div class="form-group">
                    <label>Replace Images</label>
                    <div class="file-upload-area" id="productUploadArea">
                        <div class="file-upload-content">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Drag & drop new images here or <span class="browse-link">browse</span></p>
                            <small>Leave empty to keep current images</small>
                        </div>
                        <input type="file" id="images" name="images[]" accept="image/jpeg,image/png,image/jpg,image/webp" multiple class="file-input">
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
                    <i class="fas fa-save"></i> Update Product
                </button>
                <a href="{{ url('/myproducts') }}" class="btn btn-outline btn-lg">Cancel</a>
            </div>
        </div>
    </form>
</div>

<style>
.current-images-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 1rem;
    margin-top: 0.5rem;
}

.current-image-item {
    position: relative;
    width: 100%;
    padding-top: 100%;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.current-image-item img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.7));
    padding: 1rem 0.5rem 0.5rem;
}

.image-number {
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
}

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
                    div.innerHTML = `<img src="${e.target.result}" alt="Preview ${index + 1}">`;
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
