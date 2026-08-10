@extends('layouts.redesign.company')

@section('page-title', 'Interior Projects')
@section('breadcrumb', 'Interior Projects')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Interior Projects</h2>
            <p>Manage client projects and timelines</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Project</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/interior/projects') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input">
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
                    <label class="form-label">Project Type</label>
                    <input type="text" name="project_type" class="form-input" placeholder="residential/commercial">
                </div>
                <div class="form-group">
                    <label class="form-label">Property Type</label>
                    <input type="text" name="property_type" class="form-input" placeholder="villa/office/shop">
                </div>
                <div class="form-group">
                    <label class="form-label">Area (sqft)</label>
                    <input type="number" name="area_sqft" class="form-input" min="0">
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
                    <label class="form-label">Consultation Date</label>
                    <input type="date" name="consultation_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Site Visit Date</label>
                    <input type="date" name="site_visit_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Design Approval Date</label>
                    <input type="date" name="design_approval_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Expected Completion</label>
                    <input type="date" name="expected_completion_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Project Status</label>
                    <input type="text" name="project_status" class="form-input" placeholder="inquiry/design/execution">
                </div>
                <div class="form-group">
                    <label class="form-label">Quoted Amount</label>
                    <input type="number" name="quoted_amount" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Advance Paid</label>
                    <input type="number" name="advance_paid" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Requirements (one per line)</label>
                    <textarea name="requirements" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Design Files</label>
                    <input type="file" name="design_files[]" class="form-input" multiple>
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
                @foreach($projects as $project)
                    <div class="item-card">
                        <form method="POST" action="{{ url('/company/interior/projects/' . $project->id) }}" class="form-grid" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Client Name</label>
                                <input type="text" name="client_name" class="form-input" value="{{ $project->client_name }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Client Mobile</label>
                                <input type="text" name="client_mobile" class="form-input" value="{{ $project->client_mobile }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Client Email</label>
                                <input type="email" name="client_email" class="form-input" value="{{ $project->client_email }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Project Type</label>
                                <input type="text" name="project_type" class="form-input" value="{{ $project->project_type }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Property Type</label>
                                <input type="text" name="property_type" class="form-input" value="{{ $project->property_type }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Area (sqft)</label>
                                <input type="number" name="area_sqft" class="form-input" min="0" value="{{ $project->area_sqft }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" class="form-input" value="{{ $project->location }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Budget Range</label>
                                <input type="text" name="budget_range" class="form-input" value="{{ $project->budget_range }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Consultation Date</label>
                                <input type="date" name="consultation_date" class="form-input" value="{{ $project->consultation_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Site Visit Date</label>
                                <input type="date" name="site_visit_date" class="form-input" value="{{ $project->site_visit_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Design Approval Date</label>
                                <input type="date" name="design_approval_date" class="form-input" value="{{ $project->design_approval_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-input" value="{{ $project->start_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Expected Completion</label>
                                <input type="date" name="expected_completion_date" class="form-input" value="{{ $project->expected_completion_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Project Status</label>
                                <input type="text" name="project_status" class="form-input" value="{{ $project->project_status }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Quoted Amount</label>
                                <input type="number" name="quoted_amount" class="form-input" step="0.01" min="0" value="{{ $project->quoted_amount }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Advance Paid</label>
                                <input type="number" name="advance_paid" class="form-input" step="0.01" min="0" value="{{ $project->advance_paid }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Requirements (one per line)</label>
                                <textarea name="requirements" class="form-input" rows="3">{{ $project->requirements ? implode("\n", $project->requirements) : '' }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Replace Design Files</label>
                                <input type="file" name="design_files[]" class="form-input" multiple>
                                <small class="muted">Current: {{ $project->design_files ? count($project->design_files) : 0 }} files</small>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ url('/company/interior/projects/' . $project->id) }}" class="inline-form" onsubmit="return confirm('Delete this project?');">
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
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
    .muted { color: var(--text-secondary); font-size: 0.75rem; }
</style>
@endsection
