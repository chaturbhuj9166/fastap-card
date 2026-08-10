@extends('layouts.redesign.dashboard')

@section('title', 'Member Progress')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Member Progress</h1>
            <p class="content-subtitle">Track assessments and results</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Progress Entry</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/fitness/progress') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Member Mobile</label>
                    <input type="text" name="member_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Assessment Date</label>
                    <input type="date" name="assessment_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Weight (kg)</label>
                    <input type="number" name="weight_kg" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Height (cm)</label>
                    <input type="number" name="height_cm" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">BMI</label>
                    <input type="number" name="bmi" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Body Fat (%)</label>
                    <input type="number" name="body_fat_percentage" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Measurements (one per line)</label>
                    <textarea name="measurements" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Progress Photos</label>
                    <input type="file" name="progress_photos[]" class="form-input" multiple>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Goals (one per line)</label>
                    <textarea name="goals" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Entry</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Progress Entries</h3>
        </div>
        <div class="card-body">
            @if($progressEntries->count() === 0)
                <p class="empty-state">No progress entries yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Date</th>
                                <th>Weight</th>
                                <th>BMI</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($progressEntries as $entry)
                            <tr>
                                <td>{{ $entry->member_mobile ?? '-' }}</td>
                                <td>{{ $entry->assessment_date ? $entry->assessment_date->format('d M Y') : '-' }}</td>
                                <td>{{ $entry->weight_kg ?? '-' }}</td>
                                <td>{{ $entry->bmi ?? '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/fitness/progress/' . $entry->id) }}" class="inline-form" onsubmit="return confirm('Delete this entry?');">
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
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
