@props([
    'label' => null,
    'name',
    'id' => null,
    'placeholder' => '',
    'value' => '',
    'rows' => 4,
    'required' => false,
    'disabled' => false,
    'error' => null,
    'hint' => null,
    'maxlength' => null,
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

    <textarea
        name="{{ $name }}"
        id="{{ $inputId }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'form-control' . ($hasError ? ' is-invalid' : '')]) }}
        @if($required) required @endif
        @if($disabled) disabled @endif
        @if($maxlength) maxlength="{{ $maxlength }}" @endif
    >{{ old($name, $value) }}</textarea>

    @if($maxlength)
        <small class="form-hint text-muted char-count">
            <span class="current">0</span>/{{ $maxlength }}
        </small>
    @endif

    @if($hint && !$hasError)
        <small class="form-hint text-muted">{{ $hint }}</small>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
