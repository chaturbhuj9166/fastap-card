@extends('layouts.redesign.company')

@section('page-title', 'Restaurant Orders')
@section('breadcrumb', 'Restaurant Orders')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Orders</h2>
            <p>Track table and room service orders</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-receipt"></i> Table Orders</h3>
        </div>
        <div class="card-body">
            @if($tableOrders->count() === 0)
                <p class="empty-state">No table orders yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Table</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Placed</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tableOrders as $order)
                            <tr>
                                <td>{{ $order->order_number ?? ('#' . $order->id) }}</td>
                                <td>{{ $order->table_id }}</td>
                                <td>{{ number_format($order->total_amount ?? 0, 2) }}</td>
                                <td>{{ ucfirst($order->order_status) }}</td>
                                <td>{{ $order->order_time ? $order->order_time->format('d M, h:i A') : '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/restaurant/orders/table/' . $order->id . '/status') }}" class="inline-form">
                                        @csrf
                                        <select name="order_status" class="form-input form-input-sm">
                                            <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="preparing" {{ $order->order_status === 'preparing' ? 'selected' : '' }}>Preparing</option>
                                            <option value="ready" {{ $order->order_status === 'ready' ? 'selected' : '' }}>Ready</option>
                                            <option value="served" {{ $order->order_status === 'served' ? 'selected' : '' }}>Served</option>
                                            <option value="paid" {{ $order->order_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $tableOrders->links() }}
            @endif
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-bed"></i> Room Service Orders</h3>
        </div>
        <div class="card-body">
            @if($roomOrders->count() === 0)
                <p class="empty-state">No room service orders yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Room</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Requested</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roomOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->room_id }}</td>
                                <td>{{ ucfirst($order->service_type) }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>{{ $order->requested_time ? $order->requested_time->format('d M, h:i A') : '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/restaurant/orders/room/' . $order->id . '/status') }}" class="inline-form">
                                        @csrf
                                        <select name="status" class="form-input form-input-sm">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="in_progress" {{ $order->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $roomOrders->links() }}
            @endif
        </div>
    </div>
</div>

@push('page-styles')
<style>
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; }
    .form-input-sm { max-width: 140px; }
    .empty-state { color: var(--text-muted); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .alert-success { background: #d1fae5; color: #065f46; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .settings-card { margin-bottom: 1.5rem; }
    .card-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-color); }
    .card-body { padding: 1.5rem; }
</style>
@endpush
@endsection
