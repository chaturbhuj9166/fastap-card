@extends('layouts.redesign.dashboard')

@section('title', 'Restaurant Payments')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Payments</h1>
            <p class="content-subtitle">Track payment records for orders</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($payments->count() === 0)
                <p class="empty-state">No payments recorded yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Paid At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>#{{ $payment->order_id }}</td>
                                <td>{{ ucfirst($payment->order_type) }}</td>
                                <td>{{ number_format($payment->total_amount ?? 0, 2) }}</td>
                                <td>{{ ucfirst($payment->payment_status) }}</td>
                                <td>{{ $payment->paid_at ? $payment->paid_at->format('d M, h:i A') : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $payments->links() }}
            @endif
        </div>
    </div>
</div>

<style>
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
</style>
@endsection
