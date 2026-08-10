@extends('layouts.redesign.dashboard')

@section('page-title', 'Order Details')
@section('breadcrumb', 'Order Details')

@section('dashboard-content')
<div class="order-detail-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Order #{{ $order->order_id ?? $order->id }}</h1>
            <p>Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/myorder') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
            <a href="{{ url('/trackorder/' . $order->id) }}" class="btn btn-primary">
                <i class="fas fa-truck"></i> Track Order
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    {{-- Order Status Card --}}
    <div class="order-status-card fade-up">
        @php
            $statusClass = match($order->status ?? 'pending') {
                'completed', 'delivered' => 'success',
                'processing', 'shipped' => 'warning',
                'cancelled' => 'danger',
                default => 'pending'
            };
            $statusIcon = match($order->status ?? 'pending') {
                'completed', 'delivered' => 'check-circle',
                'processing' => 'cog',
                'shipped' => 'truck',
                'cancelled' => 'times-circle',
                default => 'clock'
            };
        @endphp
        <div class="status-indicator {{ $statusClass }}">
            <i class="fas fa-{{ $statusIcon }}"></i>
        </div>
        <div class="status-info">
            <h3>Order {{ ucfirst($order->status ?? 'Pending') }}</h3>
            <p>Your order is currently {{ strtolower($order->status ?? 'pending') }}</p>
        </div>
        <div class="status-amount">
            <span class="label">Order Total</span>
            <span class="amount">₹{{ number_format($order->total ?? 0) }}</span>
        </div>
    </div>

    <div class="order-detail-grid">
        {{-- Order Items --}}
        <div class="order-items-card fade-up">
            <div class="card-header">
                <h3><i class="fas fa-shopping-bag"></i> Order Items</h3>
            </div>
            <div class="card-body">
                @php
                    $orderProducts = \App\Models\OrderProduct::where('order_id', $order->id)->get();
                    $subtotal = 0;
                @endphp

                @if($orderProducts->count() > 0)
                    <div class="order-items-list">
                        @foreach($orderProducts as $item)
                            @php
                                $product = \App\Models\product::where('id', $item->product_id)->first();
                                $productName = $product ? $product->pro_name : 'Unknown Product';
                                $itemTotal = $item->price;

                                // Add logo price if applicable
                                if($item->product_id == '8' && $item->logo_status == '1') {
                                    $itemTotal = $item->price + 150;
                                }

                                $subtotal += $itemTotal;
                            @endphp
                            <div class="order-item">
                                <div class="item-image">
                                    @if($item->product_id == '8' && $item->logo_status == '1' && $item->image)
                                        <img src="{{ url('frontend/portfolio', $item->image) }}" alt="Logo">
                                    @elseif($product && $product->pro_img)
                                        <img src="{{ asset('storage/' . $product->pro_img) }}" alt="{{ $productName }}">
                                    @else
                                        <div class="placeholder-image">
                                            <i class="fas fa-box"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="item-details">
                                    <h4>{{ $productName }}</h4>
                                    @if($item->name)
                                        <p class="item-meta"><i class="fas fa-user"></i> {{ $item->name }}</p>
                                    @endif
                                    @if($item->designation)
                                        <p class="item-meta"><i class="fas fa-id-badge"></i> {{ $item->designation }}</p>
                                    @endif
                                    @if($item->mobile)
                                        <p class="item-meta"><i class="fas fa-phone"></i> {{ $item->mobile }}</p>
                                    @endif
                                </div>
                                <div class="item-price">
                                    <span class="price">₹{{ number_format($item->price) }}</span>
                                    @if($item->product_id == '8' && $item->logo_status == '1')
                                        <span class="logo-fee">+ ₹150 (Logo)</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="order-summary">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($subtotal) }}</span>
                        </div>
                        @if(isset($order->discount) && $order->discount > 0)
                            <div class="summary-row discount">
                                <span>Discount</span>
                                <span>- ₹{{ number_format($order->discount) }}</span>
                            </div>
                        @endif
                        @if(isset($order->shipping) && $order->shipping > 0)
                            <div class="summary-row">
                                <span>Shipping</span>
                                <span>₹{{ number_format($order->shipping) }}</span>
                            </div>
                        @endif
                        <div class="summary-row total">
                            <span>Total</span>
                            <span>₹{{ number_format($order->total ?? $subtotal) }}</span>
                        </div>
                    </div>
                @else
                    <div class="empty-items">
                        <i class="fas fa-box-open"></i>
                        <p>No items found for this order</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Order Info Sidebar --}}
        <div class="order-info-sidebar">
            {{-- Billing Details --}}
            <div class="info-card fade-up">
                <div class="card-header">
                    <h3><i class="fas fa-file-invoice"></i> Billing Details</h3>
                </div>
                <div class="card-body">
                    @if(isset($ordermeta))
                        <div class="info-item">
                            <label>Name</label>
                            <p>{{ $ordermeta->billing_first_name ?? '' }} {{ $ordermeta->billing_last_name ?? '' }}</p>
                        </div>
                        @if(isset($ordermeta->billing_company_name) && $ordermeta->billing_company_name)
                            <div class="info-item">
                                <label>Company</label>
                                <p>{{ $ordermeta->billing_company_name }}</p>
                            </div>
                        @endif
                        @if(isset($ordermeta->billing_phone) && $ordermeta->billing_phone)
                            <div class="info-item">
                                <label>Phone</label>
                                <p>{{ $ordermeta->billing_phone }}</p>
                            </div>
                        @endif
                        @if(isset($ordermeta->billing_address) && $ordermeta->billing_address)
                            <div class="info-item">
                                <label>Address</label>
                                <p>{{ $ordermeta->billing_address }}</p>
                            </div>
                        @endif
                        @if(isset($ordermeta->billing_city) && $ordermeta->billing_city)
                            <div class="info-item">
                                <label>City</label>
                                <p>{{ $ordermeta->billing_city }}</p>
                            </div>
                        @endif
                    @else
                        <p class="no-data">No billing details available</p>
                    @endif
                </div>
            </div>

            {{-- Payment Info --}}
            <div class="info-card fade-up">
                <div class="card-header">
                    <h3><i class="fas fa-credit-card"></i> Payment Info</h3>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <label>Payment Method</label>
                        <p>{{ ucfirst($order->payment_method ?? 'Online Payment') }}</p>
                    </div>
                    <div class="info-item">
                        <label>Payment Status</label>
                        <p>
                            @php
                                $paymentStatus = $order->payment_status ?? 'pending';
                                $paymentClass = $paymentStatus == 'paid' ? 'success' : ($paymentStatus == 'failed' ? 'danger' : 'warning');
                            @endphp
                            <span class="status-badge {{ $paymentClass }}">{{ ucfirst($paymentStatus) }}</span>
                        </p>
                    </div>
                    @if(isset($order->transaction_id) && $order->transaction_id)
                        <div class="info-item">
                            <label>Transaction ID</label>
                            <p class="transaction-id">{{ $order->transaction_id }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Need Help --}}
            <div class="info-card help-card fade-up">
                <div class="card-body">
                    <i class="fas fa-headset"></i>
                    <h4>Need Help?</h4>
                    <p>Contact our support team for any order related queries</p>
                    <a href="{{ url('/contact') }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-envelope"></i> Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.order-detail-page {
    padding: var(--space-lg);
}

/* Order Status Card */
.order-status-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 1.5rem 2rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.status-indicator {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.status-indicator.success {
    background: rgba(16, 185, 129, 0.15);
    color: var(--success-color);
}

.status-indicator.warning {
    background: rgba(249, 115, 22, 0.15);
    color: var(--warning-color);
}

.status-indicator.danger {
    background: rgba(239, 68, 68, 0.15);
    color: var(--danger-color);
}

.status-indicator.pending {
    background: rgba(107, 114, 128, 0.15);
    color: var(--text-muted);
}

.status-info {
    flex: 1;
}

.status-info h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0 0 0.25rem;
}

.status-info p {
    color: var(--text-secondary);
    margin: 0;
}

.status-amount {
    text-align: right;
}

.status-amount .label {
    display: block;
    font-size: 0.875rem;
    color: var(--text-muted);
    margin-bottom: 0.25rem;
}

.status-amount .amount {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
}

/* Order Detail Grid */
.order-detail-grid {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 2rem;
}

/* Order Items Card */
.order-items-card,
.info-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    overflow: hidden;
}

.card-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    background: var(--bg-secondary);
}

.card-header h3 {
    font-size: 1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
}

.card-header h3 i {
    color: var(--primary-color);
}

.card-body {
    padding: 1.5rem;
}

/* Order Items List */
.order-items-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.order-item {
    display: flex;
    gap: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-color);
}

.order-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.item-image {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    overflow: hidden;
    background: var(--bg-secondary);
    flex-shrink: 0;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.placeholder-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    font-size: 1.5rem;
}

.item-details {
    flex: 1;
}

.item-details h4 {
    font-size: 1rem;
    font-weight: 600;
    margin: 0 0 0.5rem;
}

.item-meta {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0.25rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.item-meta i {
    width: 14px;
    color: var(--text-muted);
}

.item-price {
    text-align: right;
}

.item-price .price {
    font-size: 1.1rem;
    font-weight: 600;
    display: block;
}

.item-price .logo-fee {
    font-size: 0.75rem;
    color: var(--success-color);
    display: block;
}

/* Order Summary */
.order-summary {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 2px dashed var(--border-color);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    color: var(--text-secondary);
}

.summary-row.discount span:last-child {
    color: var(--success-color);
}

.summary-row.total {
    border-top: 1px solid var(--border-color);
    margin-top: 0.5rem;
    padding-top: 1rem;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-color);
}

/* Info Sidebar */
.order-info-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.info-item {
    margin-bottom: 1rem;
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-item label {
    display: block;
    font-size: 0.75rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
}

.info-item p {
    margin: 0;
    color: var(--text-color);
}

.transaction-id {
    font-family: monospace;
    font-size: 0.875rem;
    background: var(--bg-secondary);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
}

.status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.status-badge.success {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success-color);
}

.status-badge.warning {
    background: rgba(249, 115, 22, 0.1);
    color: var(--warning-color);
}

.status-badge.danger {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger-color);
}

/* Help Card */
.help-card .card-body {
    text-align: center;
}

.help-card i {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 0.75rem;
}

.help-card h4 {
    font-size: 1rem;
    margin: 0 0 0.5rem;
}

.help-card p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 1rem;
}

.no-data {
    color: var(--text-muted);
    font-style: italic;
}

.empty-items {
    text-align: center;
    padding: 2rem;
    color: var(--text-muted);
}

.empty-items i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

/* Responsive */
@media (max-width: 992px) {
    .order-detail-grid {
        grid-template-columns: 1fr;
    }

    .order-status-card {
        flex-wrap: wrap;
    }

    .status-amount {
        width: 100%;
        text-align: left;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }
}

@media (max-width: 576px) {
    .order-item {
        flex-direction: column;
    }

    .item-image {
        width: 100%;
        height: 150px;
    }

    .item-price {
        text-align: left;
        margin-top: 0.5rem;
    }

    .page-header-actions {
        flex-direction: column;
        width: 100%;
    }

    .page-header-actions .btn {
        width: 100%;
    }
}
</style>
@endsection
