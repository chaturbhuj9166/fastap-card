@extends('layouts.redesign.dashboard')

@section('title', $category->name . ' Items')

@section('dashboard-content')
<div class="content-page">
    <!-- Page Header -->
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">{{ $category->name }}</h1>
            <p class="content-subtitle">{{ $items->count() }} items in this category</p>
        </div>
        <div class="content-header-right">
            <a href="{{ url('/mymenu') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ url('/mymenu/item/create?category='.$category->id) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Item
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- Items Grid -->
    <div class="card">
        <div class="card-body">
            @if($items->count() > 0)
            <div class="items-grid" id="itemsList">
                @foreach($items as $item)
                <div class="menu-item-card" data-id="{{ $item->id }}">
                    <div class="item-image">
                        @if($item->image)
                            <img src="{{ url('uploads/menu/items/'.$item->image) }}" alt="{{ $item->name }}">
                        @else
                            <div class="item-image-placeholder">
                                <i class="fas fa-utensils"></i>
                            </div>
                        @endif
                        <div class="item-badges">
                            @if($item->is_bestseller)
                                <span class="badge badge-warning"><i class="fas fa-star"></i></span>
                            @endif
                            @if($item->dietary_type == 'veg')
                                <span class="badge badge-success"><i class="fas fa-leaf"></i></span>
                            @elseif($item->dietary_type == 'non-veg')
                                <span class="badge badge-danger"><i class="fas fa-drumstick-bite"></i></span>
                            @endif
                        </div>
                        @if(!$item->is_available)
                            <div class="item-unavailable">Unavailable</div>
                        @endif
                    </div>
                    <div class="item-content">
                        <h4 class="item-name">{{ $item->name }}</h4>
                        <p class="item-price">₹{{ number_format($item->price, 2) }}</p>
                        @if($item->description)
                            <p class="item-desc">{{ Str::limit($item->description, 50) }}</p>
                        @endif
                    </div>
                    <div class="item-actions">
                        <a href="{{ url('/mymenu/item/'.$item->id.'/edit') }}" class="btn btn-sm btn-outline">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ url('/mymenu/item/'.$item->id.'/toggle') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $item->is_available ? 'btn-success' : 'btn-warning' }}">
                                <i class="fas {{ $item->is_available ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                            </button>
                        </form>
                        <form action="{{ url('/mymenu/item/'.$item->id.'/bestseller') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $item->is_bestseller ? 'btn-warning' : 'btn-outline' }}">
                                <i class="fas fa-star"></i>
                            </button>
                        </form>
                        <form action="{{ url('/mymenu/item/'.$item->id.'/delete') }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3>No Items Yet</h3>
                <p>Add your first menu item to this category</p>
                <a href="{{ url('/mymenu/item/create?category='.$category->id) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Item
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .items-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.25rem;
    }
    .menu-item-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        overflow: hidden;
    }
    .item-image {
        position: relative;
        aspect-ratio: 4/3;
        background: var(--border-color);
    }
    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .item-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--text-secondary);
    }
    .item-badges {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        display: flex;
        gap: 0.25rem;
    }
    .item-unavailable {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.7);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }
    .item-content {
        padding: 1rem;
    }
    .item-name {
        font-size: 1rem;
        font-weight: 600;
        margin: 0 0 0.25rem;
    }
    .item-price {
        color: var(--primary-color);
        font-weight: 700;
        margin: 0 0 0.5rem;
    }
    .item-desc {
        color: var(--text-secondary);
        font-size: 0.8rem;
        margin: 0;
        line-height: 1.4;
    }
    .item-actions {
        display: flex;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border-top: 1px solid var(--border-color);
    }

    .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        font-size: 0.75rem;
    }
    .badge-success { background: #16a34a; color: white; }
    .badge-danger { background: #dc2626; color: white; }
    .badge-warning { background: #d97706; color: white; }

    .btn-sm {
        padding: 0.4rem 0.6rem;
        font-size: 0.8rem;
    }
    .btn-success { background: #16a34a; color: white; }
    .btn-warning { background: #d97706; color: white; }
    .btn-danger { background: #dc2626; color: white; }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }
    .empty-state-icon {
        width: 80px;
        height: 80px;
        background: var(--bg-secondary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: var(--text-secondary);
    }
    .empty-state h3 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .empty-state p {
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
    }

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .alert-success {
        background: #d1fae5;
        color: #065f46;
    }
</style>
@endsection
