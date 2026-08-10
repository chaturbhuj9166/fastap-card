@extends('layouts.redesign.company')

@section('page-title', $category->name . ' - Items')
@section('breadcrumb')
<a href="{{ url('/company/menu') }}">Menu</a>
<span class="breadcrumb-separator">/</span>
{{ $category->name }}
@endsection

@section('company-content')
<div class="items-page">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h2>{{ $category->name }}</h2>
            <p>{{ $items->total() }} items in this category</p>
        </div>
        <div class="page-header-right">
            <a href="{{ url('/company/menu') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ url('/company/menu/item/create?category=' . $category->id) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Item
            </a>
        </div>
    </div>

    <!-- Items Grid -->
    @if($items->count() > 0)
    <div class="items-grid" id="itemsGrid">
        @foreach($items as $item)
        <div class="item-card" data-id="{{ $item->id }}">
            <div class="item-image">
                @if($item->image)
                    <img src="{{ asset('uploads/menu/items/' . $item->image) }}" alt="{{ $item->name }}">
                @else
                    <div class="item-placeholder">
                        <i class="fas fa-utensils"></i>
                    </div>
                @endif
                <div class="item-badges">
                    <span class="dietary-badge {{ $item->dietary_type }}">
                        @if($item->dietary_type == 'veg')
                            <i class="fas fa-circle"></i>
                        @elseif($item->dietary_type == 'egg')
                            <i class="fas fa-egg"></i>
                        @else
                            <i class="fas fa-drumstick-bite"></i>
                        @endif
                    </span>
                    @if($item->is_bestseller)
                        <span class="bestseller-badge"><i class="fas fa-star"></i></span>
                    @endif
                    @if($item->is_chefs_special)
                        <span class="special-badge"><i class="fas fa-fire"></i></span>
                    @endif
                </div>
                @if(!$item->is_available)
                    <div class="unavailable-overlay">
                        <span>Unavailable</span>
                    </div>
                @endif
            </div>
            <div class="item-content">
                <h4>{{ $item->name }}</h4>
                @if($item->description)
                    <p class="item-description">{{ Str::limit($item->description, 60) }}</p>
                @endif
                <div class="item-price">
                    <span class="price">?{{ number_format($item->price, 2) }}</span>
                    @if($item->spice_level)
                        <span class="spice-level spice-{{ $item->spice_level }}">
                            @for($i = 0; $i < ['mild' => 1, 'medium' => 2, 'hot' => 3, 'extra_hot' => 4][$item->spice_level]; $i++)
                                <i class="fas fa-pepper-hot"></i>
                            @endfor
                        </span>
                    @endif
                </div>
                @if($item->variants && count($item->variants) > 0)
                    <div class="variants-count">{{ count($item->variants) }} variant(s)</div>
                @endif
            </div>
            <div class="item-actions">
                <form action="{{ route('company.menu.item.toggle', $item->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline" title="{{ $item->is_available ? 'Mark Unavailable' : 'Mark Available' }}">
                        <i class="fas {{ $item->is_available ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }}"></i>
                    </button>
                </form>
                <form action="{{ route('company.menu.item.bestseller', $item->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline" title="{{ $item->is_bestseller ? 'Remove Bestseller' : 'Mark Bestseller' }}">
                        <i class="fas fa-star {{ $item->is_bestseller ? 'text-warning' : '' }}"></i>
                    </button>
                </form>
                <a href="{{ url('/company/menu/item/' . $item->id . '/edit') }}" class="btn btn-sm btn-outline" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('company.menu.item.delete', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this item?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline text-danger" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        {{ $items->withQueryString()->links() }}
    </div>
    @else
    <div class="empty-state-card">
        <div class="empty-state">
            <i class="fas fa-utensils"></i>
            <h3>No Items Yet</h3>
            <p>Start by adding your first menu item to this category</p>
            <a href="{{ url('/company/menu/item/create?category=' . $category->id) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Item
            </a>
        </div>
    </div>
    @endif
</div>

@push('page-styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .page-header h2 { font-size: 1.5rem; margin-bottom: 0.25rem; }
    .page-header p { color: var(--text-muted); font-size: 0.9rem; }
    .page-header-right { display: flex; gap: 0.75rem; }
    .items-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.25rem;
    }
    .item-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s;
    }
    .item-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }
    .item-image {
        position: relative;
        height: 160px;
        background: var(--bg-secondary);
    }
    .item-image img { width: 100%; height: 100%; object-fit: cover; }
    .item-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        font-size: 3rem;
    }
    .item-badges {
        position: absolute;
        top: 0.5rem;
        left: 0.5rem;
        display: flex;
        gap: 0.35rem;
    }
    .dietary-badge {
        width: 24px;
        height: 24px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
    }
    .dietary-badge.veg { background: #22c55e; color: white; }
    .dietary-badge.non_veg { background: #ef4444; color: white; }
    .dietary-badge.egg { background: #f59e0b; color: white; }
    .bestseller-badge, .special-badge {
        width: 24px;
        height: 24px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
    }
    .bestseller-badge { background: #fbbf24; color: white; }
    .special-badge { background: #ef4444; color: white; }
    .unavailable-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.6);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .unavailable-overlay span {
        background: #ef4444;
        color: white;
        padding: 0.35rem 0.75rem;
        border-radius: 0.35rem;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .item-content { padding: 1rem; }
    .item-content h4 { font-size: 1rem; margin-bottom: 0.35rem; }
    .item-description { color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.5rem; }
    .item-price {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .price { font-size: 1.1rem; font-weight: 700; color: #0891b2; }
    .spice-level { color: #ef4444; font-size: 0.75rem; }
    .spice-level.spice-mild { opacity: 0.5; }
    .spice-level.spice-medium { opacity: 0.7; }
    .spice-level.spice-hot { opacity: 0.85; }
    .spice-level.spice-extra_hot { opacity: 1; }
    .variants-count { font-size: 0.8rem; color: var(--text-muted); margin-top: 0.35rem; }
    .item-actions {
        padding: 0.75rem 1rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }
    .text-success { color: #22c55e !important; }
    .text-danger { color: #ef4444 !important; }
    .text-warning { color: #f59e0b !important; }
    .empty-state-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 3rem;
        box-shadow: var(--shadow-sm);
    }
    .empty-state { text-align: center; }
    .empty-state i { font-size: 4rem; color: var(--text-muted); opacity: 0.5; margin-bottom: 1rem; }
    .empty-state h3 { font-size: 1.25rem; margin-bottom: 0.5rem; }
    .empty-state p { color: var(--text-muted); margin-bottom: 1.5rem; }
    .pagination-wrapper { margin-top: 2rem; display: flex; justify-content: center; }
</style>
@endpush
@endsection

