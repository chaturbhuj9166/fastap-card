@props([
    'label' => null,
    'name',
    'id' => null,
    'accept' => 'image/*',
    'multiple' => false,
    'required' => false,
    'preview' => true,
    'currentImage' => null,
    'hint' => 'Drag and drop or click to upload',
    'error' => null,
])

@php
    $inputId = $id ?? $name;
    $previewId = $inputId . '-preview';
    $hasError = $error || $errors->has($name);
@endphp

<div class="form-group">
    @if($label)
        <label for="{{ $inputId }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <div class="file-upload-wrapper {{ $hasError ? 'is-invalid' : '' }}">
        <input
            type="file"
            name="{{ $name }}"
            id="{{ $inputId }}"
            accept="{{ $accept }}"
            class="file-upload-input"
            @if($multiple) multiple @endif
            @if($required) required @endif
            @if($preview) data-preview="{{ $previewId }}" @endif
        >

        <div class="file-upload-content">
            <div class="file-upload-icon">
                <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <p class="file-upload-text">{{ $hint }}</p>
            <span class="file-upload-btn btn btn-sm btn-secondary">Browse Files</span>
        </div>

        @if($preview)
            <div class="file-upload-preview" id="{{ $previewId }}-container">
                <img
                    src="{{ $currentImage ?? '' }}"
                    alt="Preview"
                    id="{{ $previewId }}"
                    style="{{ $currentImage ? '' : 'display: none;' }}"
                >
            </div>
        @endif
    </div>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<style>
.file-upload-wrapper {
    position: relative;
    border: 2px dashed var(--border-light);
    border-radius: var(--radius-lg);
    padding: var(--space-xl);
    text-align: center;
    transition: all var(--transition-base);
    cursor: pointer;
}

.file-upload-wrapper:hover {
    border-color: var(--purple-400);
    background: rgba(124, 58, 237, 0.02);
}

.file-upload-wrapper.is-invalid {
    border-color: #ef4444;
}

.file-upload-input {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
}

.file-upload-icon {
    font-size: 2.5rem;
    color: var(--purple-400);
    margin-bottom: var(--space-md);
}

.file-upload-text {
    color: var(--text-secondary);
    margin-bottom: var(--space-md);
}

.file-upload-preview {
    margin-top: var(--space-md);
}

.file-upload-preview img {
    max-width: 200px;
    max-height: 200px;
    border-radius: var(--radius-md);
    object-fit: cover;
}
</style>
