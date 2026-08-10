@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => false,
    'icon' => null,
])

@php
    $icons = [
        'success' => 'fas fa-check-circle',
        'error' => 'fas fa-times-circle',
        'warning' => 'fas fa-exclamation-triangle',
        'info' => 'fas fa-info-circle',
    ];
    $alertIcon = $icon ?? ($icons[$type] ?? $icons['info']);
@endphp

<div {{ $attributes->merge(['class' => 'alert alert-' . $type]) }} role="alert">
    <div class="alert-content">
        <i class="{{ $alertIcon }} alert-icon"></i>
        <div class="alert-text">
            @if($title)
                <strong class="alert-title">{{ $title }}</strong>
            @endif
            <span class="alert-message">{{ $slot }}</span>
        </div>
    </div>
    @if($dismissible)
        <button type="button" class="alert-dismiss" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    @endif
</div>
