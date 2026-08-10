@extends('layouts.redesign.agent')

@section('page-title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@push('page-styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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

    .earnings-highlight {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        margin-bottom: var(--space-lg);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .earnings-info h3 {
        font-size: var(--text-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-xs);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .earnings-value {
        font-size: var(--text-4xl);
        font-weight: var(--font-bold);
        background: linear-gradient(135deg, var(--green-500) 0%, #059669 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .earnings-chart {
        width: 150px;
        height: 80px;
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

@section('agent-content')
@php
    // Calculate total earnings
    $totalCalculatedPercentage = 0;
    if(isset($TotalOrders) && isset($order_meta)) {
        foreach($TotalOrders as $order) {
            $relatedOrderMeta = $order_meta->where('order_id', $order->id);
            foreach($relatedOrderMeta as $orderMetaItem) {
                $totalAmount = $order->total_amount ?? 0;
                $percentage = $order->agent_commission ?? 0;
                $calculatedPercentage = ($percentage / 100) * $totalAmount;
                $totalCalculatedPercentage += $calculatedPercentage;
            }
        }
    }
@endphp

<!-- Welcome Card -->
<div class="welcome-card">
    <h2>Welcome back, {{ session('agent_name', 'Partner') }}!</h2>
    <p>Here's your performance overview for this month.</p>
</div>

<!-- Earnings Highlight -->
<div class="earnings-highlight">
    <div class="earnings-info">
        <h3>Total Earnings</h3>
        <div class="earnings-value">₹{{ number_format($totalCalculatedPercentage ?? 0) }}</div>
    </div>
    <div class="stat-card-trend up" style="font-size: var(--text-lg); padding: var(--space-sm) var(--space-md);">
        <i class="fas fa-arrow-up"></i> Active
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card-dashboard">
        <div class="stat-card-header">
            <div class="stat-card-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--blue-500);">
                <i class="fas fa-rupee-sign"></i>
            </div>
            <span class="stat-card-trend up">
                <i class="fas fa-arrow-up"></i> This Month
            </span>
        </div>
        <div class="stat-card-value">₹{{ number_format($earningThisMonth ?? 0) }}</div>
        <div class="stat-card-label">Monthly Earnings</div>
    </div>

    <div class="stat-card-dashboard">
        <div class="stat-card-header">
            <div class="stat-card-icon" style="background: rgba(236, 72, 153, 0.1); color: var(--pink-500);">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
        <div class="stat-card-value">{{ $totalOrdersThisMonth ?? 0 }}</div>
        <div class="stat-card-label">Orders This Month</div>
    </div>

    <div class="stat-card-dashboard">
        <div class="stat-card-header">
            <div class="stat-card-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        <div class="stat-card-value">{{ isset($TotalOrders) ? $TotalOrders->count() : 0 }}</div>
        <div class="stat-card-label">Total Orders</div>
    </div>

    <div class="stat-card-dashboard">
        <div class="stat-card-header">
            <div class="stat-card-icon" style="background: rgba(249, 115, 22, 0.1); color: var(--orange-500);">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="stat-card-value">{{ $totalUsers ?? 0 }}</div>
        <div class="stat-card-label">My Users</div>
    </div>
</div>

<div class="grid-2-col">
    <!-- Recent Orders -->
    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Recent Orders</h3>
            <a href="{{ url('/agent/allorders') }}" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <div class="table-container" style="border: none;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Commission</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($TotalOrders))
                        @forelse($TotalOrders->take(5) as $order)
                        <tr>
                            <td><strong>#{{ $order->id }}</strong></td>
                            <td>{{ $order->billing_name ?? 'N/A' }}</td>
                            <td>₹{{ number_format($order->total_amount ?? 0) }}</td>
                            <td>
                                @php
                                    $commission = (($order->agent_commission ?? 0) / 100) * ($order->total_amount ?? 0);
                                @endphp
                                <span style="color: var(--green-500); font-weight: var(--font-semibold);">
                                    ₹{{ number_format($commission) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusClass = 'status-pending';
                                    $status = strtolower($order->status ?? 'pending');
                                    if(in_array($status, ['completed', 'delivered'])) {
                                        $statusClass = 'status-active';
                                    } elseif($status == 'cancelled') {
                                        $statusClass = 'status-inactive';
                                    }
                                @endphp
                                <span class="status-badge {{ $statusClass }}">{{ ucfirst($status) }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: var(--space-xl);">
                                <div class="empty-state" style="padding: var(--space-lg);">
                                    <div class="empty-state-icon" style="width: 60px; height: 60px; margin-bottom: var(--space-md);">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <p class="empty-state-text" style="margin-bottom: 0;">No orders yet</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="chart-card">
        <div class="chart-header">
            <h3 class="chart-title">Quick Actions</h3>
        </div>
        <div style="display: flex; flex-direction: column; gap: var(--space-md);">
            <a href="{{ url('/agent/addnewuser') }}" class="btn btn-primary" style="justify-content: flex-start;">
                <i class="fas fa-user-plus"></i> Add New User
            </a>
            <a href="{{ url('/agent/allorders') }}" class="btn btn-secondary" style="justify-content: flex-start;">
                <i class="fas fa-shopping-cart"></i> View All Orders
            </a>
            <a href="{{ url('/agent/allusers') }}" class="btn btn-secondary" style="justify-content: flex-start;">
                <i class="fas fa-users"></i> Manage Users
            </a>
            <a href="{{ url('/agent/myprofile') }}" class="btn btn-ghost" style="justify-content: flex-start;">
                <i class="fas fa-user"></i> My Profile
            </a>
        </div>
    </div>
</div>
@endsection
