@extends('layouts.redesign.company')

@section('page-title', 'Membership Plans')
@section('breadcrumb', 'Membership Plans')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Membership Plans</h2>
            <p>Manage membership pricing and features</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Membership</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/fitness/memberships') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Plan Name</label>
                    <input type="text" name="plan_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Duration (Months)</label>
                    <input type="number" name="duration_months" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Session Type</label>
                    <input type="text" name="session_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Features (one per line)</label>
                    <textarea name="features" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Membership</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Membership Plans</h3>
        </div>
        <div class="card-body">
            @if($memberships->count() === 0)
                <p class="empty-state">No memberships added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Duration</th>
                                <th>Price</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($memberships as $membership)
                            <tr>
                                <td>{{ $membership->plan_name }}</td>
                                <td>{{ $membership->duration_months ? $membership->duration_months . ' months' : '-' }}</td>
                                <td>{{ $membership->price ? number_format($membership->price, 2) : '-' }}</td>
                                <td>{{ $membership->is_active ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/fitness/memberships/' . $membership->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="plan_name" class="form-input form-input-sm" value="{{ $membership->plan_name }}" required>
                                        <input type="number" name="price" class="form-input form-input-sm" value="{{ $membership->price }}" step="0.01" min="0">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_active" value="1" {{ $membership->is_active ? 'checked' : '' }}>
                                            <span>Active</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/fitness/memberships/' . $membership->id) }}" class="inline-form" onsubmit="return confirm('Delete this membership?');">
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
