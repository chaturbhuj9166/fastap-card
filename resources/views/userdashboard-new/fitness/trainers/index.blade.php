@extends('layouts.redesign.dashboard')

@section('title', 'Trainers')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Trainers</h1>
            <p class="content-subtitle">Manage fitness trainers and instructors</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Trainer</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/fitness/trainers') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Trainer Name</label>
                    <input type="text" name="trainer_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Experience (Years)</label>
                    <input type="number" name="experience_years" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Specialization (one per line)</label>
                    <textarea name="specialization" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Certifications (one per line)</label>
                    <textarea name="certifications" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Languages (one per line)</label>
                    <textarea name="languages" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Trainer</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Trainer List</h3>
        </div>
        <div class="card-body">
            @if($trainers->count() === 0)
                <p class="empty-state">No trainers added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Experience</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trainers as $trainer)
                            <tr>
                                <td>{{ $trainer->trainer_name }}</td>
                                <td>{{ $trainer->experience_years ? $trainer->experience_years . ' yrs' : '-' }}</td>
                                <td>{{ $trainer->is_active ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/fitness/trainers/' . $trainer->id) }}" class="inline-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="trainer_name" class="form-input form-input-sm" value="{{ $trainer->trainer_name }}" required>
                                        <input type="number" name="experience_years" class="form-input form-input-sm" value="{{ $trainer->experience_years }}" min="0">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_active" value="1" {{ $trainer->is_active ? 'checked' : '' }}>
                                            <span>Active</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/fitness/trainers/' . $trainer->id) }}" class="inline-form" onsubmit="return confirm('Delete this trainer?');">
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
