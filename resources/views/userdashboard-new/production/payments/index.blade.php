@extends('layouts.redesign.dashboard')

@section('title', 'Production Payments')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Production Payments</h1>
            <p class="content-subtitle">Track project payment milestones</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Payment</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/production/payments') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Project</label>
                    <select name="project_id" class="form-input">
                        <option value="">Select</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->client_name }} - {{ $project->project_type ?? 'Project' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Payment Stage</label>
                    <input type="text" name="payment_stage" class="form-input" placeholder="advance/final">
                </div>
                <div class="form-group">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Payment Mode</label>
                    <input type="text" name="payment_mode" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="payment_status" class="form-input">
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Transaction ID</label>
                    <input type="text" name="transaction_id" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Paid On</label>
                    <input type="date" name="paid_on" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Payment</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Payments</h3>
        </div>
        <div class="card-body">
            @if($payments->count() === 0)
                <p class="empty-state">No payments recorded yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Stage</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Paid On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->project?->client_name ?? '-' }}</td>
                                <td>{{ $payment->payment_stage ?? '-' }}</td>
                                <td>{{ $payment->amount ? number_format($payment->amount, 2) : '-' }}</td>
                                <td>{{ ucfirst($payment->payment_status) }}</td>
                                <td>{{ $payment->paid_on ? $payment->paid_on->format('d M Y') : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .form-group.full-width { grid-column: 1 / -1; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
</style>
@endsection
