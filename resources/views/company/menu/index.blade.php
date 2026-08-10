@extends('layouts.redesign.company')

@section('page-title', 'Menu Management')
@section('breadcrumb', 'Menu')

@section('company-content')
<div class="menu-page">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h2>Menu Management</h2>
            <p>Manage your restaurant menu categories and items</p>
        </div>
        <div class="page-header-right">
            <a href="{{ url('/company/restaurant') }}" class="btn btn-outline">
                <i class="fas fa-cog"></i> Restaurant Settings
            </a>
            <a href="{{ url('/company/menu/category/create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Category
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #0891b2, #06b6d4);">
                <i class="fas fa-folder"></i>
            </div>
            <div class="stat-content">
                <span class="stat-value">{{ $categories->count() }}</span>
                <span class="stat-label">Categories</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #34d399);">
                <i class="fas fa-utensils"></i>
            </div>
            <div class="stat-content">
                <span class="stat-value">{{ $totalItems }}</span>
                <span class="stat-label">Total Items</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #8b5cf6, #a78bfa);">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <span class="stat-value">{{ $activeItems }}</span>
                <span class="stat-label">Available</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #fbbf24);">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-content">
                <span class="stat-value">{{ $bestsellers }}</span>
                <span class="stat-label">Bestsellers</span>
            </div>
        </div>
    </div>

    <!-- Categories List -->
    @if($categories->count() > 0)
    <div class="categories-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Menu Categories</h3>
            <span class="text-muted">Drag to reorder</span>
        </div>
        <div class="categories-list" id="categoriesList">
            @foreach($categories as $category)
            <div class="category-item" data-id="{{ $category->id }}">
                <div class="category-drag-handle">
                    <i class="fas fa-grip-vertical"></i>
                </div>
                <div class="category-image">
                    @if($category->image)
                        <img src="{{ asset('uploads/menu/categories/' . $category->image) }}" alt="{{ $category->name }}">
                    @else
                        <div class="category-placeholder">
                            <i class="fas fa-utensils"></i>
                        </div>
                    @endif
                </div>
                <div class="category-info">
                    <h4>{{ $category->name }}</h4>
                    @if($category->description)
                    <p>{{ Str::limit($category->description, 80) }}</p>
                    @endif
                    <div class="category-meta">
                        <span class="badge {{ $category->is_active ? 'badge-success' : 'badge-warning' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <span class="items-count">{{ $category->items_count }} items</span>
                    </div>
                </div>
                <div class="category-actions">
                    <a href="{{ url('/company/menu/category/' . $category->id . '/items') }}" class="btn btn-sm btn-primary" title="View Items">
                        <i class="fas fa-eye"></i> Items
                    </a>
                    <a href="{{ url('/company/menu/item/create?category=' . $category->id) }}" class="btn btn-sm btn-outline" title="Add Item">
                        <i class="fas fa-plus"></i>
                    </a>
                    <a href="{{ url('/company/menu/category/' . $category->id . '/edit') }}" class="btn btn-sm btn-outline" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('company.menu.category.toggle', $category->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline" title="{{ $category->is_active ? 'Deactivate' : 'Activate' }}">
                            <i class="fas {{ $category->is_active ? 'fa-toggle-on text-success' : 'fa-toggle-off' }}"></i>
                        </button>
                    </form>
                    <form action="{{ route('company.menu.category.delete', $category->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this category and all its items?');">
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
    </div>
    @else
    <div class="empty-state-card">
        <div class="empty-state">
            <i class="fas fa-utensils"></i>
            <h3>No Menu Categories Yet</h3>
            <p>Start by creating your first menu category</p>
            <a href="{{ url('/company/menu/category/create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create Category
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
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .stat-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: var(--shadow-sm);
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }
    .stat-value { font-size: 1.5rem; font-weight: 700; display: block; }
    .stat-label { color: var(--text-muted); font-size: 0.85rem; }
    .categories-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        box-shadow: var(--shadow-sm);
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }
    .card-header h3 {
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
    }
    .categories-list { padding: 0.5rem; }
    .category-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 0.75rem;
        transition: all 0.2s;
        border: 1px solid transparent;
    }
    .category-item:hover {
        background: var(--bg-secondary);
        border-color: var(--border-color);
    }
    .category-drag-handle {
        cursor: grab;
        color: var(--text-muted);
        padding: 0.5rem;
    }
    .category-drag-handle:active { cursor: grabbing; }
    .category-image {
        width: 60px;
        height: 60px;
        border-radius: 0.5rem;
        overflow: hidden;
        flex-shrink: 0;
    }
    .category-image img { width: 100%; height: 100%; object-fit: cover; }
    .category-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }
    .category-info { flex: 1; min-width: 0; }
    .category-info h4 { font-size: 1rem; margin-bottom: 0.25rem; }
    .category-info p { color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.5rem; }
    .category-meta { display: flex; align-items: center; gap: 0.75rem; }
    .items-count { color: var(--text-muted); font-size: 0.8rem; }
    .category-actions {
        display: flex;
        gap: 0.5rem;
        flex-shrink: 0;
    }
    @media (max-width: 768px) {
        .category-item { flex-wrap: wrap; }
        .category-actions { width: 100%; justify-content: flex-end; margin-top: 0.5rem; }
    }
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
    .text-success { color: #22c55e !important; }
    .text-danger { color: #ef4444 !important; }
</style>
@endpush

@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Initialize sortable for categories
    const categoriesList = document.getElementById('categoriesList');
    if (categoriesList) {
        new Sortable(categoriesList, {
            animation: 150,
            handle: '.category-drag-handle',
            onEnd: function(evt) {
                const categories = [];
                categoriesList.querySelectorAll('.category-item').forEach(item => {
                    categories.push(item.dataset.id);
                });

                // Send reorder request
                fetch('{{ url("/company/menu/category/reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ categories: categories })
                });
            }
        });
    }
</script>
@endpush
@endsection
