@props([
    'label' => null,
    'name',
    'id' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => 'Select an option',
    'required' => false,
    'disabled' => false,
    'error' => null,
])

@php
    $inputId = $id ?? $name;
    $hasError = $error || $errors->has($name);
    $selectedValue = old($name, $selected);
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

    <select
        name="{{ $name }}"
        id="{{ $inputId }}"
        {{ $attributes->merge(['class' => 'form-control form-select' . ($hasError ? ' is-invalid' : '')]) }}
        @if($required) required @endif
        @if($disabled) disabled @endif
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach($options as $value => $label)
            <option value="{{ $value }}" @if($selectedValue == $value) selected @endif>
                {{ $label }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
