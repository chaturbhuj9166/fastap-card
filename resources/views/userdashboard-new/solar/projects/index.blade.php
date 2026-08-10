@extends('layouts.redesign.dashboard')

@section('title', 'Solar Projects')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Projects</h1>
            <p class="content-subtitle">Track solar installations</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Project</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/solar/projects') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Mobile</label>
                    <input type="text" name="client_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="client_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">System Type</label>
                    <input type="text" name="system_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Capacity (kW)</label>
                    <input type="number" name="capacity_kw" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Quotation Amount</label>
                    <input type="number" name="quotation_amount" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Subsidy Amount</label>
                    <input type="number" name="subsidy_amount" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Net Amount</label>
                    <input type="number" name="net_amount" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Advance Paid</label>
                    <input type="number" name="advance_paid" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Project Status</label>
                    <input type="text" name="project_status" class="form-input" placeholder="quoted/approved">
                </div>
                <div class="form-group">
                    <label class="form-label">Installation Start</label>
                    <input type="date" name="installation_start_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Commissioning Date</label>
                    <input type="date" name="commissioning_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Warranty End Date</label>
                    <input type="date" name="warranty_end_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Documents</label>
                    <input type="file" name="documents[]" class="form-input" multiple>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Project</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Projects</h3>
        </div>
        <div class="card-body">
            @if($projects->count() === 0)
                <p class="empty-state">No projects yet.</p>
            @else
                @foreach($projects as $project)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $project->client_name ?? 'Project' }}</strong>
                            <span>{{ $project->project_status }}</span>
                        </div>
                        <p class="item-desc">{{ $project->location ?? 'No location.' }}</p>

                        <form method="POST" action="{{ url('/user/solar/projects/' . $project->id . '/status') }}" class="form-grid">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="project_status" class="form-input" value="{{ $project->project_status }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Commissioning Date</label>
                                <input type="date" name="commissioning_date" class="form-input" value="{{ $project->commissioning_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Warranty End</label>
                                <input type="date" name="warranty_end_date" class="form-input" value="{{ $project->warranty_end_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" class="form-input" rows="2">{{ $project->notes }}</textarea>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Update</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/user/solar/projects/' . $project->id) }}" class="inline-form" onsubmit="return confirm('Delete this project?');">
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
