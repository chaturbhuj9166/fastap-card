@extends('layouts.redesign.dashboard')

@section('title', 'Compliance Deadlines')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Compliance Deadlines</h1>
            <p class="content-subtitle">Track due dates and reminders</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Deadline</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/ca/deadlines') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Client Mobile</label>
                    <input type="text" name="client_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Compliance Type</label>
                    <input type="text" name="compliance_type" class="form-input" placeholder="ITR/GST/TDS/ROC">
                </div>
                <div class="form-group">
                    <label class="form-label">Financial Year</label>
                    <input type="text" name="financial_year" class="form-input" placeholder="2025-26">
                </div>
                <div class="form-group">
                    <label class="form-label">Due Date</label>
                    <input type="date" name="due_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-input" placeholder="pending/filed/overdue">
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="reminder_sent" value="1">
                        <span>Reminder Sent</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Deadline</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Deadlines</h3>
        </div>
        <div class="card-body">
            @if($deadlines->count() === 0)
                <p class="empty-state">No deadlines added yet.</p>
            @else
                @foreach($deadlines as $deadline)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $deadline->compliance_type ?? 'Compliance' }}</strong>
                            <span>{{ $deadline->status ?? 'pending' }}</span>
                        </div>
                        <p class="item-desc">
                            {{ $deadline->financial_year ?? 'FY N/A' }}
                            @if($deadline->due_date)
                                • Due {{ $deadline->due_date->format('d M Y') }}
                            @endif
                        </p>

                        <form method="POST" action="{{ url('/user/ca/deadlines/' . $deadline->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Compliance Type</label>
                                <input type="text" name="compliance_type" class="form-input" value="{{ $deadline->compliance_type }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Financial Year</label>
                                <input type="text" name="financial_year" class="form-input" value="{{ $deadline->financial_year }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Due Date</label>
                                <input type="date" name="due_date" class="form-input" value="{{ $deadline->due_date ? $deadline->due_date->format('Y-m-d') : '' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="status" class="form-input" value="{{ $deadline->status }}">
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="reminder_sent" value="1" {{ $deadline->reminder_sent ? 'checked' : '' }}>
                                    <span>Reminder Sent</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Update</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/user/ca/deadlines/' . $deadline->id) }}" class="inline-form" onsubmit="return confirm('Delete this deadline?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .form-group.full-width { grid-column: 1 / -1; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; margin-top: 0.75rem; }
    .empty-state { color: var(--text-secondary); }
    .item-card { border: 1px solid var(--border-color); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem; }
    .item-header { display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.5rem; }
    .item-desc { color: var(--text-secondary); margin-bottom: 1rem; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
