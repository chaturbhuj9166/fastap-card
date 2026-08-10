@extends('layouts.redesign.admin')

@section('page-title', 'Pre Orders')
@section('breadcrumb', 'Pre Orders')

@push('page-styles')
<style>
    .preorder-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .preorder-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .preorder-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .preorder-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .preorder-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .preorder-image {
        width: 80px;
        height: 50px;
        object-fit: cover;
        border-radius: var(--radius-md);
        border: 1px solid var(--card-border);
    }

    .card-type-badge {
        padding: var(--space-xs) var(--space-sm);
        border-radius: var(--radius-sm);
        font-size: var(--text-xs);
        font-weight: var(--font-medium);
        background: rgba(124, 58, 237, 0.1);
        color: var(--purple-500);
    }

    .download-btn {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        padding: var(--space-xs) var(--space-sm);
        font-size: var(--text-xs);
        color: var(--blue-500);
        text-decoration: none;
    }

    .download-btn:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .preorder-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalPreorders = DB::table('preorders')->count();
@endphp

<!-- Preorder Stats -->
<div class="preorder-stats">
    <div class="preorder-stat-card">
        <div class="preorder-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-clipboard-list"></i>
        </div>
        <div>
            <div class="preorder-stat-value">{{ number_format($totalPreorders) }}</div>
            <div class="preorder-stat-label">Total Pre Orders</div>
        </div>
    </div>
    <div class="preorder-stat-card">
        <div class="preorder-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-credit-card"></i>
        </div>
        <div>
            <div class="preorder-stat-value">{{ $preorders->count() }}</div>
            <div class="preorder-stat-label">On This Page</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">Pre Order Requests</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">View all pre-order card requests</p>
    </div>
    <div class="table-actions">
        <div class="table-search">
            <i class="fas fa-search"></i>
            <input type="text" id="preorderSearch" placeholder="Search...">
        </div>
    </div>
</div>

<!-- Preorders Table -->
<div class="table-container">
    <table class="data-table" id="preordersTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Transaction ID</th>
                <th>Customer Info</th>
                <th>Image</th>
                <th>Card Type</th>
                <th>Employee Code</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0; @endphp
            @forelse($preorders as $preorder)
            <tr>
                <td>{{ ++$i }}</td>
                <td>
                    <span style="font-family: monospace; font-weight: var(--font-medium); color: var(--purple-500);">
                        {{ $preorder->transaction_id ?? 'N/A' }}
                    </span>
                </td>
                <td>
                    <div style="font-weight: var(--font-medium);">{{ $preorder->name }}</div>
                    <div style="font-size: var(--text-sm); color: var(--text-muted);">
                        <i class="fas fa-phone" style="font-size: var(--text-xs); margin-right: 4px;"></i>{{ $preorder->phone }}
                    </div>
                    <div style="font-size: var(--text-sm); color: var(--text-muted);">
                        <i class="fas fa-envelope" style="font-size: var(--text-xs); margin-right: 4px;"></i>{{ $preorder->email }}
                    </div>
                </td>
                <td>
                    @if($preorder->image)
                        <div>
                            <img src="{{ url('uploads/preorder/images/' . $preorder->image) }}" alt="Preorder" class="preorder-image">
                            <a href="{{ url('uploads/preorder/images/' . $preorder->image) }}" download class="download-btn">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    @else
                        <span style="color: var(--text-muted);">No image</span>
                    @endif
                </td>
                <td>
                    <span class="card-type-badge">{{ $preorder->card_type ?? 'Standard' }}</span>
                </td>
                <td>
                    {{ $preorder->employee_code ?: 'N/A' }}
                </td>
                <td style="max-width: 200px;">
                    <span style="font-size: var(--text-sm);">{{ $preorder->address ?: 'N/A' }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: var(--space-xl);">
                    <div style="color: var(--text-muted);">
                        <i class="fas fa-clipboard" style="font-size: var(--text-3xl); margin-bottom: var(--space-md);"></i>
                        <p>No pre-orders found</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($preorders->hasPages())
<div style="margin-top: var(--space-lg); display: flex; justify-content: center;">
    {{ $preorders->links() }}
</div>
@endif

@endsection

@push('page-scripts')
<script>
    // Search functionality
    document.getElementById('preorderSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#preordersTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush
