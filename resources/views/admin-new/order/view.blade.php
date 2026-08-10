@extends('layouts.redesign.admin')

@section('page-title', 'Order Details')
@section('breadcrumb')
<a href="{{ url('/admin/orders') }}">Orders</a>
<span class="breadcrumb-separator">/</span>
Order #{{ $order->id ?? '' }}
@endsection

@push('page-styles')
<style>
    .order-header-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        margin-bottom: var(--space-lg);
    }

    .order-header-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: var(--space-lg);
    }

    .order-id {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .order-date {
        color: var(--text-muted);
        margin-top: var(--space-xs);
    }

    .order-status-select {
        padding: var(--space-sm) var(--space-md);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        background: var(--bg-primary);
        font-size: var(--text-sm);
        cursor: pointer;
    }

    .order-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-lg);
    }

    .info-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-lg);
    }

    .info-card-title {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-md);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .info-card-title i {
        color: var(--purple-500);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: var(--space-sm) 0;
        border-bottom: 1px solid var(--border-light);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--text-muted);
        font-size: var(--text-sm);
    }

    .info-value {
        font-weight: var(--font-medium);
        color: var(--text-primary);
    }

    .items-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        margin-top: var(--space-lg);
        overflow: hidden;
    }

    .items-header {
        padding: var(--space-lg);
        border-bottom: 1px solid var(--border-light);
    }

    .items-title {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
    }

    .order-item {
        display: flex;
        align-items: center;
        padding: var(--space-md) var(--space-lg);
        border-bottom: 1px solid var(--border-light);
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-md);
        object-fit: cover;
        background: var(--bg-secondary);
        margin-right: var(--space-md);
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: var(--font-medium);
        color: var(--text-primary);
    }

    .item-meta {
        font-size: var(--text-sm);
        color: var(--text-muted);
        margin-top: var(--space-xs);
    }

    .item-price {
        font-weight: var(--font-semibold);
        color: var(--text-primary);
    }

    .order-summary {
        padding: var(--space-lg);
        background: var(--bg-secondary);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: var(--space-sm) 0;
    }

    .summary-row.total {
        border-top: 2px solid var(--border-light);
        margin-top: var(--space-sm);
        padding-top: var(--space-md);
        font-size: var(--text-lg);
        font-weight: var(--font-bold);
    }

    @media (max-width: 992px) {
        .order-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@if(isset($order))
<!-- Order Header -->
<div class="order-header-card">
    <div class="order-header-top">
        <div>
            <div class="order-id">Order #{{ $order->id }}</div>
            <div class="order-date">Placed on {{ \Carbon\Carbon::parse($order->created_at)->format('F d, Y \a\t h:i A') }}</div>
        </div>
        <div style="display: flex; gap: var(--space-md); align-items: center;">
            <form action="{{ url('/admin/update-order-status/'.$order->id) }}" method="POST" style="display: inline;">
                @csrf
                <select name="status" class="order-status-select" onchange="this.form.submit()">
                    <option value="pending" {{ ($order->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ ($order->status ?? '') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ ($order->status ?? '') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ ($order->status ?? '') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ ($order->status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </form>
            <a href="{{ url('/admin/order-qr/'.$order->id) }}" class="btn btn-secondary">
                <i class="fas fa-qrcode"></i> QR Code
            </a>
            <a href="{{ url('/admin/orders') }}" class="btn btn-ghost">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>
</div>

<!-- Info Grid -->
<div class="order-grid">
    <!-- Customer Info -->
    <div class="info-card">
        <h3 class="info-card-title"><i class="fas fa-user"></i> Customer</h3>
        <div class="info-row">
            <span class="info-label">Name</span>
            <span class="info-value">{{ $order->billing_name ?? $order->customer->name ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Email</span>
            <span class="info-value">{{ $order->billing_email ?? $order->customer->email ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Phone</span>
            <span class="info-value">{{ $order->billing_phone ?? $order->customer->mobile ?? 'N/A' }}</span>
        </div>
    </div>

    <!-- Shipping Info -->
    <div class="info-card">
        <h3 class="info-card-title"><i class="fas fa-truck"></i> Shipping Address</h3>
        <div style="color: var(--text-primary); line-height: 1.6;">
            {{ $order->billing_name ?? '' }}<br>
            {{ $order->billing_address ?? '' }}<br>
            {{ $order->billing_city ?? '' }}, {{ $order->billing_state ?? '' }}<br>
            {{ $order->billing_pincode ?? '' }}<br>
            {{ $order->billing_country ?? 'India' }}
        </div>
    </div>

    <!-- Payment Info -->
    <div class="info-card">
        <h3 class="info-card-title"><i class="fas fa-credit-card"></i> Payment</h3>
        <div class="info-row">
            <span class="info-label">Method</span>
            <span class="info-value">{{ ucfirst($order->payment_method ?? 'COD') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Status</span>
            <span class="info-value">
                <span class="status-badge {{ ($order->payment_status ?? '') == 'paid' ? 'status-active' : 'status-pending' }}">
                    {{ ucfirst($order->payment_status ?? 'Pending') }}
                </span>
            </span>
        </div>
        @if($order->transaction_id ?? null)
        <div class="info-row">
            <span class="info-label">Transaction ID</span>
            <span class="info-value">{{ $order->transaction_id }}</span>
        </div>
        @endif
    </div>
</div>

<!-- Order Items -->
<div class="items-card">
    <div class="items-header">
        <h3 class="items-title">Order Items</h3>
    </div>

    @php
        $orderItems = DB::table('order_items')
            ->where('order_id', $order->id)
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('order_items.*', 'products.product_name', 'products.product_image')
            ->get();
    @endphp

    @forelse($orderItems as $item)
    <div class="order-item">
        <img src="{{ $item->product_image ? asset('uploads/products/'.$item->product_image) : asset('assets/images/placeholder.png') }}"
             alt="{{ $item->product_name }}"
             class="item-image">
        <div class="item-details">
            <div class="item-name">{{ $item->product_name }}</div>
            <div class="item-meta">
                Qty: {{ $item->quantity ?? 1 }}
                @if($item->customization ?? null)
                    | Custom: {{ $item->customization }}
                @endif
            </div>
        </div>
        <div class="item-price">₹{{ number_format($item->price ?? 0) }}</div>
    </div>
    @empty
    <div class="order-item">
        <p style="color: var(--text-muted);">No items found for this order.</p>
    </div>
    @endforelse

    <div class="order-summary">
        <div class="summary-row">
            <span>Subtotal</span>
            <span>₹{{ number_format($order->subtotal ?? $order->total_amount ?? 0) }}</span>
        </div>
        @if(($order->discount ?? 0) > 0)
        <div class="summary-row">
            <span>Discount</span>
            <span style="color: var(--green-500);">-₹{{ number_format($order->discount) }}</span>
        </div>
        @endif
        <div class="summary-row">
            <span>Shipping</span>
            <span>{{ ($order->shipping_cost ?? 0) > 0 ? '₹'.number_format($order->shipping_cost) : 'FREE' }}</span>
        </div>
        <div class="summary-row total">
            <span>Total</span>
            <span>₹{{ number_format($order->grand_total ?? $order->total_amount ?? 0) }}</span>
        </div>
    </div>
</div>
@else
<div class="empty-state">
    <div class="empty-state-icon">
        <i class="fas fa-exclamation-circle"></i>
    </div>
    <h3 class="empty-state-title">Order Not Found</h3>
    <p class="empty-state-text">The order you're looking for doesn't exist or has been removed.</p>
    <a href="{{ url('/admin/orders') }}" class="btn btn-primary">Back to Orders</a>
</div>
@endif
@endsection
