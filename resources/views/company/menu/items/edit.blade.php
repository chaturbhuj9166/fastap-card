@extends('layouts.redesign.company')

@section('page-title', 'Edit Menu Item')
@section('breadcrumb')
<a href="{{ url('/company/menu') }}">Menu</a>
<span class="breadcrumb-separator">/</span>
<a href="{{ url('/company/menu/category/' . $item->category_id . '/items') }}">{{ $item->category->name }}</a>
<span class="breadcrumb-separator">/</span>
Edit
@endsection

@section('company-content')
<div class="form-page">
    <div class="form-card">
        <div class="form-header">
            <h2><i class="fas fa-edit"></i> Edit Menu Item</h2>
            <p>Update {{ $item->name }}</p>
        </div>

        <form action="{{ route('company.menu.item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-section">
                <h3 class="section-title">Basic Information</h3>

                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id', $item->category_id) == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Item Name *</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $item->name) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="3">{{ old('description', $item->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Price (?) *</label>
                        <input type="number" name="price" class="form-input" step="0.01" min="0" value="{{ old('price', $item->price) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Dietary Type *</label>
                        <select name="dietary_type" class="form-select" required>
                            <option value="veg" {{ old('dietary_type', $item->dietary_type) == 'veg' ? 'selected' : '' }}>Vegetarian</option>
                            <option value="non_veg" {{ old('dietary_type', $item->dietary_type) == 'non_veg' ? 'selected' : '' }}>Non-Vegetarian</option>
                            <option value="egg" {{ old('dietary_type', $item->dietary_type) == 'egg' ? 'selected' : '' }}>Contains Egg</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Spice Level</label>
                        <select name="spice_level" class="form-select">
                            <option value="">No Spice Info</option>
                            <option value="mild" {{ old('spice_level', $item->spice_level) == 'mild' ? 'selected' : '' }}>Mild</option>
                            <option value="medium" {{ old('spice_level', $item->spice_level) == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="hot" {{ old('spice_level', $item->spice_level) == 'hot' ? 'selected' : '' }}>Hot</option>
                            <option value="extra_hot" {{ old('spice_level', $item->spice_level) == 'extra_hot' ? 'selected' : '' }}>Extra Hot</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Preparation Time</label>
                        <input type="text" name="preparation_time" class="form-input" value="{{ old('preparation_time', $item->preparation_time) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Serves</label>
                    <input type="text" name="serves" class="form-input" value="{{ old('serves', $item->serves) }}">
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-title">Item Image</h3>
                <div class="form-group">
                    <div class="file-upload-area" id="uploadArea">
                        <input type="file" name="image" id="itemImage" accept="image/*" hidden>
                        <div class="upload-placeholder" id="uploadPlaceholder" style="{{ $item->image ? 'display:none' : '' }}">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click or drag to upload image</p>
                            <span>Max 2MB, JPG/PNG</span>
                        </div>
                        <div class="upload-preview" id="uploadPreview" style="{{ $item->image ? '' : 'display:none' }}">
                            <img id="previewImage" src="{{ $item->image ? asset('uploads/menu/items/' . $item->image) : '' }}" alt="Preview">
                            <button type="button" class="remove-image" onclick="removeImage()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-title">Variants (Optional)</h3>
                <p class="section-desc">Add size/portion variants with different prices</p>

                <div id="variantsContainer">
                    @if($item->variants && count($item->variants) > 0)
                        @foreach($item->variants as $index => $variant)
                        <div class="variant-row">
                            <input type="text" name="variants[{{ $index }}][name]" class="form-input" placeholder="e.g., Half" value="{{ $variant['name'] ?? '' }}">
                            <input type="number" name="variants[{{ $index }}][price]" class="form-input" step="0.01" min="0" placeholder="Price" value="{{ $variant['price'] ?? '' }}">
                            <button type="button" class="btn btn-sm btn-outline remove-variant" onclick="removeVariant(this)" style="{{ count($item->variants) > 1 ? '' : 'display: none;' }}">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        @endforeach
                    @else
                    <div class="variant-row">
                        <input type="text" name="variants[0][name]" class="form-input" placeholder="e.g., Half">
                        <input type="number" name="variants[0][price]" class="form-input" step="0.01" min="0" placeholder="Price">
                        <button type="button" class="btn btn-sm btn-outline remove-variant" onclick="removeVariant(this)" style="display: none;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @endif
                </div>
                <button type="button" class="btn btn-sm btn-outline" onclick="addVariant()" style="margin-top: 0.5rem;">
                    <i class="fas fa-plus"></i> Add Variant
                </button>
            </div>

            <div class="form-section">
                <h3 class="section-title">Tags</h3>
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_bestseller" value="1" {{ old('is_bestseller', $item->is_bestseller) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        <span><i class="fas fa-star text-warning"></i> Mark as Bestseller</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_chefs_special" value="1" {{ old('is_chefs_special', $item->is_chefs_special) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        <span><i class="fas fa-fire text-danger"></i> Today's Special</span>
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ url('/company/menu/category/' . $item->category_id . '/items') }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@push('page-styles')
<style>
    .form-page { max-width: 700px; }
    .form-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
    }
    .form-header { margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border-color); }
    .form-header h2 { font-size: 1.25rem; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem; }
    .form-header p { color: var(--text-muted); font-size: 0.9rem; }
    .form-section { margin-bottom: 1.5rem; }
    .section-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #0891b2;
        display: inline-block;
    }
    .section-desc { color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1rem; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    @media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }
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
    .upload-preview img { width: 150px; height: 150px; border-radius: 0.75rem; object-fit: cover; }
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
    .variant-row {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }
    .variant-row .form-input { flex: 1; margin-bottom: 0; }
    .checkbox-group { display: flex; flex-direction: column; gap: 0.75rem; }
    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
    }
    .checkbox-label input { width: 18px; height: 18px; }
    .text-warning { color: #f59e0b !important; }
    .text-danger { color: #ef4444 !important; }
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
    // Image upload
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('itemImage');
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

    // Variants
    let variantIndex = {{ ($item->variants && count($item->variants) > 0) ? count($item->variants) : 1 }};
    function addVariant() {
        const container = document.getElementById('variantsContainer');
        const row = document.createElement('div');
        row.className = 'variant-row';
        row.innerHTML = `
            <input type="text" name="variants[${variantIndex}][name]" class="form-input" placeholder="e.g., Full">
            <input type="number" name="variants[${variantIndex}][price]" class="form-input" step="0.01" min="0" placeholder="Price">
            <button type="button" class="btn btn-sm btn-outline remove-variant" onclick="removeVariant(this)">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(row);
        variantIndex++;
        updateRemoveButtons();
    }

    function removeVariant(btn) {
        btn.closest('.variant-row').remove();
        updateRemoveButtons();
    }

    function updateRemoveButtons() {
        const rows = document.querySelectorAll('.variant-row');
        rows.forEach((row, index) => {
            const removeBtn = row.querySelector('.remove-variant');
            if (removeBtn) {
                removeBtn.style.display = rows.length > 1 ? 'block' : 'none';
            }
        });
    }
</script>
@endpush
@endsection

