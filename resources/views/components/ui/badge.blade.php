@props([
    'color' => 'purple',
    'size' => 'md',
    'dot' => false,
])

@php
    $classes = 'badge badge-' . $color;
    $classes .= $size !== 'md' ? ' badge-' . $size : '';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if($dot)
        <span class="badge-dot"></span>
    @endif
    {{ $slot }}
</span>
