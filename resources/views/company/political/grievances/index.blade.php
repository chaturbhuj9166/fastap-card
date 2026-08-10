@extends('layouts.redesign.company')

@section('page-title', 'Public Grievances')
@section('breadcrumb', 'Public Grievances')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Public Grievances</h2>
            <p>Track complaints and resolution status</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Grievance</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/political/grievances') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Complainant Name</label>
                    <input type="text" name="complainant_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Mobile</label>
                    <input type="text" name="complainant_mobile" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="complainant_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Issue Category</label>
                    <input type="text" name="issue_category" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Priority</label>
                    <input type="text" name="priority" class="form-input" placeholder="low/medium/high">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-input" placeholder="submitted/in_progress/resolved">
                </div>
                <div class="form-group">
                    <label class="form-label">Images</label>
                    <input type="file" name="images[]" class="form-input" multiple>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Issue Description</label>
                    <textarea name="issue_description" class="form-input" rows="3" required></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Grievance</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Grievances</h3>
        </div>
        <div class="card-body">
            @if($grievances->count() === 0)
                <p class="empty-state">No grievances added yet.</p>
            @else
                @foreach($grievances as $grievance)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $grievance->ticket_number }}</strong>
                            <span>{{ $grievance->complainant_name }} - {{ $grievance->issue_category }}</span>
                        </div>
                        <p class="item-desc">{{ $grievance->issue_description }}</p>

                        <form method="POST" action="{{ url('/company/political/grievances/' . $grievance->id . '/status') }}" class="form-grid">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="status" class="form-input" value="{{ $grievance->status }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Priority</label>
                                <input type="text" name="priority" class="form-input" value="{{ $grievance->priority }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Assigned To</label>
                                <input type="text" name="assigned_to" class="form-input" value="{{ $grievance->assigned_to }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Resolved Date</label>
                                <input type="date" name="resolved_date" class="form-input" value="{{ $grievance->resolved_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Resolution Notes</label>
                                <textarea name="resolution_notes" class="form-input" rows="2">{{ $grievance->resolution_notes }}</textarea>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Update Status</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/company/political/grievances/' . $grievance->id) }}" class="inline-form" onsubmit="return confirm('Delete this grievance?');">
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
