@props([
    'label' => null,
    'name',
    'type' => 'text',
    'id' => null,
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => null,
    'hint' => null,
    'icon' => null,
])

@php
    $inputId = $id ?? $name;
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

    <div class="input-wrapper {{ $icon ? 'has-icon' : '' }}">
        @if($icon)
            <i class="{{ $icon }} input-icon"></i>
        @endif

        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $inputId }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'form-control' . ($hasError ? ' is-invalid' : '')]) }}
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
        >
    </div>

    @if($hint && !$hasError)
        <small class="form-hint text-muted">{{ $hint }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
</div>
