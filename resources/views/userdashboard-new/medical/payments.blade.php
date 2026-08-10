@extends('layouts.redesign.dashboard')

@section('page-title', 'Medical Payments')
@section('breadcrumb', 'Payments')

@section('dashboard-content')
<div class="payments-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Medical Payments</h1>
            <p>Review payment history and download receipts</p>
        </div>
    </div>

    <div class="stats-row stagger-animation">
        <div class="stat-mini-card fade-up">
            <div class="stat-mini-icon green">
                <i class="fas fa-rupee-sign"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">₹{{ number_format($totalRevenue ?? 0, 2) }}</span>
                <span class="stat-mini-label">Total Revenue</span>
            </div>
        </div>
    </div>

    <div class="table-section fade-up">
        <div class="table-header">
            <h3><i class="fas fa-receipt"></i> Payment History</h3>
        </div>

        @php
            $statusMap = [
                'completed' => 'success',
                'pending' => 'warning',
                'failed' => 'danger',
                'refunded' => 'secondary',
            ];
        @endphp

        @if($payments->count())
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Receipt No</th>
                            <th>Patient</th>
                            <th>Service</th>
                            <th>Amount</th>
                            <th>Payment Mode</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td><strong>{{ $payment->receipt_number }}</strong></td>
                                <td>
                                    {{ $payment->patient_name }}<br>
                                    <span class="text-muted">{{ $payment->patient_mobile }}</span>
                                </td>
                                <td>{{ $payment->service_type }}</td>
                                <td><strong class="text-success">{{ $payment->getFormattedFinalAmount() }}</strong></td>
                                <td>{{ ucfirst($payment->payment_mode) }}</td>
                                <td>
                                    <span class="status-badge {{ $statusMap[$payment->status] ?? 'secondary' }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                                <td>{{ $payment->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('user.medical.receipt.download', $payment->id) }}" class="action-btn" title="Download Receipt">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(method_exists($payments, 'links'))
                <div class="table-footer">
                    {{ $payments->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <h3>No payments yet</h3>
                <p>When patients pay, receipts will show up here.</p>
            </div>
        @endif
    </div>
</div>
@include('userdashboard-new.partials.content-page-styles')
@include('userdashboard-new.partials.table-page-styles')
@endsection


