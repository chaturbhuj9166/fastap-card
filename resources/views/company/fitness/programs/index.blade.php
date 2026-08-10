@extends('layouts.redesign.company')

@section('page-title', 'Training Programs')
@section('breadcrumb', 'Training Programs')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Training Programs</h2>
            <p>Manage fitness programs and pricing</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Program</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/fitness/programs') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Program Type</label>
                    <input type="text" name="program_type" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Program Name</label>
                    <input type="text" name="program_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Trainer</label>
                    <select name="trainer_id" class="form-input">
                        <option value="">Select</option>
                        @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}">{{ $trainer->trainer_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Duration (Weeks)</label>
                    <input type="number" name="duration_weeks" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Sessions / Week</label>
                    <input type="number" name="sessions_per_week" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Session Duration (Minutes)</label>
                    <input type="number" name="session_duration_minutes" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Max Participants</label>
                    <input type="number" name="max_participants" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Features (one per line)</label>
                    <textarea name="features" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Suitable For (one per line)</label>
                    <textarea name="suitable_for" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Goals (one per line)</label>
                    <textarea name="goals" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Program</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Programs</h3>
        </div>
        <div class="card-body">
            @if($programs->count() === 0)
                <p class="empty-state">No programs added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Trainer</th>
                                <th>Price</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($programs as $program)
                            <tr>
                                <td>{{ $program->program_name }}</td>
                                <td>{{ $program->program_type }}</td>
                                <td>{{ $program->trainer?->trainer_name ?? '-' }}</td>
                                <td>{{ $program->price ? number_format($program->price, 2) : '-' }}</td>
                                <td>{{ $program->is_active ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/fitness/programs/' . $program->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="program_type" class="form-input form-input-sm" value="{{ $program->program_type }}" required>
                                        <input type="text" name="program_name" class="form-input form-input-sm" value="{{ $program->program_name }}" required>
                                        <input type="number" name="price" class="form-input form-input-sm" value="{{ $program->price }}" step="0.01" min="0">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_active" value="1" {{ $program->is_active ? 'checked' : '' }}>
                                            <span>Active</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/fitness/programs/' . $program->id) }}" class="inline-form" onsubmit="return confirm('Delete this program?');">
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
