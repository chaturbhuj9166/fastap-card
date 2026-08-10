@extends('layouts.redesign.dashboard')

@section('title', 'Member Subscriptions')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Member Subscriptions</h1>
            <p class="content-subtitle">Track active and expired memberships</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Subscription</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/fitness/subscriptions') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Member Name</label>
                    <input type="text" name="member_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Mobile</label>
                    <input type="text" name="member_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="member_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Membership Plan</label>
                    <select name="membership_id" class="form-input">
                        <option value="">Select</option>
                        @foreach($memberships as $membership)
                            <option value="{{ $membership->id }}">{{ $membership->plan_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-input">
                        <option value="active">Active</option>
                        <option value="expired">Expired</option>
                        <option value="frozen">Frozen</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Payment Status</label>
                    <input type="text" name="payment_status" class="form-input">
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="auto_renewal" value="1">
                        <span>Auto Renewal</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Subscription</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Subscriptions</h3>
        </div>
        <div class="card-body">
            @if($subscriptions->count() === 0)
                <p class="empty-state">No subscriptions added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscriptions as $subscription)
                            <tr>
                                <td>{{ $subscription->member_name }}</td>
                                <td>{{ $subscription->membership?->plan_name ?? '-' }}</td>
                                <td>{{ ucfirst($subscription->status) }}</td>
                                <td>{{ $subscription->start_date ? $subscription->start_date->format('d M Y') : '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/fitness/subscriptions/' . $subscription->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="member_name" class="form-input form-input-sm" value="{{ $subscription->member_name }}" required>
                                        <select name="status" class="form-input form-input-sm">
                                            <option value="active" {{ $subscription->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="expired" {{ $subscription->status === 'expired' ? 'selected' : '' }}>Expired</option>
                                            <option value="frozen" {{ $subscription->status === 'frozen' ? 'selected' : '' }}>Frozen</option>
                                            <option value="cancelled" {{ $subscription->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="auto_renewal" value="1" {{ $subscription->auto_renewal ? 'checked' : '' }}>
                                            <span>Auto</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/fitness/subscriptions/' . $subscription->id) }}" class="inline-form" onsubmit="return confirm('Delete this subscription?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
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
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; margin-right: 0.5rem; }
    .form-input-sm { max-width: 150px; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
