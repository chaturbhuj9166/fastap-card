@extends('layouts.redesign.company')

@section('page-title', 'Production Projects')
@section('breadcrumb', 'Production Projects')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Production Projects</h2>
            <p>Manage bookings and project pipeline</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Project</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/production/projects') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Client Mobile</label>
                    <input type="text" name="client_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Client Email</label>
                    <input type="email" name="client_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Service Category</label>
                    @php $categories = $services->pluck('category')->unique(); @endphp
                    <select name="service_category" class="form-input">
                        <option value="">Select</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Services</label>
                    <select name="service_ids[]" class="form-input" multiple>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Project Type</label>
                    <input type="text" name="project_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Shoot Date</label>
                    <input type="date" name="shoot_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Shoot Duration</label>
                    <input type="text" name="shoot_duration" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Budget Range</label>
                    <input type="text" name="budget_range" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Quoted Amount</label>
                    <input type="number" name="quoted_amount" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Advance Paid</label>
                    <input type="number" name="advance_paid" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="project_status" class="form-input">
                        <option value="inquiry">Inquiry</option>
                        <option value="quoted">Quoted</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Requirements (one per line)</label>
                    <textarea name="requirements" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Project</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Projects</h3>
        </div>
        <div class="card-body">
            @if($projects->count() === 0)
                <p class="empty-state">No projects added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->client_name }}</td>
                                <td>{{ $project->project_type ?? '-' }}</td>
                                <td>{{ $project->shoot_date ? $project->shoot_date->format('d M Y') : '-' }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $project->project_status)) }}</td>
                                <td>{{ $project->quoted_amount ? number_format($project->quoted_amount, 2) : '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/production/projects/' . $project->id . '/status') }}" class="inline-form">
                                        @csrf
                                        <select name="project_status" class="form-input form-input-sm">
                                            <option value="inquiry" {{ $project->project_status === 'inquiry' ? 'selected' : '' }}>Inquiry</option>
                                            <option value="quoted" {{ $project->project_status === 'quoted' ? 'selected' : '' }}>Quoted</option>
                                            <option value="confirmed" {{ $project->project_status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="in_progress" {{ $project->project_status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="completed" {{ $project->project_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $project->project_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Update</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/production/projects/' . $project->id) }}" class="inline-form" onsubmit="return confirm('Delete this project?');">
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
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; margin-right: 0.5rem; }
    .form-input-sm { max-width: 160px; }
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
