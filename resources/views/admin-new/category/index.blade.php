@extends('layouts.redesign.admin')

@section('page-title', 'Categories')
@section('breadcrumb', 'Categories')

@push('page-styles')
<style>
    .category-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .category-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .category-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .category-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .category-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .category-image {
        width: 60px;
        height: 50px;
        object-fit: cover;
        border-radius: var(--radius-md);
        border: 1px solid var(--card-border);
    }

    .status-toggle {
        position: relative;
        width: 44px;
        height: 24px;
        background: var(--bg-tertiary);
        border-radius: 12px;
        cursor: pointer;
        transition: background var(--transition-fast);
    }

    .status-toggle.active {
        background: var(--green-500);
    }

    .status-toggle::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 50%;
        transition: transform var(--transition-fast);
    }

    .status-toggle.active::after {
        transform: translateX(20px);
    }

    @media (max-width: 1024px) {
        .category-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalCategories = DB::table('categories')->count();
    $activeCategories = DB::table('categories')->where('status', 1)->count();
    $inactiveCategories = DB::table('categories')->where('status', 0)->count();
@endphp

<!-- Category Stats -->
<div class="category-stats">
    <div class="category-stat-card">
        <div class="category-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-folder"></i>
        </div>
        <div>
            <div class="category-stat-value">{{ number_format($totalCategories) }}</div>
            <div class="category-stat-label">Total Categories</div>
        </div>
    </div>
    <div class="category-stat-card">
        <div class="category-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <div class="category-stat-value">{{ number_format($activeCategories) }}</div>
            <div class="category-stat-label">Active Categories</div>
        </div>
    </div>
    <div class="category-stat-card">
        <div class="category-stat-icon" style="background: rgba(239, 68, 68, 0.1); color: var(--red-500);">
            <i class="fas fa-times-circle"></i>
        </div>
        <div>
            <div class="category-stat-value">{{ number_format($inactiveCategories) }}</div>
            <div class="category-stat-label">Inactive Categories</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">All Categories</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage product categories</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/admin/add-category') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>
</div>

<!-- Filters -->
<div class="filters-bar" style="display: flex; align-items: center; gap: var(--space-md); margin-bottom: var(--space-lg); flex-wrap: wrap;">
    <div class="filter-tabs" style="display: flex; background: var(--bg-secondary); border-radius: var(--radius-lg); padding: var(--space-xs);">
        <button class="filter-tab active" data-filter="all" style="padding: var(--space-sm) var(--space-lg); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: var(--font-medium); color: var(--text-secondary); background: var(--bg-primary); border: none; cursor: pointer; box-shadow: var(--shadow-sm);">All</button>
        <button class="filter-tab" data-filter="active" style="padding: var(--space-sm) var(--space-lg); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: var(--font-medium); color: var(--text-secondary); background: transparent; border: none; cursor: pointer;">Active</button>
        <button class="filter-tab" data-filter="inactive" style="padding: var(--space-sm) var(--space-lg); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: var(--font-medium); color: var(--text-secondary); background: transparent; border: none; cursor: pointer;">Inactive</button>
    </div>
    <div style="flex: 1;"></div>
    <div class="table-search">
        <i class="fas fa-search"></i>
        <input type="text" id="categorySearch" placeholder="Search categories...">
    </div>
</div>

<!-- Categories Table -->
<div class="table-container">
    <table class="data-table" id="categoriesTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Category Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0; @endphp
            @forelse($viewcategroy as $category)
            <tr data-status="{{ $category->status == 1 ? 'active' : 'inactive' }}">
                <td>{{ ++$i }}</td>
                <td>
                    @if($category->image)
                        <img src="{{ asset('uploads/category/' . $category->image) }}" alt="{{ $category->categroy }}" class="category-image">
                    @else
                        <div class="category-image" style="background: var(--bg-tertiary); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image" style="color: var(--text-muted);"></i>
                        </div>
                    @endif
                </td>
                <td style="font-weight: var(--font-medium);">{{ $category->categroy }}</td>
                <td>
                    <div class="status-toggle {{ $category->status == 1 ? 'active' : '' }}"
                         data-id="{{ $category->id }}"
                         onclick="toggleStatus(this)">
                    </div>
                </td>
                <td>
                    <div class="action-buttons">
                        @php $catupdate = Crypt::encrypt($category->id); @endphp
                        <a href="{{ url('/admin/catupdate' . $catupdate) }}" class="btn btn-icon btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: var(--space-xl);">
                    <div style="color: var(--text-muted);">
                        <i class="fas fa-folder-open" style="font-size: var(--text-3xl); margin-bottom: var(--space-md);"></i>
                        <p>No categories found</p>
                        <a href="{{ url('/admin/add-category') }}" class="btn btn-primary btn-sm" style="margin-top: var(--space-md);">
                            <i class="fas fa-plus"></i> Add First Category
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($viewcategroy->hasPages())
<div style="margin-top: var(--space-lg); display: flex; justify-content: center;">
    {{ $viewcategroy->links() }}
</div>
@endif

@endsection

@push('page-scripts')
<script>
    // Status toggle function
    function toggleStatus(element) {
        const id = element.dataset.id;
        const isActive = element.classList.contains('active');
        const newStatus = isActive ? 0 : 1;

        fetch('{{ url("/admin/categories.update.status") }}?id=' + id + '&status=' + newStatus, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (newStatus === 1) {
                element.classList.add('active');
            } else {
                element.classList.remove('active');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Search functionality
    document.getElementById('categorySearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#categoriesTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Filter tabs
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.filter-tab').forEach(t => {
                t.classList.remove('active');
                t.style.background = 'transparent';
                t.style.boxShadow = 'none';
            });
            this.classList.add('active');
            this.style.background = 'var(--bg-primary)';
            this.style.boxShadow = 'var(--shadow-sm)';

            const filter = this.dataset.filter;
            const rows = document.querySelectorAll('#categoriesTable tbody tr');

            rows.forEach(row => {
                if (filter === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.dataset.status === filter ? '' : 'none';
                }
            });
        });
    });
</script>
@endpush
