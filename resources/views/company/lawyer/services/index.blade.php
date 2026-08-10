@extends('layouts.redesign.company')

@section('page-title', 'Legal Services')
@section('breadcrumb', 'Legal Services')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Legal Services</h2>
            <p>Manage practice areas and fees</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Service</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/lawyer/services') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Practice Area</label>
                    <input type="text" name="practice_area" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Consultation Fee</label>
                    <input type="number" name="consultation_fee" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Court Fee Range</label>
                    <input type="text" name="court_fee_range" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Success Rate (%)</label>
                    <input type="number" name="success_rate_percentage" class="form-input" min="0" max="100">
                </div>
                <div class="form-group">
                    <label class="form-label">Experience (Years)</label>
                    <input type="number" name="experience_years_in_area" class="form-input" min="0">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Service</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Services</h3>
        </div>
        <div class="card-body">
            @if($services->count() === 0)
                <p class="empty-state">No services added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Practice Area</th>
                                <th>Fee</th>
                                <th>Success Rate</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{ $service->practice_area }}</td>
                                <td>{{ $service->consultation_fee ? number_format($service->consultation_fee, 2) : '-' }}</td>
                                <td>{{ $service->success_rate_percentage ? $service->success_rate_percentage . '%' : '-' }}</td>
                                <td>{{ $service->is_active ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/lawyer/services/' . $service->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="practice_area" class="form-input form-input-sm" value="{{ $service->practice_area }}" required>
                                        <input type="number" name="consultation_fee" class="form-input form-input-sm" value="{{ $service->consultation_fee }}" step="0.01" min="0">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}>
                                            <span>Active</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/lawyer/services/' . $service->id) }}" class="inline-form" onsubmit="return confirm('Delete this service?');">
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
