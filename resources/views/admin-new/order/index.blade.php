@extends('layouts.redesign.admin')

@section('page-title', 'Orders')
@section('breadcrumb', 'Orders')

@push('page-styles')
<style>
    .filters-bar {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
        flex-wrap: wrap;
    }

    .filter-tabs {
        display: flex;
        background: var(--bg-secondary);
        border-radius: var(--radius-lg);
        padding: var(--space-xs);
    }

    .filter-tab {
        padding: var(--space-sm) var(--space-lg);
        border-radius: var(--radius-md);
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        color: var(--text-secondary);
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all var(--transition-fast);
    }

    .filter-tab:hover {
        color: var(--text-primary);
    }

    .filter-tab.active {
        background: var(--bg-primary);
        color: var(--purple-500);
        box-shadow: var(--shadow-sm);
    }

    .order-id-cell {
        font-weight: var(--font-semibold);
        color: var(--purple-500);
    }

    .order-date {
        font-size: var(--text-xs);
        color: var(--text-muted);
    }

    .order-amount {
        font-weight: var(--font-semibold);
    }
</style>
@endpush

@section('admin-content')
<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">All Orders</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage and track all customer orders</p>
    </div>
    <div class="table-actions">
        <button class="btn btn-secondary btn-sm">
            <i class="fas fa-download"></i> Export
        </button>
    </div>
</div>

<!-- Filters -->
<div class="filters-bar">
    <div class="filter-tabs">
        <button class="filter-tab active" data-filter="all">All</button>
        <button class="filter-tab" data-filter="pending">Pending</button>
        <button class="filter-tab" data-filter="processing">Processing</button>
        <button class="filter-tab" data-filter="shipped">Shipped</button>
        <button class="filter-tab" data-filter="delivered">Delivered</button>
    </div>
    <div style="flex: 1;"></div>
    <div class="table-search">
        <i class="fas fa-search"></i>
        <input type="text" id="orderSearch" placeholder="Search orders...">
    </div>
</div>

<!-- Orders Table -->
<div class="table-container">
    <table class="data-table" id="ordersTable">
        <thead>
            <tr>
                <th class="sortable">Order ID</th>
                <th>Customer</th>
                <th>Products</th>
                <th class="sortable">Amount</th>
                <th>Status</th>
                <th class="sortable">Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders ?? [] as $order)
            <tr data-status="{{ strtolower($order->status ?? 'pending') }}">
                <td>
                    <span class="order-id-cell">#{{ $order->id }}</span>
                    <div class="order-date">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</div>
                </td>
                <td>
                    <div class="table-cell-user">
                        <div class="table-avatar">
                            <img src="{{ asset('assets/images/avatars/default.png') }}" alt="Customer">
                        </div>
                        <div class="table-user-info">
                            <div class="table-user-name">{{ $order->customer->name ?? $order->billing_name ?? 'N/A' }}</div>
                            <div class="table-user-email">{{ $order->customer->email ?? $order->billing_email ?? '' }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    @php
                        $productCount = DB::table('order_items')->where('order_id', $order->id)->count();
                    @endphp
                    {{ $productCount }} item(s)
                </td>
                <td>
                    <span class="order-amount">₹{{ number_format($order->total_amount ?? $order->grand_total ?? 0) }}</span>
                </td>
                <td>
                    @php
                        $statusClass = 'status-pending';
                        $status = strtolower($order->status ?? 'pending');
                        if(in_array($status, ['completed', 'delivered'])) {
                            $statusClass = 'status-active';
                        } elseif($status == 'cancelled') {
                            $statusClass = 'status-inactive';
                        } elseif($status == 'processing' || $status == 'shipped') {
                            $statusClass = 'status-pending';
                        }
                    @endphp
                    <span class="status-badge {{ $statusClass }}">{{ ucfirst($status) }}</span>
                </td>
                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, h:i A') }}</td>
                <td>
                    <div class="table-action-btns">
                        <a href="{{ url('/admin/order-view/'.$order->id) }}" class="table-action-btn view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ url('/admin/order-qr/'.$order->id) }}" class="table-action-btn edit" title="QR Code">
                            <i class="fas fa-qrcode"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3 class="empty-state-title">No Orders Yet</h3>
                        <p class="empty-state-text">Orders will appear here once customers start purchasing.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if(isset($orders) && $orders->hasPages())
    <div class="table-footer">
        <div class="table-info">
            Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders
        </div>
        <div class="pagination">
            @if($orders->onFirstPage())
                <button class="pagination-btn" disabled><i class="fas fa-chevron-left"></i></button>
            @else
                <a href="{{ $orders->previousPageUrl() }}" class="pagination-btn"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="pagination-btn {{ $page == $orders->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" class="pagination-btn"><i class="fas fa-chevron-right"></i></a>
            @else
                <button class="pagination-btn" disabled><i class="fas fa-chevron-right"></i></button>
            @endif
        </div>
    </div>
    @endif
</div>

@push('page-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter tabs
    const filterTabs = document.querySelectorAll('.filter-tab');
    const tableRows = document.querySelectorAll('#ordersTable tbody tr');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;

            tableRows.forEach(row => {
                if (filter === 'all') {
                    row.style.display = '';
                } else {
                    const status = row.dataset.status;
                    row.style.display = status === filter ? '' : 'none';
                }
            });
        });
    });

    // Search
    const searchInput = document.getElementById('orderSearch');
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
});
</script>
@endpush
@endsection
