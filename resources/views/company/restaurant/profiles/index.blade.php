@extends('layouts.redesign.company')

@section('page-title', 'Restaurant Profiles')
@section('breadcrumb', 'Restaurant Profiles')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Restaurant Profiles</h2>
            <p>Manage hospitality profile types</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Profile</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/restaurant/profiles') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Profile Type</label>
                    <select name="profile_type" class="form-input" required>
                        <option value="restaurant">Restaurant</option>
                        <option value="hotel">Hotel</option>
                        <option value="cafe">Cafe</option>
                        <option value="cloud_kitchen">Cloud Kitchen</option>
                        <option value="banquet_hall">Banquet Hall</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Profile Name</label>
                    <input type="text" name="profile_name" class="form-input" maxlength="150">
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Profile</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Profiles</h3>
        </div>
        <div class="card-body">
            @if($profiles->count() === 0)
                <p class="empty-state">No profiles created yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Default</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profiles as $profile)
                            <tr>
                                <td>{{ ucwords(str_replace('_', ' ', $profile->profile_type)) }}</td>
                                <td>{{ $profile->profile_name ?? '-' }}</td>
                                <td>{{ $profile->is_active ? 'Active' : 'Inactive' }}</td>
                                <td>{{ $profile->is_default ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/restaurant/profiles/' . $profile->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="profile_type" value="{{ $profile->profile_type }}">
                                        <input type="text" name="profile_name" class="form-input form-input-sm" value="{{ $profile->profile_name }}">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_active" value="1" {{ $profile->is_active ? 'checked' : '' }}>
                                            <span>Active</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/restaurant/profiles/' . $profile->id . '/default') }}" class="inline-form">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Set Default</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/restaurant/profiles/' . $profile->id) }}" class="inline-form" onsubmit="return confirm('Delete this profile?');">
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
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; margin-right: 0.5rem; }
    .form-input-sm { max-width: 160px; }
    .checkbox-label { display: inline-flex; align-items: center; gap: 0.4rem; }
    .empty-state { color: var(--text-muted); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-success { background: #16a34a; color: #fff; border: none; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
    .alert-success { background: #d1fae5; color: #065f46; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .settings-card { margin-bottom: 1.5rem; }
    .card-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-color); }
    .card-body { padding: 1.5rem; }
</style>
@endpush
@endsection
