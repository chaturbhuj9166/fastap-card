@extends('layouts.redesign.admin')

@section('page-title', 'Offers')
@section('breadcrumb', 'Offers')

@push('page-styles')
<style>
    .offer-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .offer-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .offer-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .offer-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .offer-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
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
        .offer-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalOffers = DB::table('offers')->count();
    $activeOffers = DB::table('offers')->where('status', 1)->count();
    $inactiveOffers = DB::table('offers')->where('status', 0)->count();
@endphp

<!-- Offer Stats -->
<div class="offer-stats">
    <div class="offer-stat-card">
        <div class="offer-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-tags"></i>
        </div>
        <div>
            <div class="offer-stat-value">{{ number_format($totalOffers) }}</div>
            <div class="offer-stat-label">Total Offers</div>
        </div>
    </div>
    <div class="offer-stat-card">
        <div class="offer-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <div class="offer-stat-value">{{ number_format($activeOffers) }}</div>
            <div class="offer-stat-label">Active Offers</div>
        </div>
    </div>
    <div class="offer-stat-card">
        <div class="offer-stat-icon" style="background: rgba(239, 68, 68, 0.1); color: var(--red-500);">
            <i class="fas fa-times-circle"></i>
        </div>
        <div>
            <div class="offer-stat-value">{{ number_format($inactiveOffers) }}</div>
            <div class="offer-stat-label">Inactive Offers</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">All Offers</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage promotional offers for your products</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/admin/add_offer') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Offer
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
        <input type="text" id="offerSearch" placeholder="Search offers...">
    </div>
</div>

<!-- Offers Table -->
<div class="table-container">
    <table class="data-table" id="offersTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Offer Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0; @endphp
            @forelse($view_offer as $offer)
            <tr data-status="{{ $offer->status == 1 ? 'active' : 'inactive' }}">
                <td>{{ ++$i }}</td>
                <td style="font-weight: var(--font-medium);">{{ $offer->offer }}</td>
                <td>
                    <div class="status-toggle {{ $offer->status == 1 ? 'active' : '' }}"
                         data-id="{{ $offer->id }}"
                         onclick="toggleStatus(this)">
                    </div>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ url('/admin/offerupdate' . $offer->id) }}" class="btn btn-icon btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('/admin/offerdelete' . $offer->id) }}" class="btn btn-icon btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this offer?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: var(--space-xl);">
                    <div style="color: var(--text-muted);">
                        <i class="fas fa-tags" style="font-size: var(--text-3xl); margin-bottom: var(--space-md);"></i>
                        <p>No offers found</p>
                        <a href="{{ url('/admin/add_offer') }}" class="btn btn-primary btn-sm" style="margin-top: var(--space-md);">
                            <i class="fas fa-plus"></i> Create First Offer
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($view_offer->hasPages())
<div style="margin-top: var(--space-lg); display: flex; justify-content: center;">
    {{ $view_offer->links() }}
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

        fetch('{{ url("/admin/offer.status") }}?id=' + id + '&status=' + newStatus, {
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
    document.getElementById('offerSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#offersTable tbody tr');

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
            const rows = document.querySelectorAll('#offersTable tbody tr');

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
