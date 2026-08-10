@extends('layouts.redesign.company')

@section('page-title', 'Restaurant Payments')
@section('breadcrumb', 'Restaurant Payments')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Payments</h2>
            <p>Track payment records for orders</p>
        </div>
    </div>

    <div class="settings-card">
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

@push('page-styles')
<style>
    .empty-state { color: var(--text-muted); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .settings-card { margin-bottom: 1.5rem; }
    .card-body { padding: 1.5rem; }
</style>
@endpush
@endsection
