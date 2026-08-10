@props([
    'id',
    'title' => '',
    'size' => 'md',
    'footer' => null,
])

<!-- Modal Backdrop -->
<div class="modal-backdrop" id="{{ $id }}-backdrop"></div>

<!-- Modal -->
<div {{ $attributes->merge(['class' => 'modal modal-' . $size, 'id' => $id]) }} role="dialog" aria-modal="true">
    <div class="modal-header">
        <h3 class="modal-title">{{ $title }}</h3>
        <button type="button" class="modal-close" data-modal-close aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="modal-body">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="modal-footer">
            {{ $footer }}
        </div>
    @endif
</div>
