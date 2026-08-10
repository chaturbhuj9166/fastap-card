@extends('layouts.redesign.admin')

@section('page-title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@push('page-styles')
<style>
    .welcome-card {
        background: var(--gradient-purple);
        color: white;
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        margin-bottom: var(--space-xl);
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .welcome-card h2 {
        font-size: var(--text-2xl);
        margin-bottom: var(--space-sm);
        position: relative;
    }

    .welcome-card p {
        opacity: 0.9;
        position: relative;
    }

    .chart-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-lg);
        margin-bottom: var(--space-lg);
    }

    .chart-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: var(--space-lg);
    }

    .chart-title {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
    }

    .chart-container {
        height: 300px;
        position: relative;
    }

    .recent-orders-table {
        width: 100%;
    }

    .order-product-cell {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .order-product-img {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-md);
        object-fit: cover;
        background: var(--bg-secondary);
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: var(--space-md);
        margin-top: var(--space-lg);
    }

    .quick-action-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
        text-decoration: none;
        color: var(--text-primary);
        transition: all var(--transition-base);
    }

    .quick-action-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        border-color: var(--purple-400);
    }

    .quick-action-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-lg);
        font-size: var(--text-xl);
    }

    .quick-action-icon.purple {
        background: rgba(124, 58, 237, 0.1);
        color: var(--purple-500);
    }

    .quick-action-icon.blue {
        background: rgba(59, 130, 246, 0.1);
        color: var(--blue-500);
    }

    .quick-action-icon.green {
        background: rgba(16, 185, 129, 0.1);
        color: var(--green-500);
    }

    .quick-action-icon.orange {
        background: rgba(249, 115, 22, 0.1);
        color: var(--orange-500);
    }

    .quick-action-title {
        font-weight: var(--font-medium);
    }

    .quick-action-desc {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .grid-2-col {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: var(--space-lg);
    }

    @media (max-width: 1200px) {
        .grid-2-col {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalOrders = DB::table('orders')->count();
    $totalProducts = DB::table('products')->count();
    $totalCategories = DB::table('categories')->count();
    $totalCustomers = DB::table('users')->count();
    $recentOrders = DB::table('orders')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*', 'users.name as customer_name', 'users.email as customer_email')
        ->orderBy('orders.created_at', 'desc')
        ->limit(5)
        ->get();
    $pendingOrders = DB::table('orders')->where('status', 'pending')->count();
    $completedOrders = DB::table('orders')->where('status', 'completed')->count();
@endphp

<!-- Welcome Card -->
<div class="welcome-card">
    <h2>Welcome back, Admin!</h2>
    <p>Here's what's happening with your store today.</p>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card-dashboard">
        <div class="stat-card-header">
            <div class="stat-card-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--blue-500);">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <span class="stat-card-trend up">
                <i class="fas fa-arrow-up"></i> Active
            </span>
        </div>
        <div class="stat-card-value">{{ number_format($totalOrders) }}</div>
        <div class="stat-card-label">Total Orders</div>
    </div>

    <div class="stat-card-dashboard">
        <div class="stat-card-header">
            <div class="stat-card-icon" style="background: rgba(236, 72, 153, 0.1); color: var(--pink-500);">
                <i class="fas fa-box"></i>
            </div>
        </div>
        <div class="stat-card-value">{{ number_format($totalProducts) }}</div>
        <div class="stat-card-label">Total Products</div>
    </div>

    <div class="stat-card-dashboard">
        <div class="stat-card-header">
            <div class="stat-card-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
                <i class="fas fa-list"></i>
            </div>
        </div>
        <div class="stat-card-value">{{ number_format($totalCategories) }}</div>
        <div class="stat-card-label">Categories</div>
    </div>

    <div class="stat-card-dashboard">
        <div class="stat-card-header">
            <div class="stat-card-icon" style="background: rgba(249, 115, 22, 0.1); color: var(--orange-500);">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="stat-card-value">{{ number_format($totalCustomers) }}</div>
        <div class="stat-card-label">Total Customers</div>
    </div>
</div>

<!-- Quick Actions -->
<div class="chart-card">
    <div class="chart-header">
        <h3 class="chart-title">Quick Actions</h3>
    </div>
    <div class="quick-actions-grid">
        <a href="{{ url('/admin/add-product') }}" class="quick-action-card">
            <div class="quick-action-icon purple">
                <i class="fas fa-plus"></i>
            </div>
            <div>
                <div class="quick-action-title">Add Product</div>
                <div class="quick-action-desc">Create new product</div>
            </div>
        </a>
        <a href="{{ url('/admin/orders') }}" class="quick-action-card">
            <div class="quick-action-icon blue">
                <i class="fas fa-truck"></i>
            </div>
            <div>
                <div class="quick-action-title">View Orders</div>
                <div class="quick-action-desc">{{ $pendingOrders }} pending</div>
            </div>
        </a>
        <a href="{{ url('/admin/user-list') }}" class="quick-action-card">
            <div class="quick-action-icon green">
                <i class="fas fa-user-plus"></i>
            </div>
            <div>
                <div class="quick-action-title">Manage Users</div>
                <div class="quick-action-desc">{{ $totalCustomers }} users</div>
            </div>
        </a>
        <a href="{{ url('/admin/viewwebsetting') }}" class="quick-action-card">
            <div class="quick-action-icon orange">
                <i class="fas fa-cog"></i>
            </div>
            <div>
                <div class="quick-action-title">Settings</div>
                <div class="quick-action-desc">Configure site</div>
            </div>
        </a>
    </div>
</div>

<div class="grid-2-col">
    <!-- Recent Orders -->
    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Recent Orders</h3>
            <a href="{{ url('/admin/orders') }}" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <div class="table-container" style="border: none;">
            <table class="data-table recent-orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                    <tr>
                        <td><strong>#{{ $order->id }}</strong></td>
                        <td>
                            <div class="table-cell-user">
                                <div class="table-user-info">
                                    <div class="table-user-name">{{ $order->customer_name ?? 'N/A' }}</div>
                                    <div class="table-user-email">{{ $order->customer_email ?? '' }}</div>
                                </div>
                            </div>
                        </td>
                        <td><strong>₹{{ number_format($order->total_amount ?? 0) }}</strong></td>
                        <td>
                            @php
                                $statusClass = 'status-pending';
                                if($order->status == 'completed' || $order->status == 'delivered') {
                                    $statusClass = 'status-active';
                                } elseif($order->status == 'cancelled') {
                                    $statusClass = 'status-inactive';
                                }
                            @endphp
                            <span class="status-badge {{ $statusClass }}">{{ ucfirst($order->status ?? 'Pending') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: var(--space-xl);">
                            <div class="empty-state" style="padding: var(--space-lg);">
                                <div class="empty-state-icon" style="width: 60px; height: 60px; margin-bottom: var(--space-md);">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <p class="empty-state-text" style="margin-bottom: 0;">No orders yet</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Order Summary -->
    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Order Summary</h3>
        </div>
        <div style="padding: var(--space-md);">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: var(--space-md) 0; border-bottom: 1px solid var(--border-light);">
                <div style="display: flex; align-items: center; gap: var(--space-sm);">
                    <div style="width: 12px; height: 12px; background: var(--orange-500); border-radius: 50%;"></div>
                    <span>Pending Orders</span>
                </div>
                <strong>{{ $pendingOrders }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: var(--space-md) 0; border-bottom: 1px solid var(--border-light);">
                <div style="display: flex; align-items: center; gap: var(--space-sm);">
                    <div style="width: 12px; height: 12px; background: var(--blue-500); border-radius: 50%;"></div>
                    <span>Processing</span>
                </div>
                <strong>{{ DB::table('orders')->where('status', 'processing')->count() }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: var(--space-md) 0; border-bottom: 1px solid var(--border-light);">
                <div style="display: flex; align-items: center; gap: var(--space-sm);">
                    <div style="width: 12px; height: 12px; background: var(--purple-500); border-radius: 50%;"></div>
                    <span>Shipped</span>
                </div>
                <strong>{{ DB::table('orders')->where('status', 'shipped')->count() }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: var(--space-md) 0;">
                <div style="display: flex; align-items: center; gap: var(--space-sm);">
                    <div style="width: 12px; height: 12px; background: var(--green-500); border-radius: 50%;"></div>
                    <span>Completed</span>
                </div>
                <strong>{{ $completedOrders }}</strong>
            </div>
        </div>
    </div>
</div>
@endsection
