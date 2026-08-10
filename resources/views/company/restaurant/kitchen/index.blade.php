@extends('layouts.redesign.company')

@section('page-title', 'Kitchen Display')
@section('breadcrumb', 'Kitchen Display')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Kitchen Display</h2>
            <p>Live incoming orders</p>
        </div>
    </div>

    <div class="kitchen-grid">
        <div class="settings-card">
            <div class="card-header">
                <h3><i class="fas fa-receipt"></i> Table Orders</h3>
            </div>
            <div class="card-body">
                @if($tableOrders->count() === 0)
                    <p class="empty-state">No active table orders.</p>
                @else
                    @foreach($tableOrders as $order)
                        <div class="kitchen-card">
                            <div class="kitchen-card-header">
                                <strong>{{ $order->order_number ?? ('#' . $order->id) }}</strong>
                                <span>Table {{ $order->table?->table_number ?? $order->table_id }}</span>
                                <span class="status-badge">{{ ucfirst($order->order_status) }}</span>
                            </div>
                            <ul class="kitchen-items">
                                @foreach($order->items ?? [] as $item)
                                    <li>{{ $item['quantity'] ?? 1 }}x {{ $item['name'] ?? '' }}</li>
                                @endforeach
                            </ul>
                            @if($order->notes)
                                <div class="kitchen-notes">Note: {{ $order->notes }}</div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="settings-card">
            <div class="card-header">
                <h3><i class="fas fa-bed"></i> Room Service</h3>
            </div>
            <div class="card-body">
                @if($roomOrders->count() === 0)
                    <p class="empty-state">No active room service orders.</p>
                @else
                    @foreach($roomOrders as $order)
                        <div class="kitchen-card">
                            <div class="kitchen-card-header">
                                <strong>#{{ $order->id }}</strong>
                                <span>Room {{ $order->room?->room_number ?? $order->room_id }}</span>
                                <span class="status-badge">{{ ucfirst($order->status) }}</span>
                            </div>
                            <ul class="kitchen-items">
                                @foreach(($order->order_details['items'] ?? []) as $item)
                                    <li>{{ $item['quantity'] ?? 1 }}x {{ $item['name'] ?? '' }}</li>
                                @endforeach
                            </ul>
                            @if($order->notes)
                                <div class="kitchen-notes">Note: {{ $order->notes }}</div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@push('page-styles')
<style>
    .kitchen-grid { display: grid; gap: 1.5rem; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); }
    .kitchen-card { border: 1px solid var(--border-color); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem; }
    .kitchen-card-header { display: flex; justify-content: space-between; gap: 0.5rem; font-size: 0.9rem; margin-bottom: 0.5rem; }
    .status-badge { background: #fef3c7; color: #b45309; padding: 0.2rem 0.5rem; border-radius: 999px; font-size: 0.7rem; }
    .kitchen-items { margin: 0; padding-left: 1.2rem; }
    .kitchen-notes { margin-top: 0.5rem; font-size: 0.85rem; color: var(--text-muted); }
    .empty-state { color: var(--text-muted); }
    .settings-card { margin-bottom: 1.5rem; }
</style>
@endpush
@endsection
