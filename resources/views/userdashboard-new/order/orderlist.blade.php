@extends('layouts.redesign.dashboard')

@section('page-title', 'My Orders')
@section('breadcrumb', 'My Orders')

@section('dashboard-content')
<div class="orders-page">
    {{-- Page Header --}}
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Orders</h1>
            <p>Track and manage your orders</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/Product') }}" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Shop More
            </a>
        </div>
    </div>

    {{-- Orders Stats --}}
    <div class="orders-stats stagger-animation">
        @php
            $userId = session('FRONT_USER_ID');
            $allOrders = \App\Models\Order::where('user_id', $userId)->get();
            $totalOrders = $allOrders->count();
            $pendingOrders = $allOrders->where('payment_status', 'pending')->count();
            $completedOrders = $allOrders->where('payment_status', 'SUCCESS')->count();
            $totalSpent = $allOrders->sum('total_amount');
        @endphp

        <div class="stat-mini-card fade-up">
            <div class="stat-mini-icon purple">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalOrders }}</span>
                <span class="stat-mini-label">Total Orders</span>
            </div>
        </div>

        <div class="stat-mini-card fade-up">
            <div class="stat-mini-icon orange">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $pendingOrders }}</span>
                <span class="stat-mini-label">Pending</span>
            </div>
        </div>

        <div class="stat-mini-card fade-up">
            <div class="stat-mini-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $completedOrders }}</span>
                <span class="stat-mini-label">Completed</span>
            </div>
        </div>

        <div class="stat-mini-card fade-up">
            <div class="stat-mini-icon blue">
                <i class="fas fa-rupee-sign"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">₹{{ number_format($totalSpent) }}</span>
                <span class="stat-mini-label">Total Spent</span>
            </div>
        </div>
    </div>

    {{-- Orders Table --}}
    <div class="orders-table-container fade-up">
        <div class="table-header">
            <h3><i class="fas fa-list"></i> Order History</h3>
            <div class="table-filters">
                <select class="filter-select" id="statusFilter">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <span class="order-id">#{{ $order->order_id ?? $order->id }}</span>
                                </td>
                                <td>
                                    <span class="order-date">{{ $order->created_at->format('M d, Y') }}</span>
                                    <span class="order-time">{{ $order->created_at->format('h:i A') }}</span>
                                </td>
                                <td>
                                    @php
                                        $orderProducts = \App\Models\OrderProduct::where('order_id', $order->id)->get();
                                    @endphp
                                    <span class="items-count">{{ $orderProducts->count() }} item(s)</span>
                                </td>
                                <td>
                                    <span class="order-amount">₹{{ number_format($order->total_amount ?? 0) }}</span>
                                </td>
                                <td>
                                    @php
                                        // Determine display status based on payment_status and order_status
                                        $displayStatus = 'Pending';
                                        $statusClass = 'secondary';

                                        if ($order->payment_status === 'SUCCESS') {
                                            if ($order->order_status === 'active') {
                                                $displayStatus = 'Completed';
                                                $statusClass = 'success';
                                            } else {
                                                $displayStatus = 'Processing';
                                                $statusClass = 'warning';
                                            }
                                        } elseif ($order->payment_status === 'pending') {
                                            $displayStatus = 'Pending';
                                            $statusClass = 'warning';
                                        } elseif ($order->status === '0') {
                                            $displayStatus = 'Cancelled';
                                            $statusClass = 'danger';
                                        }
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $displayStatus }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ url('/userorderview' . $order->id) }}" class="action-btn" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ url('/trackorder/' . $order->id) }}" class="action-btn" title="Track Order">
                                            <i class="fas fa-truck"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if(method_exists($orders, 'links'))
                <div class="table-footer">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h3>No orders yet</h3>
                <p>You haven't placed any orders. Start shopping to see your orders here.</p>
                <a href="{{ url('/Product') }}" class="btn btn-primary">
                    <i class="fas fa-shopping-bag"></i> Browse Products
                </a>
            </div>
        @endif
    </div>
</div>

<style>
.orders-page {
    padding: var(--space-lg);
}

/* Page Header */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: var(--space-xl);
    flex-wrap: wrap;
    gap: var(--space-md);
}

.page-header-content h1 {
    font-size: var(--text-2xl);
    font-weight: var(--font-bold);
    margin-bottom: var(--space-xs);
}

.page-header-content p {
    color: var(--text-secondary);
}

/* Orders Stats */
.orders-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: var(--space-md);
    margin-bottom: var(--space-xl);
}

.stat-mini-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    padding: var(--space-lg);
    display: flex;
    align-items: center;
    gap: var(--space-md);
    transition: all var(--transition-base);
}

.stat-mini-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.stat-mini-icon {
    width: 45px;
    height: 45px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-lg);
}

.stat-mini-icon.purple { background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%); color: var(--purple-500); }
.stat-mini-icon.blue { background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(96, 165, 250, 0.15) 100%); color: var(--blue-500); }
.stat-mini-icon.green { background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(52, 211, 153, 0.15) 100%); color: var(--green-500); }
.stat-mini-icon.orange { background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(251, 146, 60, 0.15) 100%); color: var(--orange-500); }

.stat-mini-info {
    display: flex;
    flex-direction: column;
}

.stat-mini-value {
    font-size: var(--text-xl);
    font-weight: var(--font-bold);
    color: var(--text-primary);
}

.stat-mini-label {
    font-size: var(--text-xs);
    color: var(--text-muted);
}

/* Orders Table Container */
.orders-table-container {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.table-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-lg);
    border-bottom: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

.table-header h3 {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin: 0;
}

.table-header h3 i {
    color: var(--purple-500);
}

.filter-select {
    padding: var(--space-xs) var(--space-md);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-md);
    background: var(--bg-primary);
    color: var(--text-primary);
    font-size: var(--text-sm);
}

/* Data Table */
.table-responsive {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th,
.data-table td {
    padding: var(--space-md) var(--space-lg);
    text-align: left;
    border-bottom: 1px solid var(--border-light);
}

.data-table th {
    background: var(--bg-secondary);
    font-size: var(--text-sm);
    font-weight: var(--font-semibold);
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.data-table tbody tr:hover {
    background: var(--bg-secondary);
}

.order-id {
    font-weight: var(--font-semibold);
    color: var(--purple-600);
}

.order-date {
    display: block;
    font-weight: var(--font-medium);
}

.order-time {
    display: block;
    font-size: var(--text-xs);
    color: var(--text-muted);
}

.items-count {
    font-size: var(--text-sm);
    color: var(--text-secondary);
}

.order-amount {
    font-weight: var(--font-semibold);
    color: var(--text-primary);
}

.status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: var(--radius-full);
    font-size: var(--text-xs);
    font-weight: var(--font-medium);
}

.status-badge.success { background: rgba(16, 185, 129, 0.1); color: var(--green-600); }
.status-badge.warning { background: rgba(249, 115, 22, 0.1); color: var(--orange-600); }
.status-badge.danger { background: rgba(239, 68, 68, 0.1); color: var(--red-600); }
.status-badge.secondary { background: var(--bg-tertiary); color: var(--text-secondary); }

.table-actions {
    display: flex;
    gap: var(--space-xs);
}

.action-btn {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-secondary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-md);
    color: var(--text-secondary);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.action-btn:hover {
    background: var(--purple-500);
    border-color: var(--purple-500);
    color: white;
}

.table-footer {
    padding: var(--space-lg);
    border-top: 1px solid var(--border-light);
    display: flex;
    justify-content: center;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: var(--space-3xl);
}

.empty-state-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto var(--space-lg);
    background: var(--bg-secondary);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-3xl);
    color: var(--text-muted);
}

.empty-state h3 {
    font-size: var(--text-xl);
    margin-bottom: var(--space-sm);
}

.empty-state p {
    color: var(--text-secondary);
    margin-bottom: var(--space-lg);
}

/* Responsive */
@media (max-width: 992px) {
    .orders-stats {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .orders-stats {
        grid-template-columns: 1fr;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
@endsection
