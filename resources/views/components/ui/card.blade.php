@props([
    'title' => null,
    'subtitle' => null,
    'icon' => null,
    'iconColor' => 'purple',
    'footer' => null,
    'padding' => true,
    'hover' => true,
])

<div {{ $attributes->merge(['class' => 'card' . ($hover ? '' : ' no-hover')]) }}>
    @if($icon)
        <div class="card-icon card-icon-{{ $iconColor }}">
            <i class="{{ $icon }}"></i>
        </div>
    @endif

    @if($title)
        <h3 class="card-title">{{ $title }}</h3>
    @endif

    @if($subtitle)
        <p class="card-subtitle text-muted">{{ $subtitle }}</p>
    @endif

    <div class="{{ $padding ? '' : 'p-0' }}">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
