@extends('layouts.redesign.company')

@section('page-title', 'Restaurant Tables')
@section('breadcrumb', 'Restaurant Tables')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Restaurant Tables</h2>
            <p>Create and manage table QR codes</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Table</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/restaurant/tables') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Table Number</label>
                    <input type="text" name="table_number" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Table Type</label>
                    <input type="text" name="table_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Seating Capacity</label>
                    <input type="number" name="seating_capacity" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Location Area</label>
                    <input type="text" name="location_area" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Profile</label>
                    <select name="profile_id" class="form-input">
                        <option value="">Default</option>
                        @foreach($profiles as $profile)
                            <option value="{{ $profile->id }}">{{ $profile->profile_name ?? ucfirst($profile->profile_type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Table</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Tables</h3>
        </div>
        <div class="card-body">
            @if($tables->count() === 0)
                <p class="empty-state">No tables added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Table</th>
                                <th>Type</th>
                                <th>Capacity</th>
                                <th>Status</th>
                                <th>QR</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tables as $table)
                            <tr>
                                <td>{{ $table->table_number }}</td>
                                <td>{{ $table->table_type ?? '-' }}</td>
                                <td>{{ $table->seating_capacity ?? '-' }}</td>
                                <td>{{ ucfirst($table->status) }}</td>
                                <td>
                                    @if($table->qr_code_path)
                                        <a href="{{ asset($table->qr_code_path) }}" target="_blank">View</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ url('/company/restaurant/tables/' . $table->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="table_number" class="form-input form-input-sm" value="{{ $table->table_number }}" required>
                                        <input type="text" name="table_type" class="form-input form-input-sm" value="{{ $table->table_type }}">
                                        <select name="status" class="form-input form-input-sm">
                                            <option value="available" {{ $table->status === 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="occupied" {{ $table->status === 'occupied' ? 'selected' : '' }}>Occupied</option>
                                            <option value="reserved" {{ $table->status === 'reserved' ? 'selected' : '' }}>Reserved</option>
                                            <option value="maintenance" {{ $table->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/restaurant/tables/' . $table->id . '/qr') }}" class="inline-form">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary">Regenerate QR</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/restaurant/tables/' . $table->id) }}" class="inline-form" onsubmit="return confirm('Delete this table?');">
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

@push('page-styles')
<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; margin-right: 0.5rem; }
    .form-input-sm { max-width: 130px; }
    .empty-state { color: var(--text-muted); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-secondary { background: #0ea5e9; color: #fff; border: none; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
    .alert-success { background: #d1fae5; color: #065f46; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .settings-card { margin-bottom: 1.5rem; }
    .card-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-color); }
    .card-body { padding: 1.5rem; }
</style>
@endpush
@endsection
