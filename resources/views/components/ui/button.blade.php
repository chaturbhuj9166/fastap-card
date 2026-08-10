@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'icon' => null,
    'iconPosition' => 'left',
    'loading' => false,
    'disabled' => false,
])

@php
    $classes = 'btn';
    $classes .= ' btn-' . $variant;
    $classes .= $size !== 'md' ? ' btn-' . $size : '';
    $classes .= $icon ? ' btn-icon' : '';
    $classes .= $loading ? ' is-loading' : '';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'left')
            <i class="{{ $icon }}"></i>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'right')
            <i class="{{ $icon }}"></i>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }} @if($disabled || $loading) disabled @endif>
        @if($loading)
            <i class="fas fa-spinner spin"></i>
        @elseif($icon && $iconPosition === 'left')
            <i class="{{ $icon }}"></i>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'right' && !$loading)
            <i class="{{ $icon }}"></i>
        @endif
    </button>
@endif
