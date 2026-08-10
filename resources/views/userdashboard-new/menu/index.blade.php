@extends('layouts.redesign.dashboard')

@section('title', 'Menu Management')

@section('dashboard-content')
<div class="content-page">
    <!-- Page Header -->
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Menu Management</h1>
            <p class="content-subtitle">Manage your restaurant menu categories and items</p>
        </div>
        <div class="content-header-right">
            <a href="{{ url('/mymenu/category/create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Category
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: #dbeafe; color: #2563eb;">
                <i class="fas fa-folder"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-value">{{ $categories->count() }}</h3>
                <p class="stat-label">Categories</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #dcfce7; color: #16a34a;">
                <i class="fas fa-utensils"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-value">{{ $totalItems }}</h3>
                <p class="stat-label">Menu Items</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-value">{{ $bestsellers }}</h3>
                <p class="stat-label">Bestsellers</p>
            </div>
        </div>
    </div>

    <!-- Categories List -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list"></i> Menu Categories
            </h3>
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
            <div class="categories-list" id="categoriesList">
                @foreach($categories as $category)
                <div class="category-item" data-id="{{ $category->id }}">
                    <div class="category-drag-handle">
                        <i class="fas fa-grip-vertical"></i>
                    </div>
                    <div class="category-icon" style="background: {{ $category->status ? '#dcfce7' : '#fee2e2' }}; color: {{ $category->status ? '#16a34a' : '#dc2626' }};">
                        <i class="fas {{ $category->icon ?? 'fa-folder' }}"></i>
                    </div>
                    <div class="category-info">
                        <h4 class="category-name">{{ $category->name }}</h4>
                        <p class="category-meta">
                            {{ $category->items->count() }} items
                            @if(!$category->status)
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </p>
                    </div>
                    <div class="category-actions">
                        <a href="{{ url('/mymenu/category/'.$category->id.'/items') }}" class="btn btn-sm btn-outline">
                            <i class="fas fa-eye"></i> Items
                        </a>
                        <a href="{{ url('/mymenu/category/'.$category->id.'/edit') }}" class="btn btn-sm btn-outline">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ url('/mymenu/category/'.$category->id.'/toggle') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $category->status ? 'btn-success' : 'btn-warning' }}">
                                <i class="fas {{ $category->status ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                            </button>
                        </form>
                        <form action="{{ url('/mymenu/category/'.$category->id.'/delete') }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this category and all its items?');">
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
                <h3>No Menu Categories</h3>
                <p>Start by adding your first menu category</p>
                <a href="{{ url('/mymenu/category/create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Category
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }
    .stat-label {
        color: var(--text-secondary);
        font-size: 0.85rem;
        margin: 0;
    }

    .categories-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    .category-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: var(--bg-secondary);
        border-radius: 0.75rem;
        border: 1px solid var(--border-color);
    }
    .category-drag-handle {
        color: var(--text-secondary);
        cursor: grab;
        padding: 0.5rem;
    }
    .category-icon {
        width: 44px;
        height: 44px;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .category-info {
        flex: 1;
    }
    .category-name {
        font-size: 1rem;
        font-weight: 600;
        margin: 0 0 0.25rem;
    }
    .category-meta {
        color: var(--text-secondary);
        font-size: 0.8rem;
        margin: 0;
    }
    .category-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-sm {
        padding: 0.4rem 0.6rem;
        font-size: 0.8rem;
    }
    .btn-success {
        background: #16a34a;
        color: white;
    }
    .btn-warning {
        background: #d97706;
        color: white;
    }
    .btn-danger {
        background: #dc2626;
        color: white;
    }

    .badge {
        display: inline-block;
        padding: 0.2rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.7rem;
        font-weight: 600;
    }
    .badge-danger {
        background: #fee2e2;
        color: #dc2626;
    }

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
    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    @media (max-width: 768px) {
        .category-actions {
            flex-wrap: wrap;
        }
        .category-item {
            flex-wrap: wrap;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const list = document.getElementById('categoriesList');
    if (list) {
        new Sortable(list, {
            handle: '.category-drag-handle',
            animation: 150,
            onEnd: function(evt) {
                const ids = Array.from(list.querySelectorAll('.category-item')).map(el => el.dataset.id);
                fetch('{{ url("/mymenu/category/reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: ids })
                });
            }
        });
    }
});
</script>
@endsection
