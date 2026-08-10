@extends('layouts.redesign.company')

@section('page-title', 'Development Projects')
@section('breadcrumb', 'Development Projects')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Development Projects</h2>
            <p>Showcase constituency development work</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Project</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/political/projects') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Project Name</label>
                    <input type="text" name="project_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" name="project_category" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Budget Allocated</label>
                    <input type="number" name="budget_allocated" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Completion Date</label>
                    <input type="date" name="completion_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-input" placeholder="proposed/ongoing/completed">
                </div>
                <div class="form-group">
                    <label class="form-label">Beneficiaries Count</label>
                    <input type="number" name="beneficiaries_count" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Images</label>
                    <input type="file" name="images[]" class="form-input" multiple>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_featured" value="1">
                        <span>Featured</span>
                    </label>
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
                        <form method="POST" action="{{ url('/company/political/projects/' . $project->id) }}" class="form-grid" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Project Name</label>
                                <input type="text" name="project_name" class="form-input" value="{{ $project->project_name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <input type="text" name="project_category" class="form-input" value="{{ $project->project_category }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" class="form-input" value="{{ $project->location }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Budget Allocated</label>
                                <input type="number" name="budget_allocated" class="form-input" step="0.01" min="0" value="{{ $project->budget_allocated }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-input" value="{{ $project->start_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Completion Date</label>
                                <input type="date" name="completion_date" class="form-input" value="{{ $project->completion_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="status" class="form-input" value="{{ $project->status }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Beneficiaries Count</label>
                                <input type="number" name="beneficiaries_count" class="form-input" min="0" value="{{ $project->beneficiaries_count }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Replace Images</label>
                                <input type="file" name="images[]" class="form-input" multiple>
                                <small class="muted">Current: {{ $project->images ? count($project->images) : 0 }} images</small>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-input" rows="3">{{ $project->description }}</textarea>
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }}>
                                    <span>Featured</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ url('/company/political/projects/' . $project->id) }}" class="inline-form" onsubmit="return confirm('Delete this project?');">
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
