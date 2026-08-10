@extends('layouts.redesign.admin')

@section('page-title', 'Coupons')
@section('breadcrumb', 'Coupons')

@push('page-styles')
<style>
    .coupon-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .coupon-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .coupon-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .coupon-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .coupon-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .coupon-code {
        font-family: monospace;
        background: linear-gradient(135deg, var(--purple-500), var(--blue-500));
        color: white;
        padding: var(--space-xs) var(--space-md);
        border-radius: var(--radius-md);
        font-weight: var(--font-semibold);
        letter-spacing: 1px;
    }

    .discount-badge {
        background: rgba(16, 185, 129, 0.1);
        color: var(--green-500);
        padding: var(--space-xs) var(--space-sm);
        border-radius: var(--radius-sm);
        font-weight: var(--font-semibold);
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

    @media (max-width: 768px) {
        .coupon-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalCoupons = DB::table('coupons')->count();
    $activeCoupons = DB::table('coupons')->where('status', 1)->count();
@endphp

<!-- Coupon Stats -->
<div class="coupon-stats">
    <div class="coupon-stat-card">
        <div class="coupon-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-ticket-alt"></i>
        </div>
        <div>
            <div class="coupon-stat-value">{{ number_format($totalCoupons) }}</div>
            <div class="coupon-stat-label">Total Coupons</div>
        </div>
    </div>
    <div class="coupon-stat-card">
        <div class="coupon-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <div class="coupon-stat-value">{{ number_format($activeCoupons) }}</div>
            <div class="coupon-stat-label">Active Coupons</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">All Coupons</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage discount coupons for customers</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/admin/coupon') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Coupon
        </a>
    </div>
</div>

<!-- Search Bar -->
<div style="margin-bottom: var(--space-lg);">
    <div class="table-search" style="max-width: 300px;">
        <i class="fas fa-search"></i>
        <input type="text" id="couponSearch" placeholder="Search coupons...">
    </div>
</div>

<!-- Coupons Table -->
<div class="table-container">
    <table class="data-table" id="couponsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Coupon Code</th>
                <th>Discount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0; @endphp
            @forelse($cou as $coupon)
            <tr>
                <td>{{ ++$i }}</td>
                <td>
                    <span class="coupon-code">{{ $coupon->name }}</span>
                </td>
                <td>
                    <span class="discount-badge">{{ $coupon->discount }}% OFF</span>
                </td>
                <td>
                    <div class="status-toggle {{ $coupon->status == 1 ? 'active' : '' }}"
                         data-id="{{ $coupon->id }}"
                         onclick="toggleStatus(this)">
                    </div>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ url('/admin/edit_coupon' . $coupon->id) }}" class="btn btn-icon btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('/admin/delete_coupon/' . $coupon->id) }}" class="btn btn-icon btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this coupon?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: var(--space-xl);">
                    <div style="color: var(--text-muted);">
                        <i class="fas fa-ticket-alt" style="font-size: var(--text-3xl); margin-bottom: var(--space-md);"></i>
                        <p>No coupons found</p>
                        <a href="{{ url('/admin/coupon') }}" class="btn btn-primary btn-sm" style="margin-top: var(--space-md);">
                            <i class="fas fa-plus"></i> Create First Coupon
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($cou->hasPages())
<div style="margin-top: var(--space-lg); display: flex; justify-content: center;">
    {{ $cou->links() }}
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

        fetch('{{ url("/admin/coupon.status") }}?id=' + id + '&status=' + newStatus, {
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
    document.getElementById('couponSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#couponsTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush
